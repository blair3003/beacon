<x-app-layout>
    <x-slot:title>Search Results</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Search results for "{{ request('q') }}"</h2>            
        </div>    
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                	@unless($events->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Events</h3>
                        <ul>
                        	@foreach($events as $event)
                        	<li class="p-2"><a href="{{ route('events.show', $event->id) }}" class="text-blue-400 hover:text-blue-500">{{ $event->course->title }}, {{ $event->full_dates }}</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @endunless

                	@unless($trainees->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Trainees</h3>
                        <ul>
                        	@foreach($trainees as $trainee)
                        	<li class="p-2"><a href="{{ route('trainees.show', $trainee->id) }}" class="text-blue-400 hover:text-blue-500">{{ $trainee->full_name }} &lt;{{ $trainee->email }}&gt;</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @endunless

                	@unless($trainers->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Trainers</h3>
                        <ul>
                        	@foreach($trainers as $trainer)
                        	<li class="p-2"><a href="{{ route('trainers.show', $trainer->id) }}" class="text-blue-400 hover:text-blue-500">{{ $trainer->trainee->full_name }} &lt;{{ $trainer->trainee->email }}&gt;</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @endunless

                	@unless($venues->isEmpty())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Venues</h3>
                        <ul>
                        	@foreach($venues as $venue)
                        	<li class="p-2"><a href="{{ route('venues.show', $venue->id) }}" class="text-blue-400 hover:text-blue-500">{{ $venue->name }}</a></li>
                        	@endforeach
                        </ul>
                    </section>
                    @endunless

                    @if($events->isEmpty() && $trainees->isEmpty() && $trainers->isEmpty() && $venues->isEmpty())
                    <section class="mb-4 pb-4 border-gray-200">
                        <h3 class="font-semibold text-2xl text-gray-800 leading-tight">No results...</h3>
                    </section>

                    @endif





                </div>
            </div>
        </div>
    </div>
</x-app-layout> 