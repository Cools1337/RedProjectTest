@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Результаты поиска для "{{ $query }}"</h1>
        <ul>
            @foreach ($results as $result)
                @if ($result instanceof App\Models\Product)
                    <li>{{ $result->title }}</li>
                @elseif ($result instanceof App\Models\Category)
                    <li>{{ $result->name }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection

