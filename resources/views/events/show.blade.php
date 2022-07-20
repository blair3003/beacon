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
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-2 font-semibold text-lg text-gray-800 leading-tight">Event details</h3>
                        <div>
                            <strong>Course:</strong> <a href="/courses/{{  $event->course->id }}">{{ $event->course->title }}</a>
                        </div>
                        <div>
                            <strong>Venue:</strong> <a href="/venues/{{ ($event->venue->id) ?? '' }}">{{ ($event->venue->name) ?? '' }}</a>
                        </div>
                        <div>
                            <strong>Start Date:</strong> {{ $event->start_date->toFormattedDateString() }}
                        </div>
                        <div>
                            <strong>Start Time:</strong> {{ $event->start_time }}
                        <div>
                            <strong>End Date:</strong> {{ $event->end_date->toFormattedDateString() }}
                        </div>
                        <div>
                            <strong>End Time:</strong> {{ $event->end_time }}
                        </div>
                        <div>
                            <strong>Notes:</strong> {{ $event->notes }}
                        </div>                        
                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-2">
                            <h3 class="font-semibold text-lg text-gray-800 leading-tight">Trainees</h3>
                            <a class="bg-blue-300 hover:bg-blue-500 font-bold py-2 px-4 rounded" href="{{ route('events.trainees.create', $event) }}">Add Trainee</a>

                        </div>
                        <div>
                            @unless($event->trainees->isEmpty())
                            <table class="w-full table-fixed">
                                <thead class="text-left">
                                    <tr>
                                        <th class="w-1/4">Name</th>
                                        <th>Email</th>
                                        <th>Certificate</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->trainees as $trainee)
                                    <tr>
                                        <td><a href="{{ route('trainees.show', $trainee) }}">{{ $trainee->full_name }}</a></td>
                                        <td>{{ $trainee->email }}</td>
                                        <td class="flex items-center">


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
                                                <button class="bg-green-300 hover:bg-green-500 font-bold py-2 px-4 rounded" type="submit">Award certificate</button>
                                            </form> 


                                            @else



                                            Certified
                                            <form method="POST" action="{{ route('certificates.destroy', $certificate) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-blue font-bold py-2 px-4 rounded" type="submit">(Cancel)</button>
                                            </form>
                                            @endunless





                                        </td>
                                        <td class="text-right">
                                            <form method="POST" action="{{ route('events.trainees.destroy', [$event, $trainee]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-300 hover:bg-red-500 font-bold py-2 px-4 rounded" type="submit">X</button>
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
                            <h3 class="font-semibold text-lg text-gray-800 leading-tight">Trainers</h3>
                            <a class="bg-blue-300 hover:bg-blue-500 font-bold py-2 px-4 rounded" href="{{ route('events.trainers.create', $event) }}">Add Trainer</a>

                        </div>
                        <div>
                            @unless($event->trainers->isEmpty())
                            <table class="w-full table-fixed">
                                <thead class="text-left">
                                    <tr>
                                        <th class="w-1/4">Name</th>
                                        <th>Email</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($event->trainers as $trainer)
                                    <tr>
                                        <td><a href="{{ route('trainees.show', $trainer->trainee) }}">{{ $trainer->trainee->full_name }}</a></td>
                                        <td>{{ $trainer->trainee->email }}</td>
                                        <td></td>
                                        <td class="text-right">
                                            <form method="POST" action="{{ route('events.trainers.destroy', [$event, $trainer]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-300 hover:bg-red-500 font-bold py-2 px-4 rounded" type="submit">X</button>
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
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-lg text-gray-800 leading-tight">Documents</h3>
                        </div>
                        <div>

                             <form method="POST" action="/documents" enctype="multipart/form-data">
                                @csrf

                                <input type="file" name="document">
                                @error('document')
                                <p class="text-red-700 font-semibold">{{ $message }}</p>
                                @enderror

                                <input type="hidden" name="documentable_type" value="App\Models\Event">
                                <input type="hidden" name="documentable_id" value="{{ $event->id }}">

                                <button type="submit">Add document</button>
                            </form>
                        </div>
                        <div>
                            @unless($event->documents->isEmpty())
                            <table class="w-full table-fixed">
                                <thead class="text-left">
                                    <tr>
                                        <th class="w-1/4">Document</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($event->documents as $document)
                                    <tr>
                                        <td><a href="#">{{ $document->title }}</a></td>
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