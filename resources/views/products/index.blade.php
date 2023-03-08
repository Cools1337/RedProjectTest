@extends('layouts.app')
@php
    $user = Auth::user();
    
@endphp
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-favorites').click(function(e) {
            e.preventDefault();
            var button = $(this);
            var productId = button.attr('data-product-id');
            var url = button.attr('data-url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept' : 'application/json'
                },
                data: {
                    'product_id': productId
                },
                success: function(response) {
                    console.log(button.text())
                    if (button.text() === 'Удалить из избранного') {
                        button.text('Добавить в избранное');
                    } else {
                        button.text('Удалить из избранного');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img alt="{{ $product->name }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            @foreach ($product->categories as $category)
                                <h6 class="card-subtitle mb-2 text-muted">{{ $category->name }}</h6>
                            @endforeach
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Подробнее</a>
                            <button class="btn btn-outline-primary toggle-favorites" data-product-id="{{ $product->id }}"
                                data-url="{{ route('favorites.toggle') }}">{{ $user->isFavorite($product) ? 'Удалить из избранного' : 'Добавить в избранное' }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
