<x-app-layout>
    <x-slot:title>Trainee</x-slot>

    <x-slot:header>        
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $trainee->full_name }}</h2>
        </div>
        <div class="flex space-x-4">
            <x-link url="{{ route('trainees.edit', $trainee->id) }}" class="!bg-yellow-400">Edit</x-link>
            <form method="POST" action="{{ route('trainees.show', $trainee->id) }}">
                @csrf
                @method('DELETE')
                <x-button class="!bg-red-600">Delete</x-button>
            </form>
            <x-link url="{{ route('trainees.index') }}" class="!text-black !bg-white hover:bg-slate-50">Back</x-link>                     
        </div>      
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="mb-8 pb-4 border-b border-gray-200">
                        <h3 class="mb-4 font-semibold text-2xl text-gray-800 leading-tight">Trainee details</h3>

                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Name:</div>
                            <div class="max-w-prose">{{ $trainee->full_name }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Email:</div>
                            <div class="max-w-prose">{{ $trainee->email }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Mobile:</div>
                            <div class="max-w-prose">{{ $trainee->mobile }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Tel:</div>
                            <div class="max-w-prose">{{ $trainee->tel }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Address 1:</div>
                            <div class="max-w-prose">{{ $trainee->address_1 }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Address 2:</div>
                            <div class="max-w-prose">{{ $trainee->address_2 }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Address 3:</div>
                            <div class="max-w-prose">{{ $trainee->address_3 }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">City:</div>
                            <div class="max-w-prose">{{ $trainee->city }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Country:</div>
                            <div class="max-w-prose">{{ $trainee->country }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Zip:</div>
                            <div class="max-w-prose">{{ $trainee->zip }}</div>
                        </div>
                        <div class="flex mb-1">
                            <div class="font-bold basis-1/4 shrink-0">Notes:</div>
                            <div class="max-w-prose">{{ $trainee->notes }}</div>
                        </div>
                    </section>

                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-2xl text-gray-800 leading-tight">Events</h3>
                        </div>
                        <div>
                            @unless($trainee->events->isEmpty())
                            <table class="w-full mb-6 table-fixed">
                                <thead>
                                    <tr class="text-left p-2">
                                        <th class="p-2">Course</th>
                                        <th class="p-2">Venue</th>
                                        <th class="p-2">Date</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($trainee->events as $event)
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-2"><a href="{{ route('events.show', $event->id) }}" class="text-blue-400 hover:text-blue-500">{{ $event->course->title }}</a></td>
                                        <td class="p-2">{{ ($event->venue->name) ?? '' }}</td> 
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

                    @if($trainee->isTrainer())
                    <section class="mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-2xl text-gray-800 leading-tight">Trainer events</h3>
                        </div>
                        <div>
                            @unless($trainee->trainer->events->isEmpty())
                            <table class="w-full mb-6 table-fixed">
                                <thead>
                                    <tr class="text-left p-2">
                                        <th class="p-2">Course</th>
                                        <th class="p-2">Venue</th>
                                        <th class="p-2">Date</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($trainee->trainer->events as $event)
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-2"><a href="{{ route('events.show', $event->id) }}" class="text-blue-400 hover:text-blue-500">{{ $event->course->title }}</a></td>
                                        <td class="p-2">{{ ($event->venue->name) ?? '' }}</td> 
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
                    @endif

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

                                        <input type="hidden" name="documentable_type" value="App\Models\Trainee">
                                        <input type="hidden" name="documentable_id" value="{{ $trainee->id }}">
                                        
                                    </div>

                                    <x-button>Add document</x-button>
                                </div>
                            </form>
                            
                        </div>
                        <div>
                            @unless($trainee->documents->isEmpty())
                            <table class="w-full mb-6 table-fixed">
                                <thead>
                                    <tr class="text-left p-2">
                                        <th class="p-2">Title</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @foreach($trainee->documents as $document)
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