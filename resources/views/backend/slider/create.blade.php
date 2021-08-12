@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" integrity="sha256-n3YISYddrZmGqrUgvpa3xzwZwcvvyaZco0PdOyUKA18=" crossorigin="anonymous" />
@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Create Slider Image <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Sliders</a></h1>
        <div class="card mt-3">

            <form action="{{ route('slider.store') }}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subtitle">Subtitle: </label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Subtitle" value="{{@old('subtitle')}}">
                            @error('subtitle')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input type="text" name="title" class="form-control" placeholder="Title" value="{{@old('title')}}">
                            @error('title')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label><br>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="Description to be displayed on separate page"></textarea>
                    @error('description')
                        <p class="text-danger">{{$message}}</p>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="images">Select Image:</label>
                    <input type="file" name="images" class="form-control">
                    @error('images')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    </div>
    </div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>

    // $('#summernote').summernote({
    //     height: 200,
    //     placeholder: 'Blog Contents here'

    // });

    $(function () {

        $('#description').summernote({
            placeholder: "Description to be shown in separate page.",
            height: 300,
            callbacks: {
                onImageUpload: function(files) {
                    console.log(files);
                    for(var i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                }
            }

        });

        $.upload = function (file) {

            let out = new FormData();
            out.append('file', file, file.name);
            console.log("outform is ",out);
            $.ajax({
                method: 'POST',
                url: '{{ route('slider.store')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                data: out,
                success: function (r) {
                    console.log(typeof r);
                    $('#description').summernote('insertImage', r.url);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };
        $(".description").summernote({
            callbacks : {
                onMediaDelete : function ($target, $editable) {
                    console.log($target.attr('src'));   // get image url
                }
            }
        });

        @foreach($images as $image)
        $('#description').summernote('insertImage', '{{Storage::disk('uploads')->url($image->location)}}');

        @endforeach
        });


</script>
@endpush
