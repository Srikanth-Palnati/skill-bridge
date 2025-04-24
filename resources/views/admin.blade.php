<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('SkillBridge') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 text-center">
            <!-- Welcome Message -->
            
            <p class="text-gray-700 text-lg max-w-3xl mx-auto mb-8">
                As an administrator, you have the power to manage all courses, monitor student progress, and help shape the future of learning on SkillBridge.
            </p>

            <!-- Admin Actions -->
            <div class="grid grid-cols-1  gap-6 max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Manage Courses</h3>
                    <p class="text-gray-600 mb-4">View, create, and edit courses offered to students.</p>
                    <a href="{{ route('listcourses') }}"
                       class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-5 py-2 rounded">
                        Go to Course List
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
