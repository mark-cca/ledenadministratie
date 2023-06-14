<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Familie Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Familiegegevens') }}</h3>
                    <p><span class="font-bold">{{ __('Familienaam: ') }}</span>{{ $familie->naam }}</p>
                    <p><span class="font-bold">{{ __('Adres: ') }}</span>{{ $familie->adres }}</p>
                    <p><span class="font-bold">{{ __('Aantal Leden: ') }}</span>{{ $familie->familieleden->count() }}
                    </p>
                    <p><span class="font-bold">{{ __('Totaal contributie dit jaar: ') }}</span>{{ $familie->TotalContributie }}
                    </p>




                </div>
            </div>
        </div>
    </div>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mt-8 mb-4">{{ __('Familieleden') }}</h3>
                    @role('secretaris')
                    <div class="mt-6 mb-6">
                        <x-button :url="route('familieleden.create', ['familie' => $familie->id])">
                            {{ __('Familieleden Toevoegen') }}
                        </x-button>
                    </div>
                    @endrole
                    @if ($familie->familieleden->isEmpty())
                        <p>{{ __('Er zijn nog geen familieleden.') }}</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Voornaam') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Soort Lid') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Contributie') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Leeftijd') }}</th>
                                @role('secretaris')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Acties') }}</th>
                                @endrole
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($familie->familieleden as $familielid)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familielid->naam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familielid->soortLid->naam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">€ {{ $familielid->ContributiePrijs }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familielid->leeftijd }}</td>
                                    @role('secretaris')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <x-button :url="route('familielid.edit', $familielid->id)" class="mr-1">
                                                {{ __('Bewerken') }}
                                            </x-button>
                                            <form action="{{ route('familielid.destroy', $familielid->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-800 text-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" style="margin-left: 0.5rem;">
                                                    {{ __('Verwijderen') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @endrole
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
