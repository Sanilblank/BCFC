@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
<div class="right_col" role="main">
    @if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
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
    <h1 class="mt-3">Create Position  <a href="{{route('teamposition.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> View Posiitons</a></h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-3">

               <form action="{{route('teamposition.store')}}" method="POST" class="bg-light p-3">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Position Name: </label>
                                <input type="text" name="name" class="form-control" value="{{@old('name')}}" placeholder="Enter Position Name">
                                @error('name')
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
