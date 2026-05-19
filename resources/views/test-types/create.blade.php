<x-app-layout>
    <x-slot name="header">
        <x-page-title>
            Criar Tipo de Teste
        </x-page-title>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow rounded p-6">

                <form action="{{ route('test-types.store') }}"
                      method="POST">

                    @csrf

                    <div>
                        <label class="block font-medium">
                            Nome
                        </label>

                        <input type="text"
                               name="name"
                               class="border rounded w-full mt-1">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium">
                            Unidade
                        </label>

                        <input type="text"
                               name="unit"
                               class="border rounded w-full mt-1">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium">
                            Tipo de cálculo
                        </label>

                        <select name="calc_type"
                                class="border rounded w-full mt-1">

                            <option value="direct">
                                Direto
                            </option>

                            <option value="derived">
                                Derivado
                            </option>

                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium">
                            Calc Key
                        </label>

                        <input type="text"
                               name="calc_key"
                               class="border rounded w-full mt-1">
                    </div>

                    <button type="submit"
                            class="mt-6 bg-blue-500 text-white px-4 py-2 rounded">
                        Salvar
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
