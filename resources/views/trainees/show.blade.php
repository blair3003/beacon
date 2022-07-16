<x-app-layout>
    <x-slot:title>Trainee</x-slot>

    <x-slot:header>
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $trainee->full_name }}</h2>            
        </div>
        <div class="flex space-x-4">
            <a class="bg-yellow-300 hover:bg-yellow-500 font-bold py-2 px-4 rounded" href="{{ route('trainees.edit', $trainee) }}">Edit</a>
            <form method="POST" action="{{ route('trainees.show', $trainee) }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-300 hover:bg-red-500 font-bold py-2 px-4 rounded" type="submit">Delete</button>
            </form>
            <a class="bg-white hover:bg-slate-50 font-bold py-2 px-4 rounded" href="{{ route('trainees.index') }}">Back</a>
        </div>        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="mb-2 font-semibold text-lg text-gray-800 leading-tight">Trainee details</h3>
                        <div>
                            <strong>Name:</strong> {{ $trainee->full_name }}
                        </div>
                        <div>
                            <strong>Email:</strong> {{ $trainee->email }}
                        </div>
                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-lg text-gray-800 leading-tight">Event details</h3>
                        </div>
                        <div>
                            @unless($trainee->events->isEmpty())
                            <table class="w-full table-fixed">
                                <thead class="text-left">
                                    <tr>
                                        <th class="w-1/4">Event</th>
                                        <th>Date</th>
                                        <th>Certified?</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($trainee->events as $event)
                                    <tr>
                                        <td><a href="{{ route('events.show', $event) }}">{{ $event->course->title }}</a></td>
                                        <td>{{ $event->start_date }} - {{ $event->end_date}}</td>
                                        <td>
                                            @php
                                            $certificate = $event->certificates->first(function ($certificate) use ($trainee) {
                                                return $certificate->trainee->id == $trainee->id;
                                            });
                                            @endphp
                                            {{ ($certificate) ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>                            
                            @else
                            <p>No events yet.</p>
                            @endunless
                        </div>
                    </section>

                    @if($trainee->isTrainer())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-lg text-gray-800 leading-tight">Trainer details</h3>
                        </div>
                        <div>
                            @unless($trainee->trainer->events->isEmpty())
                            <table class="w-full table-fixed">
                                <thead class="text-left">
                                    <tr>
                                        <th class="w-1/4">Event</th>
                                        <th>Date</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($trainee->trainer->events as $event)
                                    <tr>
                                        <td><a href="{{ route('events.show', $event) }}">{{ $event->course->title }}</a></td>
                                        <td>{{ $event->start_date }} - {{ $event->end_date}}</td>
                                    </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                            @else
                            <p>No events yet.</p>
                            @endunless
                        </div>
                    </section>
                    @endif

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

                                <input type="hidden" name="documentable_type" value="App\Models\Trainee">
                                <input type="hidden" name="documentable_id" value="{{ $trainee->id }}">

                                <button type="submit">Add document</button>
                            </form>
                        </div>
                        <div>
                            @unless($trainee->documents->isEmpty())
                            <table class="w-full table-fixed">
                                <thead class="text-left">
                                    <tr>
                                        <th class="w-1/4">Document</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($trainee->documents as $document)
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