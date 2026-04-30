@extends

@endsection('layouts.app')

@section('content')
<h1>Bateria de testes {{ $battery->year }}</h1>

<a href="{{ route('batteries.results.create', $battery) }}">Adicionar resultado</a>

<ul>
    @foreach ($battery->results as $result)
        <li>
            {{ $result->testType->name }}
            {{ $result->value }}
        </li>
    @endforeach
</ul>

@endsection
