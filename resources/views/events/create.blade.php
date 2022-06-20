<x-app-layout>
    <x-slot:title>Create Event</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Event</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/events">
                        @csrf
                        <fieldset>
                            <legend>Enter event details</legend>

                            <div>
                                <label for="course">Course:</label>
                                <select name="course_id" id="course">
                                    <option value="">--Please choose a course--</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ (old('course_id') == $course->id) ? 'selected' : '' }}>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>                
                                <label for="venue">Venue:</label>
                                <select name="venue_id" id="venue">
                                    <option value="">--Please choose a venue--</option>
                                    @foreach($venues as $venue)
                                    <option value="{{ $venue->id }}" {{ (old('venue_id') == $venue->id) ? 'selected' : '' }}>{{ $venue->name }}</option>
                                    @endforeach
                                </select>
                                @error('venue_id')
                                <p>{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="start-date">Start date:</label>
                                <input type="date" id="start-date" name="start_date" value="{{ old('start_date') }}">
                                @error('start_date')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>                
                                <label for="start-time">Start time:</label>
                                <input type="time" id="start-time" name="start_time" value="{{ old('start_time') }}">
                                @error('start_time')
                                <p>{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end-date">End date:</label>
                                <input type="date" id="end-date" name="end_date" value="{{ old('end_date') }}">
                                @error('end_date')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="end-time">Start time:</label>
                                <input type="time" id="end-time" name="end_time" value="{{ old('end_time') }}">
                                @error('end_time')
                                <p>{{ $message }}</p>
                                @enderror                
                            </div>

                            <div>
                                <label for="notes">Notes:</label>
                                <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
                                @error('notes')
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