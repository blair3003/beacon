<x-app-layout>
    <x-slot:title>Course</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $course->title }} ({{ $course->code }})</h2>
        </div>
        <div class="flex space-x-4">
            <x-link url="{{ route('courses.edit', $course->id) }}" class="!bg-yellow-400">Edit</x-link>
            <form method="POST" action="{{ route('courses.show', $course->id) }}">
                @csrf
                @method('DELETE')
                <x-button class="!bg-red-600">Delete</x-button>
            </form>
            <x-link url="{{ route('courses.index') }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                    

                    <section class="mb-8 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Course details</h3>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Title:</div>
                            <div class="max-w-prose">{{ $course->title }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Code:</div>
                            <div class="max-w-prose">{{ $course->code }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Description:</div>
                            <div class="max-w-prose">{{ $course->description }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Max trainees:</div>
                            <div class="max-w-prose">{{ $course->max_trainees }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Certification period:</div>
                            <div class="max-w-prose">{{ $course->cert_period }}</div>
                        </div>
                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-2xl text-gray-800 leading-tight">Events</h3>
                        </div>
                        <div>
                            @unless($course->events->isEmpty())
                            <table class="w-full mb-6">
                                <thead>
                                    <tr class="text-left p-2">
                                        <th class="p-2">Venue</th>
                                        <th class="p-2">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->events->sortByDesc('start_date') as $event)
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-2"><a href="{{ route('events.show', $event->id) }}" class="text-blue-400 hover:text-blue-500">{{ $event->venue->name }}</a></td>
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