<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Title
                        </label>
                        <input value="{{ old('title', $course->title) }}" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="instructor">
                            Instructor
                        </label>
                        <input value="{{ old('instructor', $course->instructor) }}" name="instructor" id="instructor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                            Price ($)
                        </label>
                        <input type="number" step="0.01" value="{{ old('price', $course->price) }}" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">{{ old('description', $course->description) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="video">
                            Video
                        </label>
                        <input value="{{ old('video', $course->video) }}" name="video" id="video" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                            Thumbnail 
                        </label>
                         @if($course->thumbnail)<img src="{{ asset($course->thumbnail) }}"/>@endif
                        <input type="file"  accept="image/*"  name="thumbnail" id="thumbnail" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" @if(empty($course->thumbnail)) required @endif>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="material">
                            Material - @if($course->material)<a href="{{ asset( $course->material ) }}" class="text-green-600 hover:underline" target="_blank">View Material</a>@endif
                        </label>
                        <input type="file" name="material" id="material" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded">
                            Update Course
                        </button>
                        <a href="{{ route('listcourses') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
