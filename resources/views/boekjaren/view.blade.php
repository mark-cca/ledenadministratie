<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contributies bekijken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Boekjaar') }}: {{ $boekjaar->jaar }}</h3>

                    <!-- Display the contributions -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leeftijd</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Soort Lid</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bedrag</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($contributies as $contributie)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $contributie->leeftijd }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $contributie->soortLid->naam }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $contributie->bedrag }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <x-button :url="route('boekjaren.index')" class="mr-2">
                        {{ __('Terug naar boekjaren') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
