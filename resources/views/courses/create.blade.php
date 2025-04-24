<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Course') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <form action="{{ route('courses.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Title
                        </label>
                        <input value="{{ old('title') }}" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="instructor">
                            Instructor
                        </label>
                        <input value="{{ old('instructor') }}" name="instructor" id="instructor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                            Price ($)
                        </label>
                        <input type="number" step="0.01" value="{{ old('price') }}" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                            Thumbnail
                        </label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                               class="block w-full text-sm text-gray-700 border rounded px-3 py-2 shadow" required>
                    </div>
                    

                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded">
                            Create Course
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
