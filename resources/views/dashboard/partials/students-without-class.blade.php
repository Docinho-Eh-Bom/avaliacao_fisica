@if($studentsWithoutClass->count())
<x-section-card>
    <h2 class="font-bold text-lg mb-4 text-white">
        Alunos não inseridos em uma turma:
        <span class="text-white">
            {{ $studentsWithoutClass->count() }}
        </span>
    </h2>


    <div class="max-h-64 overflow-y-auto pr-2 custom-scrollbar">
        <ul class="space-y-2">
            @foreach($studentsWithoutClass as $student)
                <li class="px-3 py-2 rounded-md font-semibold text-xl text-gray-200" style="background-color: #374151">
                    {{ $student->name }}
                </li>
            @endforeach
        </ul>
    </div>
</x-section-card>
@endif
