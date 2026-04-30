@extends('layouts.app')

@section('content')
<h1>{{ $student->name }}</h1>

<p>Idade:{{ $student->age }}</p>
<p>Sexo:{{ $student->gender }}</p>

<a href="{{ route('students.batteries.create', $student) }}">Adicionar bateria de testes</a>

<ul>
    @foreach ($student->batteries as $battery)
        <li>
            <a href="{{ route('batteries.show', $battery) }}"> {{ $battery->year }}</a>
        </li>
    @endforeach
</ul>
@endsection
