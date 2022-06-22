<x-app-layout>
    <x-slot:title>Edit Trainee</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit {{ $trainee->full_name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/trainees/{{ $trainee->id }}">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <legend>Update trainee details</legend>

                            <div>
                                <label for="first-name">First name:</label>
                                <input type="text" id="first-name" name="first_name" value="{{ $trainee->first_name }}">
                                @error('first_name')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="last-name">Last name:</label>
                                <input type="text" id="last-name" name="last_name" value="{{ $trainee->last_name }}">
                                @error('last_name')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $trainee->email }}">
                                @error('email')
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