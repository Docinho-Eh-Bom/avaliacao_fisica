<div class="space-y-3">
    @foreach($results as $result)
        <div class="flex justify-between items-center
                    border-b border-gray-200
                    dark:border-gray-700
                    pb-2">

            <div>
                <p class="font-medium dark:text-white">{{ $result->name ?? $result->testType->name }}</p>

                <p class="text-sm dark:text-gray-200">
                    {{ $result->value ?? $result->final_value ?? '-' }}
                    {{ $result->unit ?? $result->testType->unit  ?? ''}}
                </p>
            </div>

            <span class="
                px-3 py-1
                rounded-full
                text-sm
                font-medium
                text-gray-300
            ">
                {{ $result->classification_label ?? 'Sem Resultado'}}
            </span>
        </div>
    @endforeach
</div>
