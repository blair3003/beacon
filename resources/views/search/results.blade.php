<x-app-layout>
    <x-slot:title>Search Results</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Searching for {{ request('q') }}</h2>            
        </div>    
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                	@unless($events->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-2 font-semibold text-lg text-gray-800 leading-tight">Events</h3>
                        <ul>
                        	@foreach($events as $event)
                        	<li><a href="{{ route('events.show', $event->id) }}">{{ $event->course->title }} {{ $event->full_dates }}</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @else
                    @endunless

                	@unless($trainees->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-2 font-semibold text-lg text-gray-800 leading-tight">Trainees</h3>
                        <ul>
                        	@foreach($trainees as $trainee)
                        	<li><a href="{{ route('trainees.show', $trainee->id) }}">{{ $trainee->full_name }}</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @else
                    @endunless

                	@unless($trainers->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-2 font-semibold text-lg text-gray-800 leading-tight">Trainers</h3>
                        <ul>
                        	@foreach($trainers as $trainer)
                        	<li><a href="{{ route('trainers.show', $trainer->id) }}">{{ $trainer->trainee->full_name }}</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @else
                    @endunless

                	@unless($venues->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-2 font-semibold text-lg text-gray-800 leading-tight">Venues</h3>
                        <ul>
                        	@foreach($venues as $venue)
                        	<li><a href="{{ route('venues.show', $venue->id) }}">{{ $venue->name }}</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @else
                    @endunless





                </div>
            </div>
        </div>
    </div>
</x-app-layout> 