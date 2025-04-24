<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Courses') }}
            </h2>

            <a href="{{ route('courses.create') }}"
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded">
                Add Course
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full table-auto">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Instructor</th>
            <th class="px-4 py-2">Price ($)</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Created At</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $course->title }}</td>
                <td class="px-4 py-2">{{ $course->instructor }}</td>
                <td class="px-4 py-2">{{ number_format($course->price, 2) }}</td>
                <td class="px-4 py-2">{{ $course->description }}</td>
                <td class="px-4 py-2">{{ $course->created_at->format('M-d-Y') }}</td>
                <td class="px-4 py-2">
                    <div class="flex items-center gap-x-4">
        {{-- View --}}
        <a href="{{ route('courses.view', $course->id) }}" title="View" class="hover:text-blue-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </a>

        {{-- Edit --}}
        <a href="{{ route('courses.edit', $course->id) }}" title="Edit" class="hover:text-green-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.414 2.586a2 2 0 112.828 2.828L13.828 13H11v-2.828l7.414-7.586z" />
            </svg>
        </a>

        {{-- Delete --}}
        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" title="Delete" class="hover:text-red-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </form>
    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

            </div>
        </div>
    </div>
</x-app-layout>
