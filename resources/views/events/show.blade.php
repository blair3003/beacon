<x-app-layout>
    <x-slot:title>Event</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Event #{{ $event->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div><strong>Course:</strong> <a href="/courses/{{  $event->course->id }}">{{ $event->course->title }}</a></div>
                    <div><strong>Venue:</strong> <a href="/venues/{{ ($event->venue->id) ?? '' }}">{{ ($event->venue->name) ?? '' }}</a></div>
                    <div><strong>Start Date:</strong> {{ $event->start_date }}</div>
                    <div><strong>Start Time:</strong> {{ $event->start_time }}</div>
                    <div><strong>End Date:</strong> {{ $event->end_date }}</div>
                    <div><strong>End Time:</strong> {{ $event->end_time }}</div>
                    <div><strong>Notes:</strong> {{ $event->notes }}</div>

                    <div>
                        <a href="/events/{{ $event->id }}/edit">Edit</a>

                        <form method="POST" action="/events/{{ $event->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>

                        <a href="/events">Back</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>