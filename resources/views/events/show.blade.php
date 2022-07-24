<x-app-layout>
    <x-slot:title>Event</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $event->course->title }}, {{ $event->full_dates }}</h2>            
        </div>
        <div class="flex space-x-4">
            <x-link url="{{ route('events.edit', $event->id) }}" class="!bg-yellow-400">Edit</x-link>

            <form method="POST" action="{{ route('events.show', $event->id) }}">
                @csrf
                @method('DELETE')
                <x-button class="!bg-red-600">Delete</x-button>
            </form>

            <x-link url="{{ route('events.index') }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="mb-8 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Event details</h3>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Course:</div>
                            <div class="max-w-prose"><a href="{{ route('courses.show', $event->course->id)}}" class="text-blue-400 hover:text-blue-500">{{ $event->course->title }}</a></div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Venue:</div>
                            <div class="max-w-prose">
                                @unless($event->venue->doesntExist())
                                <a href="{{ route('venues.show', $event->venue->id)}}" class="text-blue-400 hover:text-blue-500">{{ $event->venue->name }}</a>
                                @endunless
                            </div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Start Date:</div>
                            <div class="max-w-prose">{{ $event->start_date->toFormattedDateString() }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Start Time:</div>
                            <div class="max-w-prose">{{ $event->start_time }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">End Date:</div>
                            <div class="max-w-prose">{{ $event->end_date->toFormattedDateString() }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">End Time:</div>
                            <div class="max-w-prose">{{ $event->end_time }}</div>
                        </div>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Notes:</div>
                            <div class="max-w-prose">{{ $event->notes }}</div>
                        </div>

                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-2">
                            <div class="flex">
                                <h3 class="font-semibold text-2xl text-gray-800 leading-tight">Trainees</h3>            
                            </div>
                            <div class="flex space-x-4">
                                <x-link url="{{ route('events.trainees.create', $event) }}">Add Trainee</x-link>
                            </div>
                        </div>
                        <div>
                            @unless($event->trainees->isEmpty())
                            <table class="w-full mb-6 table-fixed">
                                <thead class="text-left">
                                    <tr class="text-left p-2">
                                        <th class="p-2">Name</th>
                                        <th class="p-2">Email</th>
                                        <th class="p-2">Certificate</th>
                                        <th class="p-2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->trainees->sortBy('last_name') as $trainee)
                                    <tr class="hover:bg-slate-50 border-b border-gray-200">
                                        <td class="p-2"><a href="{{ route('trainees.show', $trainee) }}" class="text-blue-400 hover:text-blue-500">{{ $trainee->full_name }}</a></td>
                                        <td class="p-2"><a href="mailto:{{ $trainee->email }}" class="text-blue-400 hover:text-blue-500">{{ $trainee->email }}</a></td>
                                        <td class="flex items-center p-2">




                                            @php
                                            $certificate = $event->certificates->first(function ($certificate) use ($trainee) {
                                                return $certificate->trainee->id == $trainee->id;
                                            });
                                            @endphp


                                            
                                            @unless($certificate)
                                            <form method="POST" action="{{ route('certificates.store') }}">
                                                @csrf
                                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                <input type="hidden" name="trainee_id" value="{{ $trainee->id }}">
                                                <x-button class="!bg-green-500 !hover:bg-green-600">Award certificate</x-button>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('certificates.destroy', $certificate) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-button class="!bg-orange-500 !hover:bg-orange-600">Revoke certificate</x-button>
                                            </form>
                                            @endunless
                                        </td>
                                        <td class="text-right p-2">
                                            <form method="POST" action="{{ route('events.trainees.destroy', [$event, $trainee]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-button class="!bg-red-600">Remove Trainee</x-button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No trainees added yet.</p>
                            @endunless

                        </div>                       
                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-2">
                            <div class="flex">
                                <h3 class="font-semibold text-2xl text-gray-800 leading-tight">Trainers</h3>            
                            </div>
                            <div class="flex space-x-4">
                                <x-link url="{{ route('events.trainers.create', $event) }}">Add Trainer</x-link>
                            </div>
                        </div>
                        <div>
                            @unless($event->trainers->isEmpty())
                            <table class="w-full mb-6 table-fixed">
                                <thead class="text-left">
                                    <tr class="text-left p-2">
                                        <th class="p-2">Name</th>
                                        <th class="p-2">Email</th>
                                        <th class="p-2"></th>
                                        <th class="p-2"></th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    @foreach($event->trainers->sortBy('trainee.last_name') as $trainer)
                                    <tr class="hover:bg-slate-50 border-b border-gray-200">
                                        <td class="p-2"><a href="{{ route('trainees.show', $trainer->trainee) }}" class="text-blue-400 hover:text-blue-500">{{ $trainer->trainee->full_name }}</a></td>
                                        <td class="p-2"><a href="mailto:{{ $trainer->trainee->email }}" class="text-blue-400 hover:text-blue-500">{{ $trainer->trainee->email }}</a></td>
                                        <td class="p-2"></td>
                                        <td class="p-2 text-right">
                                            <form method="POST" action="{{ route('events.trainers.destroy', [$event, $trainer]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-button class="!bg-red-600">Remove Trainer</x-button>
                                            </form>                                          


                                        </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No trainers added yet.</p>
                            @endunless

                        </div>                       
                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-2">
                            <h3 class="font-semibold text-2xl text-gray-800 leading-tight">Documents</h3>
                            
                            <form method="POST" action="{{ route('documents.index') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="flex">

                                    <div class="flex items-center">
                                        <input type="file" name="document" class="mr-6 file:text-black file:bg-white hover:file:bg-slate-100 file:mr-5 file:hover:opacity-90 file:font-bold file:py-2 file:px-4 file:rounded file:border-1 file:border-solid file:border-gray-200 file:cursor-pointer file:text-sm" required>
                                        @error('document')
                                        <p class="text-red-700 font-semibold">{{ $message }}</p>
                                        @enderror

                                        <input type="hidden" name="documentable_type" value="App\Models\Event">
                                        <input type="hidden" name="documentable_id" value="{{ $event->id }}">
                                        
                                    </div>

                                    <x-button>Add document</x-button>
                                </div>
                            </form>
                            
                        </div>
                        <div>
                            @unless($event->documents->isEmpty())
                            <table class="w-full mb-6 table-fixed">
                                <thead>
                                    <tr class="text-left p-2">
                                        <th class="p-2">Title</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($event->documents as $document)
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-2"><a href="{{ url("/storage/$document->path") }}" target="_blank" class="text-blue-400 hover:text-blue-500">{{ $document->title }}</a></td>
                                    </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                            @else
                            <p>No documents yet.</p>
                            @endunless
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>