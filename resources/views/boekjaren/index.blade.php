<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contributies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($boekjaren->isEmpty())
                        <p>Er zijn nog geen boekjaren beschikbaar. Vraag de penningmeester om er een toe te voegen.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jaar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th> <!-- Add column for actions -->
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($boekjaren as $boekjaar)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $boekjaar->jaar }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @role('penningmeester')
                                        <x-button :url="route('contributions.edit', $boekjaar->id)" class="mr-2">
                                            {{ __('Bewerk contributies') }}
                                        </x-button>
                                        <x-button :url="route('contributions.view', $boekjaar->id)">
                                            {{ __('Bekijk contributies') }}
                                        </x-button>
                                        @endrole
                                        @role('secretaris')
                                        <x-button :url="route('contributions.view', $boekjaar->id)">
                                            {{ __('Bekijk contributies') }}
                                        </x-button>
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                    @role('penningmeester')

                    <h3 class="font-semibold text-lg mt-8 mb-4">Nieuw boekjaar toevoegen</h3>

                    <form action="{{ route('boekjaren.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="jaar" class="block text-sm font-medium text-gray-700">Jaar</label>
                            <div class="mt-1">
                                <input type="number" name="jaar" id="jaar" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Voeg boekjaar toe') }}</x-primary-button>

                                @if (session('success'))
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Instellingen opgeslagen.') }}</p>
                                @endif
                            </div>
                        </div>
                    </form>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
