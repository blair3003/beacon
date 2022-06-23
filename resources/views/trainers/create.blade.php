<x-app-layout>
    <x-slot:title>Create Trainer</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Trainer</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/trainers">
                        @csrf
                        <fieldset>
                            <legend>Enter trainer details</legend>

                            <div>
                                <label for="trainee">Trainee:</label>
                                <select id="trainee" name="trainee_id">
                                    <option value="">--Please choose a trainee--</option>
                                    @foreach($trainees as $trainee)
                                    <option value="{{ $trainee->id }}" {{ (old('trainee_id') == $trainee->id) ? 'selected' : '' }}>{{ $trainee->full_name }} &lt;{{ $trainee->email }}&gt;</option>
                                    @endforeach
                                </select>
                                @error('trainee_id')
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