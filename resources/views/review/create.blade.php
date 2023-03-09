@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить отзыв</h1>
        @if ($errors->any())
            <div class="alert alert-danger">Ошибка отправки отзыва</div>
        @endif
        <form method="POST" action="{{ route('reviews.store', $product->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">Текст отзыва</label>
                <textarea class="form-control" id="text" name="text" rows="3" required>{{ old('text') }}</textarea>
            </div>
            <div class="form-group">
                <label for="images">Картинки</label>
                <input type="file" class="form-control-file" id="images" name="images[]" multiple accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection
