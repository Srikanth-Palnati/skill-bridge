<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('SkillBridge') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 text-center">
            <!-- Welcome Message -->
            
            <p class="text-gray-700 text-lg max-w-3xl mx-auto mb-8">
                SkillBridge is your bridge to a brighter future. Explore a wide range of student-friendly online courses designed to boost your skills, grow your knowledge, and get you closer to your career goals.
            </p>

            <!-- Student Courses Preview (Optional CTA) -->
            <div class="bg-white rounded-lg shadow-lg p-6 mt-6 inline-block">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Start Learning Today</h2>
                <p class="text-gray-600 mb-4">Browse our student course catalog and enroll in the course that suits your passion.</p>
                
                <a href="{{ route('liststudentcourses') }}"
                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm px-6 py-3 rounded transition duration-300">
                    View Student Courses
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
