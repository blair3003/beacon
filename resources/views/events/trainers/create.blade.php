<x-app-layout>
    <x-slot:title>Add Trainer to Event</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Trainer to Event #{{ $event->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                        <form method="POST" action="/events/{{ $event->id }}/trainers">
                            @csrf

                            <div>
                                <label for="trainer">Trainer:</label>
                                <select name="trainer_id" id="trainer">
                                    <option value="">--Please choose a trainer--</option>
                                    @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}" {{ (old('trainer_id') == $trainer->id) ? 'selected' : '' }}>{{ $trainer->trainee->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('trainer_id')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>


                            <button type="submit">Add</button>
                        </form>

                        <a href="{{ route('events.show', $event) }}">Back</a>        

                </div>
            </div>
        </div>
    </div>
</x-app-layout>