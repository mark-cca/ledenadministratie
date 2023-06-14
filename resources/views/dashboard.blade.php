<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($boekjaren->isEmpty())
                        @role('penningmeester')
                        <div class="bg-red-500 border-l-4 text-white p-4 mb-4" role="alert">
                            <p>Let op: Er zijn geen boekjaren beschikbaar. <a href="{{ route('boekjaren.index')}}"> Klik
                                    hier </a> om de eerste aan te maken.</p>
                        </div>
                        @endrole
                        @role('secretaris')
                        @if ($boekjaren->isEmpty())
                            <div class="bg-red-800 border-l-4 text-white p-4 mb-4" role="alert">
                                <p>Let op: Er zijn geen boekjaren beschikbaar. Neem contact op met de penningmeester om
                                    een boekjaar aan te maken.</p>
                            </div>
                        @endif
                        @endrole
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ __('Huidig Boekjaar') }}</h3>
                                <p>{{ $currentBoekjaar->jaar ?? __('N/A') }}</p>
                            </div>
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ __('Aantal Families') }}</h3>
                                <p>{{ $totalFamilies }}</p>
                            </div>
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ __('Aantal Leden') }}</h3>
                                <p>{{ $totalFamilieleden }}</p>
                            </div>
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ __('Totaal Contributie') }}</h3>
                                <p>€ {{ $totalContribution }}</p>
                            </div>
                            <!-- Add more widgets here -->
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
