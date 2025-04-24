<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Course') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto py-10 px-6">
            <div class="bg-white shadow rounded p-6">
                <h1 class="text-3xl font-bold mb-4">Title : {{ $course->title }}</h1>

                <h1 class="text-3xl font-bold mb-4">Instructor : {{ $course->instructor }}</h1>

                <p class="text-gray-700 mb-4">Description : {{ $course->description }}</p>
                @if($course->material)Material -  <a href="{{ asset( $course->material ) }}" class="text-green-600 hover:underline" target="_blank">View</a>@endif
                <br/>
                @if($course->video)Video -  <a href="{{ $course->video }}" class="text-green-600 hover:underline" target="_blank">View</a>@endif
                
                <div class="text-xl font-semibold mb-6">
                    Price: ${{ number_format($course->price, 2) }}
                </div>

            </div>
            
            {{-- Registered Users Table --}}
            
            <div class="bg-white shadow rounded p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold mb-4">Registered Users ({{ $course->users->count() }})</h2>
                    <a href="{{ route('courses.users.certificate', [$course->id]) }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded">Generate Certificate</a>
                </div>
                
                @if($course->users->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Paid Price ($)</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Certificate</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($course->users as $user)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $user->name }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-600">{{ $user->email }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ number_format($user->pivot->price, 2) }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800">
                                        @if($user->pivot->certificate)
                                        <a href="{{ asset('storage/' . $user->pivot->certificate) }}" class="text-green-600 hover:underline" target="_blank">
                                            View</a>
                                        @else
                                            {{ 'No' }}
                                        @endif</td>
                                        
                                        <td class="px-4 py-2 text-sm">
                                            <span class="inline-block px-2 py-1 rounded text-white
                                                @if($user->pivot->status === 'completed') bg-green-500
                                                @elseif($user->pivot->status === 'pending') bg-yellow-500
                                                @elseif($user->pivot->status === 'rejected') bg-red-500
                                                @else bg-gray-500 @endif">
                                                {{ ucfirst($user->pivot->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">No users have registered for this course yet.</p>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>