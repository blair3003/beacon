<x-app-layout>
    <x-slot:title>Create Course</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Course</h2>
        </div>
        <div class="flex space-x-4">
            <x-link url="{{ route('courses.index') }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/courses">
                        @csrf
                        <fieldset>
                            <legend class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Enter course details</legend>

                            <div class="flex mb-2 flex-wrap">
                                <label for="title" class="basis-1/4 shrink-0">Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('title')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="code" class="basis-1/4 shrink-0">Code:</label>
                                <input type="text" id="code" name="code" value="{{ old('code') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('code')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="description" class="basis-1/4 shrink-0">Description:</label>
                                <textarea id="description" name="description" class="border-0 bg-slate-100 max-w-md grow">{{ old('description') }}</textarea>
                                @error('description')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="max_trainees" class="basis-1/4 shrink-0">Max trainees:</label>
                                <input type="number" id="max_trainees" name="max_trainees" min="1" value="{{ old('max_trainees') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('max_trainees')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="cert_period" class="basis-1/4 shrink-0">Certification period:</label>
                                <input type="number" id="cert_period" name="cert_period" min="1" value="{{ old('cert_period') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('cert_period')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>
                            
                        </fieldset>

                        <x-button>Create</x-button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>