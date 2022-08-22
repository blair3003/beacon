<x-app-layout>
    <x-slot:title>Venues</x-slot>

    <x-slot:header>
        <div class="flex items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Venues</h2>            
        </div>
        <div class="flex space-x-4 justify-end">
            <x-link url="{{ route('venues.create') }}">Create new Venue</x-link>                   
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full mb-6">
                        <thead>
                            <tr class="text-left p-2">
                                <th class="p-2">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venues as $venue)
                            <tr class="hover:bg-slate-50 border-b border-gray-200">
                                <td class="p-2"><a href="{{ route('venues.show', $venue->id) }}" class="text-blue-400 hover:text-blue-500">{{ $venue->name }}</a></td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    <div>{{ $venues->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>