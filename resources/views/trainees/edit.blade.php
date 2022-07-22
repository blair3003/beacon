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

                            <div>
                                <label for="mobile">Mobile:</label>
                                <input type="text" id="mobile" name="mobile" value="{{ $trainee->mobile }}">
                                @error('mobile')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="tel">Tel:</label>
                                <input type="text" id="tel" name="tel" value="{{ $trainee->tel }}">
                                @error('tel')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="address_1">Address 1:</label>
                                <input type="text" id="address_1" name="address_1" value="{{ $trainee->address_1 }}">
                                @error('address_1')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="address_2">Address 2:</label>
                                <input type="text" id="address_2" name="address_2" value="{{ $trainee->address_2 }}">
                                @error('address_2')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="address_3">Address 3:</label>
                                <input type="text" id="address_3" name="address_3" value="{{ $trainee->address_3 }}">
                                @error('address_3')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="city">City:</label>
                                <input type="text" id="city" name="city" value="{{ $trainee->city }}">
                                @error('city')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="country">Country:</label>
                                <input type="text" id="country" name="country" value="{{ $trainee->country }}">
                                @error('country')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="zip">Zip:</label>
                                <input type="text" id="zip" name="zip" value="{{ $trainee->zip }}">
                                @error('zip')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>
                            
                        </fieldset>

                        <button type="submit">Update</button>                        
                    </form>

                    @unless($trainee->isTrainer())
                    <form method="POST" action="/trainers">
                        @csrf
                        <input type="hidden" name="trainee_id" value="{{ $trainee->id }}">
                        <button type="submit">Make trainer</button>                        
                    </form>
                    @else
                    <form method="POST" action="/trainers/{{ $trainee->trainer->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove trainer</button>                        
                    </form>
                    @endunless

                </div>
            </div>
        </div>
    </div>
</x-app-layout>