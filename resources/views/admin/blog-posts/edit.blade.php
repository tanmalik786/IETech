@extends('admin.layout.app')

@section('page-title')
    Update Blog Post
@endsection
@push('page-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.css">
@endpush
@section('content')
    <section class="content pl-3 pr-3">
        <!-- Left Column (8) - Title and Body -->
        <div class="row">
            <form method="POST" action="{{route('admin.blog-posts.update', ['post' => $post->id])}}" enctype="multipart/form-data" class="card">
                <div class="card-header text-right">
                    <a href="{{route('admin.blog-posts')}}" class="btn btn-outline-secondary">Cancel</a>
                    <button class="btn btn-primary">Update Post</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10" style="max-height: 550px;overflow-y: scroll ">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Excerpt (150 characters maximum) <span class="text-danger">*</span></label>
                                <textarea maxlength="150" class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $post->excerpt) }}</textarea>
                                @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="body">Body <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{!! old('content', $post->content) !!}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <!-- Image Preview Placeholder -->
                                <label for="featured_image">Featured Image <span class="text-danger">*</span></label>
                                <input type="file" accept="image/*" class="form-control @error('featured_image') is-invalid @enderror" name="featured_image" id="featured_image">
                                @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="image-preview" class="text-center">
                                    @if( $post->featuredImage )
                                    <img src="{{  asset('storage/blog-posts/featured-image/' . $post->featuredImage->file_name) }}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                    @else
                                        <img src="" alt="Image Preview" style="max-width: 100%; max-height: 200px; display: none;">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.js"></script>
    <script>
      $(document).ready(function() {
        $('#content').summernote({
          minHeight: 400,
        });

      });
    </script>
    <!-- JavaScript for Image Preview -->
    <script>
      $('#featured_image').change(function() {
        readURL(this);
      });

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $('#image-preview img').attr('src', e.target.result).show();
          };
          reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
@endpush
