<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses as $course)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-xl">
                        

                        <div class="p-6 flex flex-col h-full">
                            <h3 class="text-xl font-semibold text-gray-800 truncate">{{ $course->title }}</h3>
                            <h4 class="text-sm text-gray-500 mt-1">Instructor: {{ $course->instructor }}</h4>
                            <p class="text-gray-700 text-sm mt-3 line-clamp-3">{{ $course->description }}</p>
                            
                            <div class="mt-4 flex justify-between items-center">
                                <p class="font-bold text-indigo-600 text-lg">${{ number_format($course->price, 2) }}</p>

                                <a href="{{ route('courses.studentview', $course->id) }}" 
                                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-300">
                                    Enroll Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
