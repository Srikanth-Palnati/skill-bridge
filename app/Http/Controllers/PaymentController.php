<?php

namespace App\Http\Controllers;
use App\Helpers\ResponseHelper;
use App\Models\CourseEnroll;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
    public function paymentcreate(Request $request)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //stripe config info
            $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));

                Log::info('Payment Gateway');
                
                $response = $stripe->checkout->sessions->create([
                  'success_url' => route('payment.success').'?session_id={CHECKOUT_SESSION_ID}&course_id='.$request->course_id,
                  'line_items' => [
                    [
                      'price_data' => ["currency" => 'USD' ,
                                        "product_data" => ["name" => $request->title],
                                        "unit_amount" =>  $request->price * 100
                                      ],
                      'quantity' => 1,
                    ],
                  ],
                  'mode' => 'payment',
                ]);
                
            Log::info('Response From Payment Gateway');

            if($request->expectsJson()){
                return response()->json(['status'=>true,'data'=>$response['url']],200);
            }    
            return redirect($response['url']);
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
    public function paymentsuccess(Request $request)
    {
        Log::info('Inside ' . __FUNCTION__ . ' function of controller class ' . __CLASS__);
        try{
            //stripe config info
            $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
            
            $response = $stripe->checkout->sessions->retrieve($request->session_id) ;
            
            DB::beginTransaction();
            
            if ($response->payment_status === 'paid') {

                Log::info('Fetching courses');
                
                $course = Course::findOrFail($request->course_id);
                
                //input data
                $data = [
                            'price' => $course->price,
                            'course_id' => $request->course_id
                        ];
                        if($request->user()->id){
                            $data['user_id'] = $request->user()->id ;
                        }
                //create data    
                CourseEnroll::create($data);
                
                Log::info('CourseEnroll Created');
                
                DB::commit();
                
                return redirect()->back()->with('success','Payment success');          
            }
        } catch (Exception $e) {
            //handleException            
            return ResponseHelper::handleException($e, $request);
        }
    }
}
