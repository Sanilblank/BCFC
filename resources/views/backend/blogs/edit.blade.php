@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" integrity="sha256-n3YISYddrZmGqrUgvpa3xzwZwcvvyaZco0PdOyUKA18=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <style>
        .bootstrap-tagsinput {
            width: 100% !important;
        }
    </style>
@endpush
@section('content')
    <div class="right_col" role="main">
        @if (session('failure'))
        <div class="col-sm-12">
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                {{ session('failure') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <h1 class="mt-3">Edit Blog <a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Blogs</a></h1>
                            <div class="card mt-3">
                                <form action="{{route('blog.update', $blog->id)}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Blog Title: </label>
                                                <input type="text" name="title" class="form-control" value="{{@old('title')?@old('title'):$blog->title}}" placeholder="Blog Title">
                                                @error('title')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="logo">Upload Image: </label>
                                                <input type="file" name="image" class="form-control">
                                                <span style="color: red; font-size: 12px;">Note*: Leave empty to use previous image</span>
                                                @error('image')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tag">Tags:</label>
                                                <input type="text" class="form-control" name="tag" data-role="tagsinput" value="{{$tag}}">
                                                <p class="text-success">Note*: Seperate each one by comma.</p>
                                                @error('tag')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Date:</label>
                                                <input type="datetime-local" class="form-control datetimepicker" name="date" value="{{@old('date')?@old('date'):$blog->date}}" placeholder="Date">
                                                @error('date')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="authorname">Author Name: </label>
                                                <input type="text" name="authorname" class="form-control" value="{{@old('authorname')?@old('authorname'):$blog->authorname}}" placeholder="Name of the Author">
                                                @error('authorname')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="authorimage">Upload Author Image: </label>
                                                <input type="file" name="authorimage" class="form-control">
                                                <span style="color: red; font-size: 12px;">Note*: Leave empty to use previous image</span>
                                                @error('authorimage')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="details">Description:</label>
                                                <textarea name="details" id="description" class="form-control" cols="30" rows="10" placeholder="Write something about the brand...">{{$blog->details}}</textarea>
                                                @error('details')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="status" value="1" style="height: 15px; width: 15px;" {{$blog->status == 1 ? 'checked' : ''}}>
                                                <label for="Status" class="mt-1">Status</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>

    </div>


@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script>

        // $('#summernote').summernote({
        //     height: 200,
        //     placeholder: 'Blog Contents here'

        // });


        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        });

        $(function () {

                $('#description').summernote({
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
                        url: '{{ route('blog.store')}}',
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


            });


    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>
@endpush
