<x-app-layout>
    <x-slot:title>Dashboard</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="mb-8 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Search for something...</h3>

                        <x-search-box />
                    </section>

                    <section class="mb-8 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Upcoming events</h3>
                        
                        <table class="w-full mb-6">
                            <thead>
                                <tr class="text-left p-2">
                                    <th class="p-2">Course</th>
                                    <th class="p-2">Venue</th>
                                    <th class="p-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                <tr class="hover:bg-slate-50 border-b border-gray-200">
                                    <td class="p-2"><a href="{{ route('events.show', $event->id) }}" class="text-blue-400 hover:text-blue-500">{{ $event->course->title }}</a></td>
                                    <td class="p-2">{{ ($event->venue->name) ?? '' }}</td> 
                                    <td class="p-2">{{ $event->full_dates }}</td>                             
                                </tr>
                                @endforeach                            
                            </tbody>
                        </table>
                    </section>
                        






                </div>
            </div>
        </div>
    </div>
</x-app-layout>
