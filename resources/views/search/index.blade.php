@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Результаты поиска для "{{ $query }}"</h1>
        <ul>
            @foreach ($results as $result)
                <li>{{ $result }}</li>
            @endforeach
        </ul>
    </div>
@endsection
