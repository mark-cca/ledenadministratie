<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Familielid Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Nieuw Familielid') }}</h3>

                    <form method="post" action="{{ route('familieleden.store', $familie) }}" class="mt-6 space-y-6">
                        @csrf

                        <div class="mb-4">
                            <label for="naam" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Roepnaam') }}</label>
                            <input type="text" name="naam" id="naam" class="form-input rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="geboortedatum" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Geboortedatum') }}</label>
                            <input type="date" name="geboortedatum" id="geboortedatum" class="form-input rounded-md shadow-sm" required>
                        </div>


                        <div class="flex items-center justify-end">
                            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
