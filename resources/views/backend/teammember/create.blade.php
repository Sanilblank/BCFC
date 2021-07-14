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
        <h1 class="mt-3">Add New Member <a href="{{ route('teammember.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Members</a></h1>
                            <div class="card mt-3">
                                <form action="{{route('teammember.store')}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name: </label>
                                                <input type="text" name="name" class="form-control" value="{{@old('name')}}" placeholder="Enter Name of Player">
                                                @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo">Upload Image: </label>
                                                <input type="file" name="photo" class="form-control">
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
                                                        <option value="{{$position->id}}">{{$position->name}}</option>
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
                                                <input type="text" name="shirtno" class="form-control" value="{{@old('shirtno')}}" placeholder="Enter Jersey No of Player">
                                                @error('shirtno')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hometown">Hometown: </label>
                                                <input type="text" name="hometown" class="form-control" value="{{@old('hometown')}}" placeholder="Enter Hometown of Player">
                                                @error('hometown')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="status" value="1" style="height: 15px; width: 15px;">
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

@endpush
