<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instellingen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Globale Instellingen') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Wijzig de globale instellingen.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('settings.update') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="standaard_contributie" :value="__('Standaard Contributie')" />
                                <x-text-input id="standaard_contributie" name="standaard_contributie" type="number" step="0.01" class="mt-1 block w-full" :value="$settings->standaard_contributie ?? ''" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('standaard_contributie')" />
                            </div>



                            <div>
                                <x-input-label for="jeugd_korting" :value="__('Jeugd Korting')" />
                                <x-text-input id="jeugd_korting" name="jeugd_korting" type="number" step="0.01" class="mt-1 block w-full" :value="$settings->jeugd_korting ?? ''" required />
                                <x-input-error class="mt-2" :messages="$errors->get('jeugd_korting')" />
                            </div>

                            <div>
                                <x-input-label for="aspirant_korting" :value="__('Aspirant Korting')" />
                                <x-text-input id="aspirant_korting" name="aspirant_korting" type="number" step="0.01" class="mt-1 block w-full" :value="$settings->aspirant_korting ?? ''" required />
                                <x-input-error class="mt-2" :messages="$errors->get('aspirant_korting')" />
                            </div>

                            <div>
                                <x-input-label for="junior_korting" :value="__('Junior Korting')" />
                                <x-text-input id="junior_korting" name="junior_korting" type="number" step="0.01" class="mt-1 block w-full" :value="$settings->junior_korting ?? ''" required />
                                <x-input-error class="mt-2" :messages="$errors->get('junior_korting')" />
                            </div>

                            <div>
                                <x-input-label for="senior_korting" :value="__('Senior Korting')" />
                                <x-text-input id="senior_korting" name="senior_korting" type="number" step="0.01" class="mt-1 block w-full" :value="$settings->senior_korting ?? ''" required />
                                <x-input-error class="mt-2" :messages="$errors->get('senior_korting')" />
                            </div>

                            <div>
                                <x-input-label for="oudere_korting" :value="__('Oudere Korting')" />
                                <x-text-input id="oudere_korting" name="oudere_korting" type="number" step="0.01" class="mt-1 block w-full" :value="$settings->oudere_korting ?? ''" required />
                                <x-input-error class="mt-2" :messages="$errors->get('oudere_korting')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

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
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
