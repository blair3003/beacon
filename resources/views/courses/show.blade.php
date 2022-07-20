<x-app-layout>
    <x-slot:title>Course</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $course->title }}</h2>
        </div>
        <div class="flex space-x-4">
            <x-link url="{{ route('courses.edit', $course->id) }}" class="!bg-yellow-400">Edit</x-link>
            <form method="POST" action="{{ route('courses.show', $course->id) }}">
                @csrf
                @method('DELETE')
                <x-button class="!bg-red-600">Delete</x-button>
            </form>
            <x-link url="{{ route('courses.index') }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div><strong>Title:</strong> {{ $course->title }}</div>
                    <div><strong>Description:</strong> {{ $course->description }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>