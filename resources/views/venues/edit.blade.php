<x-app-layout>
    <x-slot:title>Edit Venue</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Venue</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/venues/{{ $venue->id }}">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <legend>Edit venue details</legend>

                            <div>
                                <label for="title">Name:</label>
                                <input type="text" id="name" name="name" value="{{ $venue->name }}">
                                @error('name')
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