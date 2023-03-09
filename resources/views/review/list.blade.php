    <div class="container">
        <h1>Список отзывов</h1>
        @foreach ($product->reviews as $review)
            <div class="card">
                <div class="card-body">
                    <p>{{ $review->text }}</p>
                </div>
            </div>
        @endforeach
    </div>
