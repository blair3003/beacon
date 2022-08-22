<x-app-layout>
    <x-slot:title>Add Trainee to Event</x-slot>

    <x-slot:header>
        <div class="flex items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Trainee to {{ $event->course->title }}, {{ $event->full_dates }}</h2>
        </div>
        <div class="flex space-x-4 justify-end">
            <x-link url="{{ route('events.show', $event) }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/events/{{ $event->id }}/trainees">
                        @csrf
                        <fieldset>
                            <legend class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Trainee details</legend>

                            <div class="flex mb-2 flex-wrap">
                                <label for="trainee" class="basis-1/4 shrink-0">Trainee:</label>
                                <select name="trainee_id" id="trainee" class="border-0 bg-slate-100 max-w-md grow cursor-pointer">
                                    <option value="">--Please choose a trainee--</option>
                                    @foreach($trainees as $trainee)
                                    <option value="{{ $trainee->id }}" {{ (old('trainee_id') == $trainee->id) ? 'selected' : '' }}>{{ $trainee->full_name }} &lt;{{ $trainee->email }}&gt;</option>
                                    @endforeach
                                </select>
                                @error('trainee_id')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                        </fieldset>

                        <x-button>Add</x-button>
                    </form>      

                </div>
            </div>
        </div>
    </div>
</x-app-layout>