<x-app-layout>
    <x-slot:title>Events</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Events</h2>
        <a href="/events/create">Create new event</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course</th>
                                <th>Venue</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>End Date</th>
                                <th>End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td><a href="/events/{{ $event->id }}">{{ $event->id }}</a></td>
                                <td>{{ $event->course->title }}</td>
                                <td>{{ ($event->venue->name) ?? '' }}</td>
                                <td>{{ $event->start_date }}</td>                                
                                <td>{{ $event->start_time }}</td>                                
                                <td>{{ $event->end_date }}</td>                                
                                <td>{{ $event->end_time }}</td>                                
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    <div>{{ $events->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>