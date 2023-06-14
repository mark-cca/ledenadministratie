<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contributies bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Boekjaar') }}: {{ $boekjaar->jaar }}</h3>

                    @if (session('success'))
                        <div
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="text-sm text-green-600 p-6 "
                        >{{ __('Contributie bijgewerkt.') }}</div>
                    @endif

                    <!-- Display the editable contributions -->


                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Leeftijd
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Soort Lid
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bedrag
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actie
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Move the opening form tag inside the foreach loop -->
                        @foreach ($contributies as $contributie)
                            <form method="POST" action="{{ route('contributions.update', $contributie->id) }}">
                                @csrf
                                @method('PUT')
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $contributie->leeftijd }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $contributie->soortLid->naam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="number" name="bedrag" value="{{ $contributie->bedrag }}"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button type="submit"
                                                class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Opslaan') }}
                                        </button>

                                    </td>
                                </tr>
                            </form>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
