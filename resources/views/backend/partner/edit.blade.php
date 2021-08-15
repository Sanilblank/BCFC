@extends('backend.layouts.app')
@push('styles')

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
        <h1 class="mt-3">Edit Partner => {{$partner->name}} <a href="{{ route('partner.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Partners</a></h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mt-3">
                                <form action="{{route('partner.update', $partner->id)}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name: </label>
                                                <input type="text" name="name" class="form-control" value="{{@old('name')?@old('name'):$partner->name}}" placeholder="Enter Name of Partner">
                                                @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="logo">Upload Logo: </label>
                                                <input type="file" name="logo" class="form-control">
                                                <span style="color: red; font-size: 12px;">Note*: Leave empty to use previous image</span>
                                                @error('logo')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="link">Link: </label>
                                                <input type="text" name="link" class="form-control" value="{{@old('link')?@old('link'):$partner->link}}" placeholder="Enter Link of Partners Website">
                                                @error('link')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>



    </div>


@endsection
@push('scripts')

@endpush
