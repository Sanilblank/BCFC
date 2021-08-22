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
        <h1 class="mt-3">Add New Match Type <a href="{{ route('matchtype.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Match Types</a></h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mt-3">
                                <form action="{{route('matchtype.store')}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name: </label>
                                                <input type="text" name="name" class="form-control" value="{{@old('name')}}" placeholder="Eg: Nepal Super League 2078">
                                                @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="team">Choose Teams who will play in the matchtype: </label>
                                                <select class="form-control chosen-select" data-placeholder="Type Team names..." multiple name="team[]">
                                                    @foreach ($teams as $team)
                                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('team')
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
