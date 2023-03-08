


    <form method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="form-group">
            <label for="review_text">Review text</label>
            <textarea name="review_text" class="form-control" id="review_text" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="images">Review images</label>
            <div class="dropzone" id="myDropzone"></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            let myDropzone = new Dropzone("#myDropzone", {
                url: "",
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dictDefaultMessage: "Drop your images here or click to upload",
                maxFiles: 3,
                maxFilesize: 5, // in MB
                acceptedFiles: ".jpeg,.jpg,.png",
                parallelUploads: 3,
            });
            myDropzone.on("sending", function(file, xhr, formData) {
                formData.append('product_id', $('input[name="product_id"]').val());
                formData.append('review_text', $('textarea[name="review_text"]').val());
            });
        });
    </script>
{{-- <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="form-group">
        <label for="review_text">Review text</label>
        <textarea name="review_text" class="form-control" id="review_text" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="images">Review images</label>
        <div class="dropzone" id="myDropzone"></div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form> --}}
