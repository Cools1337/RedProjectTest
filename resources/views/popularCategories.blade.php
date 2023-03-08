@extends('layouts.app')

@section('content')
    <h1>Популярные категории</h1>
    @foreach ($popularCategories as $popularCategory)
        <div>
            <a href="{{ route('categories.show', $popularCategory->category_id) }}">{{ $popularCategory->category->name }}</a>
            <span>{{ $popularCategory->reviews_count }}</span>
        </div>
    @endforeach
@endsection
