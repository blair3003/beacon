<x-app-layout>
    <x-slot:title>Edit Course</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Course</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/courses/{{ $course->id }}">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <legend>Edit course details</legend>

                            <div>
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" value="{{ $course->title }}">
                                @error('title')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="description">Description:</label>
                                <textarea id="description" name="description">{{ $course->description }}</textarea>
                                @error('description')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>
                            
                        </fieldset>

                        <button type="submit">Update</button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>