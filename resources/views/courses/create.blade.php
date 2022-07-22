<x-app-layout>
    <x-slot:title>Create Course</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Course</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/courses">
                        @csrf
                        <fieldset>
                            <legend>Enter course details</legend>

                            <div>
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}">
                                @error('title')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="code">Code:</label>
                                <input type="text" id="code" name="code" value="{{ old('code') }}">
                                @error('code')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="description">Description:</label>
                                <textarea id="description" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="max_trainees">Max trainees:</label>
                                <input type="number" id="max_trainees" name="max_trainees" min="1" value="{{ old('max_trainees') }}">
                                @error('max_trainees')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="cert_period">Certification period:</label>
                                <input type="number" id="cert_period" name="cert_period" min="1" value="{{ old('cert_period') }}">
                                @error('cert_period')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>
                            
                        </fieldset>

                        <button type="submit">Create</button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>