@extends('layouts.app')

@section('content')
    <h1>Популярные категории</h1>
    @foreach ($popularCategories as $popularCategory)
        <div>
            <span>{{ $popularCategory->name }}</span>
            <span>{{ $popularCategory->reviews_count }}</span>
        </div>
    @endforeach
@endsection
