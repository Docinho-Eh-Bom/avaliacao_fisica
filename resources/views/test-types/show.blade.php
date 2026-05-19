<x-app-layout>
    <x-slot name="header">
        <x-page-title>
            {{ $type->name }}
        </x-page-title>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow rounded p-6">

                <p>
                    <strong>Unidade:</strong>
                    {{ $type->unit }}
                </p>

                <p class="mt-2">
                    <strong>Tipo:</strong>
                    {{ $type->calc_type }}
                </p>

                @if ($type->calc_key)
                    <p class="mt-2">
                        <strong>Calc Key:</strong>
                        {{ $type->calc_key }}
                    </p>
                @endif

                <p class="mt-2">
                    <strong>Status:</strong>

                    @if ($type->is_active)
                        <span class="text-green-600">
                            Ativo
                        </span>
                    @else
                        <span class="text-red-600">
                            Inativo
                        </span>
                    @endif
                </p>

            </div>

        </div>
    </div>
</x-app-layout>
