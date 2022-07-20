<x-app-layout>
    <x-slot:title>Trainers</x-slot>

    <x-slot:header>
        <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight">Trainers</h2>
        <x-link url="{{ route('trainers.create') }}">Create new Trainer</x-link>
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
                            @foreach($trainers as $trainer)
                            <tr class="hover:bg-slate-50">
                                <td class="p-2"><a href="{{ route('trainees.show', $trainer->trainee->id) }}" class="text-blue-400 hover:text-blue-500">{{ $trainer->trainee->full_name }}</a></td>
                                <td class="p-2"><a href="mailto:{{ $trainer->trainee->email }}" class="text-blue-400 hover:text-blue-500">{{ $trainer->trainee->email }}</a></td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    <div>{{ $trainers->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>