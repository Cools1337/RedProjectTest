@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <img alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->title }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text"><strong>Цена:</strong> ${{ $product->price }}</p>
                <p class="card-text"><strong>Категория:</strong> {{ $product->categories()->first()->name }}</p>
            </div>
        </div>
        @include('review.list')
    </div>
@endsection
