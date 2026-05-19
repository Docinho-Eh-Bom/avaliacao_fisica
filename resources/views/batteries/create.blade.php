<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <x-page-title>
                Criar Bateria
            </x-page-title>

            <a href="{{ route('students.show', $student) }}">
                <x-secondary-button>
                    Voltar
                </x-secondary-button>
            </a>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <x-section-card>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold dark:text-gray-100">
                        {{ $student->name }}
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Criar nova bateria de testes
                    </p>
                </div>

                <form
                    action="{{ route('students.batteries.store', $student) }}"
                    method="POST"
                    class="space-y-6"
                >
                    @csrf

                    <div>
                        <x-input-label
                            for="year"
                            value="Ano da avaliação"
                        />

                        <x-text-input
                            id="year"
                            name="year"
                            type="number"
                            class="mt-1 block w-full"
                            :value="old('year', now()->year)"
                            min="2000"
                            max="{{ date('Y') }}"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('year')"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            Criar bateria
                        </x-primary-button>
                    </div>

                </form>

            </x-section-card>
        </div>
    </div>
</x-app-layout>
