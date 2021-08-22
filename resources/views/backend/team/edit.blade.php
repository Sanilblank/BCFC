@extends('backend.layouts.app')
@push('styles')
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
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
        <h1 class="mt-3">Edit Team => {{$team->name}} <a href="{{ route('team.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Teams</a></h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mt-3">
                                <form action="{{route('team.update', $team->id)}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name: </label>
                                                <input type="text" name="name" class="form-control" value="{{@old('name')?@old('name'):$team->name}}" placeholder="Enter Name of Team">
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
                                                <label for="matchtype">Choose Matchtypes in which the team will play: </label>
                                                <select class="form-control chosen-select" data-placeholder="Type Matchtype names..." multiple name="matchtype[]">
                                                    @foreach ($matchtypes as $matchtype)
                                                        <option value="{{$matchtype->id}}" {{in_array($matchtype->id, $array_teammatchtypes)? 'selected' : ''}}>{{$matchtype->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('matchtype')
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
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        });
    </script>
@endpush
