<x-app-layout>
    <x-slot:title>Add Trainee to Event</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Trainee to Event #{{ $event->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                        <form method="POST" action="/events/{{ $event->id }}/trainees">
                            @csrf

                            <div>
                                <label for="trainee">Trainee:</label>
                                <select name="trainee_id" id="trainee">
                                    <option value="">--Please choose a trainee--</option>
                                    @foreach($trainees as $trainee)
                                    <option value="{{ $trainee->id }}" {{ (old('trainee_id') == $trainee->id) ? 'selected' : '' }}>{{ $trainee->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('trainee_id')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>


                            <button type="submit">Add</button>
                        </form>

                        <a href="/events/{{ $event->id }}">Back</a>        

                </div>
            </div>
        </div>
    </div>
</x-app-layout>