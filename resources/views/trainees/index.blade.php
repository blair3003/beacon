<x-app-layout>
    <x-slot:title>Trainees</x-slot>

    <x-slot:header>
        <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight">Trainees</h2>
        <x-link url="{{ route('trainees.create') }}">Create new Trainee</x-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full table-fixed mb-6">
                        <thead>
                            <tr class="text-left p-2">
                                <th class="p-2">Name</th>
                                <th class="p-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainees as $trainee)
                            <tr class="hover:bg-slate-50">
                                <td class="p-2"><a href="{{ route('trainees.show', $trainee->id) }}" class="text-blue-400 hover:text-blue-500">{{ $trainee->full_name }}</a></td>
                                <td class="p-2"><a href="mailto:{{ $trainee->email }}" class="text-blue-400 hover:text-blue-500">{{ $trainee->email }}</a></td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    <div>{{ $trainees->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>