<x-section-card>
    <h2 class="font-bold text-lg mb-4 text-white">Resumo da Comparação</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <p class="text-sm text-white">Aumento no Resultado</p>
            <p class="text-3xl font-bold text-gray-400">{{ $improved }}</p>
        </div>

        <div>
            <p class="text-sm text-white">Sem alteração</p>
            <p class="text-3xl font-bold text-gray-400">{{ $same }}</p>
        </div>

        <div>
            <p class="text-sm text-white">Redução no Resultado</p>
            <p class="text-3xl font-bold text-gray-400">{{ $worse }}</p>
        </div>
    </div>
</x-section-card>
