<x-app-layout>
    <x-slot:title>Venue</x-slot>

    <x-slot:header>        
        <div class="flex items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $venue->name }}</h2>
        </div>
        <div class="flex space-x-4 justify-end">
            <x-link url="{{ route('venues.edit', $venue->id) }}" class="!bg-yellow-400">Edit</x-link>
            <form method="POST" action="{{ route('venues.show', $venue->id) }}">
                @csrf
                @method('DELETE')
                <x-button class="!bg-red-600">Delete</x-button>
            </form>
            <x-link url="{{ route('venues.index') }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="mb-8 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Venue details</h3>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Name:</div>
                            <div class="max-w-prose">{{ $venue->name }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Email:</div>
                            <div class="max-w-prose">{{ $venue->email }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Tel:</div>
                            <div class="max-w-prose">{{ $venue->tel }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Address 1:</div>
                            <div class="max-w-prose">{{ $venue->address_1 }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Address 2:</div>
                            <div class="max-w-prose">{{ $venue->address_2 }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Address 3:</div>
                            <div class="max-w-prose">{{ $venue->address_3 }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">City:</div>
                            <div class="max-w-prose">{{ $venue->city }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Country:</div>
                            <div class="max-w-prose">{{ $venue->country }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Zip:</div>
                            <div class="max-w-prose">{{ $venue->zip }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Notes:</div>
                            <div class="max-w-prose">{{ $venue->notes }}</div>
                        </div>
                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-2xl text-gray-800 leading-tight">Events</h3>
                        </div>
                        <div>
                            @unless($venue->events->isEmpty())
                            <table class="w-full mb-6">
                                <thead>
                                    <tr class="text-left p-2">
                                        <th class="p-2">Course</th>
                                        <th class="p-2">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($venue->events->sortByDesc('start_date') as $event)
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-2"><a href="{{ route('events.show', $event->id) }}" class="text-blue-400 hover:text-blue-500">{{ $event->course->title }}</a></td>
                                        <td class="p-2">{{ $event->full_dates }}</td>
                                    </tr>
                                    @endforeach                            
                                </tbody>
                            </table>                        
                            @else
                            <p>No events yet.</p>
                            @endunless
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
