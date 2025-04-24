<?php

namespace App\Http\Controllers;
use App\Helpers\ResponseHelper;
use App\Models\Course;
use App\Models\User;
use App\Models\CourseEnroll;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Jobs\SendCertificateMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function listcourses(Request $request)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //Fetch courses
            $courses = Course::all();
            
            Log::info('fetched courses');
            
            if($request->expectsJson()){
                return response()->json(['status'=>true , 'message'=>count($courses).' records found', 'data'=>$courses],200);
            }
            
            return view('courses.listcourses', compact('courses'));
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
    
    public function create(Request $request)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //create form
            return view('courses.create');
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
    public function store(Request $request)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //input validation
            $request->validate([
                'title' => 'required|string|max:255',
                'instructor' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'thumbnail' => 'required|image|max:2048', // 2MB max
            ]);
            
            DB::beginTransaction();
            
            //inputs data
            $data = $request->only(['title', 'instructor', 'price', 'description']);
            
            //file save
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                // Store the file in the 'public/thumbnails' directory
                $file->storeAs('public/thumbnails', $filename);
                // Save the public path (accessible via URL)
                $data['thumbnail'] = 'storage/thumbnails/' . $filename;
            }
            //create data
            Course::create($data);
            
            DB::commit();
            
            Log::info('created data');
            
            return redirect()->route('listcourses')->with('success', 'Course created successfully.');
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
    public function view(Request $request,$id)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //fetching courses
            $course = Course::with(['users'])->findOrFail($id);
            
            Log::info('fetched course');
            
            if($request->expectsJson()){
                return response()->json(['status'=>true,'data'=>$course],200);
            }
            
            return view('courses.view', compact('course'));
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        } 
    }
    
    public function studentview(Request $request,$id)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //fetching course
            //$course = Course::with(['users'])->findOrFail($id);
            $course = Course::findOrFail($id);
            
            Log::info('fetched course');
            
            return view('courses.studentview', compact('course'));
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
    public function edit(Request $request,$id)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //fetching course
            $course = Course::findOrFail($id);
            
            Log::info('fetched course');
            
            return view('courses.edit', compact('course'));
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
    public function update(Request $request, $id)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //input validation
            $request->validate([
            'title' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        //fetching course    
        $course = Course::findOrFail($id);
        
        //inputs data
        $data = $request->only(['title', 'instructor', 'price', 'description']);
        
        //video saving
        if ($request->video) {
            $data['video'] = $request->video;
        }
        
        //thumbnail saving
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailFilename = time() . '.' . $file->getClientOriginalExtension();
            // Store the file in the 'public/thumbnails' directory
            $file->storeAs('public/thumbnails', $thumbnailFilename);

            // Save the public path (accessible via URL)
            $data['thumbnail'] = 'storage/thumbnails/' . $thumbnailFilename;
        }
        
        //material saving
        if ($request->hasFile('material')) {
            $file = $request->file('material');
            $materialFilename = time() . '.' . $file->getClientOriginalExtension();
            // Store the file in the 'public/thumbnails' directory
            $file->storeAs('public/materials', $materialFilename);

            // Save the public path (accessible via URL)
            $data['material'] = 'storage/materials/' . $materialFilename;
        }
        
        //update data
        $course->update($data);
        
        Log::info('updated data');
        
        return redirect()->route('listcourses')->with('success', 'Course updated successfully.');
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }

    public function destroy(Request $request,$id)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //fetching course  
            $course = Course::findOrFail($id);
            
            Log::info('fetched course');
            
            //deleting course
            $course->delete();
            
            return redirect()->route('listcourses')->with('success', 'Course deleted successfully.');
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
        

    public function generateCertificatesForCourse(Request $request,Course $course)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            // Load users with pivot data
            $course->load('users');

            foreach ($course->users as $user) {
                // Certificate file name and path
                $filename = 'certificate_' . $course->id . '_' . $user->id . '.pdf';
                $filePath = 'certificates/' . $filename;

                // Check if it already exists
                if (!Storage::disk('public')->exists($filePath)) {
                    // Generate PDF
                    $pdf = Pdf::loadView('certificates.certificate', compact('course', 'user'));

                    Log::info('certificate created');
                    // Store certificate
                    Storage::disk('public')->put($filePath, $pdf->output());

                    // Update pivot table with certificate path
                    $course->users()->updateExistingPivot($user->id, [
                        'certificate' => $filePath,
                    ]);
                    Log::info('updated certificate');
                }
                //SendCertificateMail
                $certificatePath = Storage::disk('public')->path($filePath);
                dispatch(new SendCertificateMail($user, $course, $certificatePath));
                Log::info('email notification');
            }

            // Redirect or show success message
            return back()->with('success', 'Certificates generated and saved for all registered users.');
        } catch (Exception $e) {
            //handleException
            return ResponseHelper::handleException($e, $request);
        }
    }
    
    public function downloadcertificate(Request $request)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //input validation
            $request->validate([
                'course_id' => 'required|integer',
                'user_id' => 'required|integer',
            ]);

            //fetching course
            $course = Course::find($request->course_id);
            if (is_null($course)) {
                return response()->json(['status' => false, 'message' => 'Course Id Doesn\'t Exist'], 404);
            }

            //fetching user
            $user = User::find($request->user_id);
            if (is_null($user)) {
                return response()->json(['status' => false, 'message' => 'User Id Doesn\'t Exist'], 404);
            }

            //fetching enrollment
            $enrollment = CourseEnroll::where('course_id', $request->course_id)
                            ->where('user_id', $request->user_id)
                            ->first();

            if (is_null($enrollment)) {
                return response()->json(['status' => false, 'message' => 'Enrollment Not Found.'], 404);
            }

            //creating certificate
            if ($enrollment->certificate) {
                //path
                $path = storage_path('app/public/' .$enrollment->certificate);
                if (file_exists($path)) {
                    
                    $file_arr = explode("/", $enrollment->certificate);
                    
                    //file name
                    $fileName = end($file_arr);

                    $fileName_split = explode(".", $fileName);
                    
                    //entension
                    $extension = end($fileName_split);
                    
                    if ($extension == "pdf") {
                        $headers = ['Content-Type: application/pdf'];
                    }
                    Log::info('certificate downloaded');
                    return response()->download($path, $fileName, $headers);
                } else {
                    $result = ['status' => false, 'message' => 'File has been deleted or removed.'];
                    return response()->json($result, 404);
                }
            } else {
                $result = ['status' => false, 'message' => 'File doesn\'t exist.'];
                return response()->json($result, 404);
            }
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        } 
    }
    public function liststudentcourses(Request $request)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //Fetch courses
            $courses = Course::all();
            
            Log::info('Fetched courses');
            
            if($request->expectsJson()){
                return response()->json(['status'=>true,'data'=>$courses],200);
            }
            return view('courses.liststudentcourses', compact('courses'));
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
}
