<x-app-layout>
    <x-slot:title>Dashboard</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">



                    {{-- Search box to be made a component/partial --}}

                    <form action="/search" method="GET">
                        <input type="text" name="q" required>
                        <button type="submit">Search</button>
                    </form>
                    






                </div>
            </div>
        </div>
    </div>
</x-app-layout>
