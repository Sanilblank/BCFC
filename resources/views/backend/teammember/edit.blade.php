@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" integrity="sha256-n3YISYddrZmGqrUgvpa3xzwZwcvvyaZco0PdOyUKA18=" crossorigin="anonymous" />
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
        <h1 class="mt-3">Edit Member => {{$teammember->name}} <a href="{{ route('teammember.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Members</a></h1>
                            <div class="card mt-3">
                                <form action="{{route('teammember.update', $teammember->id)}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name: </label>
                                                <input type="text" name="name" class="form-control" value="{{@old('name') ? @old('name') : $teammember->name}}" placeholder="Enter Name of Player">
                                                @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo">Upload Image: </label>
                                                <input type="file" name="photo" class="form-control">
                                                <span style="color: red; font-size: 12px;">Note*: Leave empty to use previous image</span>
                                                @error('photo')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="teamposition_id">Select Position:</label>
                                                <select name="teamposition_id" class="form-control">
                                                    @foreach ($positions as $position)
                                                        <option value="{{$position->id}}" {{$position->id == $teammember->teamposition_id ? 'selected' : ''}}>{{$position->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('teamposition_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shirtno">Shirt No: </label>
                                                <input type="text" name="shirtno" class="form-control" value="{{@old('shirtno') ? @old('shirtno') : $teammember->shirtno}}" placeholder="Enter Jersey No of Player">
                                                @error('shirtno')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hometown">Hometown: </label>
                                                <input type="text" name="hometown" class="form-control" value="{{@old('hometown') ? @old('hometown') : $teammember->hometown}}" placeholder="Enter Hometown of Player">
                                                @error('hometown')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description(If Any):</label><br>
                                                <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="Description of the player">{{$teammember->description}}</textarea>
                                                @error('description')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="status" value="1" style="height: 15px; width: 15px;" {{$teammember->status == 1 ? 'checked' : ''}}>
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
<script>

    // $('#summernote').summernote({
    //     height: 200,
    //     placeholder: 'Blog Contents here'

    // });

    $(function () {

        $('#description').summernote({
            placeholder: "Any Extra Details about the team member.",
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
                url: '{{ route('teammember.store')}}',
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
@endpush
