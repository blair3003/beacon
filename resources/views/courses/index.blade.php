<x-app-layout>
    <x-slot:title>Courses</x-slot>

    <x-slot:header>
        <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight">Courses</h2>
        <x-link url="{{ route('courses.create') }}">Create new Course</x-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full mb-6">
                        <thead>
                            <tr class="text-left p-2">
                                <th class="p-2">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr class="hover:bg-slate-50 border-b border-gray-200">
                                <td class="p-2"><a href="{{ route('courses.show', $course->id) }}" class="text-blue-400 hover:text-blue-500">{{ $course->title }}</a></td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    <div>{{ $courses->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>