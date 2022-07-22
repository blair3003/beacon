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

                            <div>
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $venue->email }}">
                                @error('email')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="tel">Tel:</label>
                                <input type="text" id="tel" name="tel" value="{{ $venue->tel }}">
                                @error('tel')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="address_1">Address 1:</label>
                                <input type="text" id="address_1" name="address_1" value="{{ $venue->address_1 }}">
                                @error('address_1')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="address_2">Address 2:</label>
                                <input type="text" id="address_2" name="address_2" value="{{ $venue->address_2 }}">
                                @error('address_2')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="address_3">Address 3:</label>
                                <input type="text" id="address_3" name="address_3" value="{{ $venue->address_3 }}">
                                @error('address_3')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="city">City:</label>
                                <input type="text" id="city" name="city" value="{{ $venue->city }}">
                                @error('city')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="country">Country:</label>
                                <input type="text" id="country" name="country" value="{{ $venue->country }}">
                                @error('country')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="zip">Zip:</label>
                                <input type="text" id="zip" name="zip" value="{{ $venue->zip }}">
                                @error('zip')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="notes">Notes:</label>
                                <textarea id="notes" name="notes">{{ $venue->notes }}</textarea>
                                @error('notes')
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