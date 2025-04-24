<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Course') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Success Message Section -->
        @if(session('success'))
            <div class="bg-green-500 text-center rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-5xl mx-auto py-10 px-6">
            <div class="bg-white shadow rounded p-6">
                
                {{-- Content Row: Info and Thumbnail --}}
                <div class="flex md:flex-row gap-8 items-start">

                    {{-- Left Side: Course Info --}}
                    <div class="w-full md:w-2/3">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $course->title }}
                        </h1>
                        <p class="text-gray-700 mb-4">
                            <span class="font-semibold">Instructor:</span> {{ $course->instructor }}
                        </p>
                        <p class="text-gray-700 mb-4">
                            <span class="font-semibold">Description:</span><br> {{ $course->description }}
                        </p>
                        <p class="text-xl font-bold text-indigo-600">
                            Price: ${{ number_format($course->price, 2) }}
                        </p>
                        {{-- Bottom: Enroll Button --}}
                        <div class="pt-6 border-t mt-6">
                            <form action="{{ route('payment.create', ['price'=>$course->price,'title'=>$course->title,'course_id'=>$course->id]) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-6 py-2 rounded">
                                    Pay Now
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Right Side: Thumbnail --}}
                    @if ($course->thumbnail)
                        <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                            <img src="{{ asset($course->thumbnail) }}" 
                                 alt="{{ $course->title }}" 
                                 class="w-64 h-40 object-cover rounded shadow-md border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
