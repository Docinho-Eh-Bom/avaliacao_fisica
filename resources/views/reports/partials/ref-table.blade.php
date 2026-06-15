@if($result->referenceValues->count())
<div class="mt-3">
    <div class="grid grid-cols-5 gap-2 text-center">
        <div class="font-semibold text-sm dark:text-white">Fraco</div>

        <div class="font-semibold text-sm dark:text-white">Razoável</div>

        <div class="font-semibold text-sm dark:text-white">Bom</div>

        <div class="font-semibold text-sm dark:text-white">Muito Bom/div>

        <div class="font-semibold text-sm dark:text-white">Excelente</div>

        @foreach($result->referenceValues as $ref)
            <div class="
                rounded-lg
                p-2
                text-center
                text-base
                border

                {{ $result->classification === $ref->label
                    ? 'bg-blue-100 border-blue-500 font-bold dark:bg-blue-900'
                    : 'border-gray-300 dark:border-gray-700'
                }}
            ">
                @if($ref->label === 'weak')
                    < {{ $ref->max_value }}

                @elseif($ref->label === 'excellent')
                    ≥ {{ $ref->min_value }}

                @else
                    {{ $ref->min_value }} - {{ $ref->max_value }}
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif
