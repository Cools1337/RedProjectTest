@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Review</h1>
    <form method="POST" action="{{ route('reviews.store', $product->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="text">Review Text</label>
            <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
