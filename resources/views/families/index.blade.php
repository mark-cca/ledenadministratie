<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht van Families') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Families') }}</h3>

                    @if ($families->isEmpty())
                        <p>{{ __('Er zijn nog geen families.') }}</p>

                    @else
                        @role('secretaris')
                        <div class="mt-6 mb-6">
                            <x-button :url="route('families.create')">
                                {{ __('Familie Toevoegen') }}
                            </x-button>
                        </div>
                        @endrole
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Naam') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Adres') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Aantal Leden') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Totaal contributie') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Acties') }}</th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($families as $familie)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familie->naam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familie->adres }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $familie->familieleden->count() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">€ {{ $familie->TotalContributie }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <x-button :url="route('families.show', $familie->id)" class="mr-1">
                                                {{ __('Bekijken') }}
                                            </x-button>
                                            @role('secretaris')
                                            <x-button :url="route('families.edit', $familie->id)" class="mr-1">
                                                {{ __('Bewerken') }}
                                            </x-button>
                                            <form action="{{ route('families.destroy', $familie->id) }}" method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-800 text-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                                        style="margin-left: 0.5rem;">
                                                    {{ __('Verwijderen') }}
                                                </button>
                                            </form>
                                            @endrole
                                        </div>
                                    </td>


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
