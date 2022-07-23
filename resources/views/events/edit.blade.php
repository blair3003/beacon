<x-app-layout>
    <x-slot:title>Edit Event</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editing {{ $event->course->title }}, {{ $event->full_dates }}</h2>
        </div>
        <div class="flex space-x-4">
            <x-link url="{{ route('events.show', $event) }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/events/{{ $event->id }}">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <legend class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Edit event details</legend>

                            <div class="flex mb-2 flex-wrap">
                                <label for="course" class="basis-1/4 shrink-0">Course:</label>
                                <select name="course_id" id="course" class="border-0 bg-slate-100 max-w-md grow">
                                    <option value="">--Please choose a course--</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ ($event->course->id == $course->id) ? 'selected' : '' }}>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">                
                                <label for="venue" class="basis-1/4 shrink-0">Venue:</label>
                                <select name="venue_id" id="venue" class="border-0 bg-slate-100 max-w-md grow">
                                    <option value="">--Please choose a venue--</option>
                                    @foreach($venues as $venue)
                                    <option value="{{ $venue->id }}" {{ (isset($event->venue) && $event->venue->id == $venue->id) ? 'selected' : '' }}>{{ $venue->name }}</option>
                                    @endforeach
                                </select>
                                @error('venue_id')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="start-date" class="basis-1/4 shrink-0">Start date:</label>
                                <input type="date" id="start-date" name="start_date" value="{{ $event->start_date }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('start_date')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">                
                                <label for="start-time" class="basis-1/4 shrink-0">Start time:</label>
                                <input type="time" id="start-time" name="start_time" value="{{ date('H:i', strtotime($event->start_time)) }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('start_time')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="end-date" class="basis-1/4 shrink-0">End date:</label>
                                <input type="date" id="end-date" name="end_date" value="{{ $event->end_date }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('end_date')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="end-time" class="basis-1/4 shrink-0">Start time:</label>
                                <input type="time" id="end-time" name="end_time" value="{{ date('H:i', strtotime($event->end_time)) }}" class="border-0 bg-slate-100 max-w-md grow">
                                @error('end_time')
                                <p class="basis-full text-red-600 shrink-0">{{ $message }}</p>
                                @enderror                
                            </div>

                            <div class="flex mb-2 flex-wrap">
                                <label for="notes" class="basis-1/4 shrink-0">Notes:</label>
                                <textarea id="notes" name="notes" class="border-0 bg-slate-100 max-w-md grow">{{ $event->notes }}</textarea>
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