<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-page-title>{{ $type->name }}</x-page-title>

            <a href="{{ route('test-types.index') }}">
                <x-secondary-button>Voltar</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 ">
                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Unidade</p>

                    <h3 class="text-2xl font-bold dark:text-gray-100 mt-2">{{ $type->unit ?? '-' }}</h3>
                </x-section-card>

                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>

                    <h3 class="text-2xl font-bold mt-2">
                        @if($type->is_active)
                            <span class="text-green-500">Ativo</span>
                        @else
                            <span class="text-red-500">Inativo</span>
                        @endif
                    </h3>
                </x-section-card>
            </div>

            <x-section-card>
                <h3 class="text-lg font-semibold dark:text-gray-100 mb-4">Descrição do teste</h3>

                @if($type->description)
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $type->description }}</p>
                @else
                    <p class="text-gray-400">Nenhuma descrição cadastrada.</p>
                @endif
            </x-section-card>

            <x-section-card>
                <h3 class="text-lg font-semibold dark:text-gray-100 mb-4">Demonstração</h3>

                @if($type->video_url)
                    <iframe
                        src="{{ $type->video_url }}"
                        class="w-full rounded-lg"
                        style="height: 600px;"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                @else
                    <p class="text-gray-400">Nenhum vídeo cadastrado.</p>
                @endif
            </x-section-card>
        </div>

    </div>
</x-app-layout>
