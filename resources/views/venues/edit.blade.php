<x-app-layout>
    <x-slot:title>Edit Venue</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editing {{ $venue->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('venues.show', $venue) }}">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <legend class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Venue details</legend> 

                            <div class="flex mb-2 flex-wrap">
                                <label for="title" class="basis-1/4 shrink-0">Name:</label>
                                <input type="text" id="name" name="name" value="{{ $venue->name }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('name')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="email" class="basis-1/4 shrink-0">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $venue->email }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('email')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="tel" class="basis-1/4 shrink-0">Tel:</label>
                                <input type="text" id="tel" name="tel" value="{{ $venue->tel }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('tel')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="address_1" class="basis-1/4 shrink-0">Address 1:</label>
                                <input type="text" id="address_1" name="address_1" value="{{ $venue->address_1 }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('address_1')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="address_2" class="basis-1/4 shrink-0">Address 2:</label>
                                <input type="text" id="address_2" name="address_2" value="{{ $venue->address_2 }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('address_2')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="address_3" class="basis-1/4 shrink-0">Address 3:</label>
                                <input type="text" id="address_3" name="address_3" value="{{ $venue->address_3 }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('address_3')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="city" class="basis-1/4 shrink-0">City:</label>
                                <input type="text" id="city" name="city" value="{{ $venue->city }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('city')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="country" class="basis-1/4 shrink-0">Country:</label>
                                <input type="text" id="country" name="country" value="{{ $venue->country }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('country')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="zip" class="basis-1/4 shrink-0">Zip:</label>
                                <input type="text" id="zip" name="zip" value="{{ $venue->zip }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('zip')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="notes" class="basis-1/4 shrink-0">Notes:</label>
                                <textarea id="notes" name="notes" class="border-0 bg-slate-100 max-w-md grow">{{ $venue->notes }}</textarea>
                                @error('notes')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>
                            
                        </fieldset>

                        <x-button>Update</x-button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>