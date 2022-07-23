<x-app-layout>
    <x-slot:title>Create Trainee</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Trainee</h2>
        </div>
        <div class="flex space-x-4">
            <x-link url="{{ route('trainees.index') }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/trainees">
                        @csrf
                        <fieldset>
                            <legend class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Enter trainee details</legend>

                            <div class="flex mb-2 flex-wrap">
                                <label for="first-name" class="basis-1/4 shrink-0">First name:</label>
                                <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('first_name')
                                <p class="text-red-700 font-semibold">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="last-name" class="basis-1/4 shrink-0">Last name:</label>
                                <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('last_name')
                                <p class="text-red-700 font-semibold">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="email" class="basis-1/4 shrink-0">Email:</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('email')
                                <p class="text-red-700 font-semibold">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="mobile" class="basis-1/4 shrink-0">Mobile:</label>
                                <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('mobile')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="tel" class="basis-1/4 shrink-0">Tel:</label>
                                <input type="text" id="tel" name="tel" value="{{ old('tel') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('tel')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="address_1" class="basis-1/4 shrink-0">Address 1:</label>
                                <input type="text" id="address_1" name="address_1" value="{{ old('address_1') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('address_1')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="address_2" class="basis-1/4 shrink-0">Address 2:</label>
                                <input type="text" id="address_2" name="address_2" value="{{ old('address_2') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('address_2')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="address_3" class="basis-1/4 shrink-0">Address 3:</label>
                                <input type="text" id="address_3" name="address_3" value="{{ old('address_3') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('address_3')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="city" class="basis-1/4 shrink-0">City:</label>
                                <input type="text" id="city" name="city" value="{{ old('city') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('city')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="country" class="basis-1/4 shrink-0">Country:</label>
                                <input type="text" id="country" name="country" value="{{ old('country') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('country')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="zip" class="basis-1/4 shrink-0">Zip:</label>
                                <input type="text" id="zip" name="zip" value="{{ old('zip') }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('zip')
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