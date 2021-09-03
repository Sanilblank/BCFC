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
        <h1 class="mt-3">Edit Match => {{$matchdetail->id}} <a href="{{ route('match.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Upcoming Matches</a></h1>
                            <div class="card mt-3">
                                <form action="{{route('match.update', $matchdetail->id)}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="team1_id">Select First Team:</label>
                                                <select name="team1_id" class="form-control">
                                                    @foreach ($teams as $team)
                                                        <option value="{{$team->id}}" {{$matchdetail->team1_id == $team->id ? 'selected' : ''}}>{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('team1_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="team2_id">Select Second Team:</label>
                                                <select name="team2_id" class="form-control">
                                                    @foreach ($teams as $team)
                                                        <option value="{{$team->id}}" {{$matchdetail->team2_id == $team->id ? 'selected' : ''}}>{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('team2_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="datetime">Date and Time: </label>
                                                <input type="datetime-local" name="datetime" class="form-control" value="{{@old('datetime')?@old('datetime'):$matchdetail->datetime}}" placeholder="Enter Date">
                                                @error('datetime')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="matchtype_id">Select Match Type:</label>
                                                <select name="matchtype_id" class="form-control">
                                                    @foreach ($matchtypes as $matchtype)
                                                        <option value="{{$matchtype->id}}" {{$matchdetail->matchtype_id == $matchtype->id ? 'selected' : ''}}>{{$matchtype->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('matchtype_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stadium_id">Select Stadium:</label>
                                                <select name="stadium_id" class="form-control">
                                                    @foreach ($stadiums as $stadium)
                                                        <option value="{{$stadium->id}}" {{$matchdetail->stadium_id == $stadium->id ? 'selected' : ''}}>{{$stadium->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('stadium_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
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
