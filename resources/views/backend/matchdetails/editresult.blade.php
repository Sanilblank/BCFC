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
        <h1 class="mt-3">Edit Result for Match => {{$matchdetail->id}} <a href="{{ route('match.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Upcoming Matches</a></h1>
                            <div class="card mt-3">
                                <form action="{{route('match.updateresult', $matchdetail->id)}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="row text-center">
                                                            <div class="col-md-12">
                                                                <img src="{{Storage::disk('uploads')->url($matchdetail->team1->logo)}}" style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-md-9">
                                                                <label for="team1_score">Score of {{$matchdetail->team1->name}}: </label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" name="team1_score" class="form-control" value="{{@old('team1_score')?@old('team1_score'):$matchresult->team1_score}}">

                                                            </div>
                                                            @error('team1_score')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mt-5">
                                                        <div class="form-group">
                                                            <h4>Goals Scored by {{$matchdetail->team1->name}} (Only if goal scored)</h4>
                                                            @if (count($team1scoredetails) > 0)
                                                                <ol>
                                                                    @foreach ($team1scoredetails as $team1)
                                                                        <li>{{$team1->name}} scored at {{$team1->time}} minutes</li>
                                                                    @endforeach
                                                                </ol>
                                                            @endif
                                                        </div>
                                                        <div class="row mt-3 mb-3">
                                                            <div class="col-md-12">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" name="team1scorereset" value="1" style="height: 15px; width: 15px;">
                                                                    <label for="team1scorereset" class="mt-1">Clear Score Result for team1 (Insert new results)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="name1">
                                                                    <label for="playername">Name of Player: </label>
                                                                    <input type="text" name="playername[]" class="form-control" value="{{@old('playername')}}">
                                                                    @error('playername')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group" id="time1">
                                                                    <label for="time">Time in minutes: </label>
                                                                    <input type="text" name="time[]" class="form-control" value="{{@old('time')}}">
                                                                    @error('time')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mt-3">
                                                                <div class="form-group">
                                                                    <a href="" onclick="add_fieldforteam1()" class="btn btn-primary mt-2"><i class="fa fa-plus"></i> Add</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <p style="font-size: 120px">VS</p>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="row text-center">
                                                            <div class="col-md-12">
                                                                <img src="{{Storage::disk('uploads')->url($matchdetail->team2->logo)}}" style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-md-9">
                                                                <label for="team2_score">Score of {{$matchdetail->team2->name}}: </label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" name="team2_score" class="form-control" value="{{@old('team2_score')?@old('team2_score'):$matchresult->team2_score}}">

                                                            </div>
                                                            @error('team2_score')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mt-5">
                                                        <div class="form-group">
                                                            <h4>Goals Scored by {{$matchdetail->team2->name}} (Only if goal scored)</h4>
                                                            @if (count($team2scoredetails) > 0)
                                                                <ol>
                                                                    @foreach ($team2scoredetails as $team2)
                                                                        <li>{{$team2->name}} scored at {{$team2->time}} minutes</li>
                                                                    @endforeach
                                                                </ol>
                                                            @endif
                                                        </div>
                                                        <div class="row mt-3 mb-3">
                                                            <div class="col-md-12">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" name="team2scorereset" value="1" style="height: 15px; width: 15px;">
                                                                    <label for="team2scorereset" class="mt-1">Clear Score Result for team2 (Insert new results)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" id="name2">
                                                                    <label for="playername2">Name of Player: </label>
                                                                    <input type="text" name="playername2[]" class="form-control" value="{{@old('playername2')}}">
                                                                    @error('playername2')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group" id="time2">
                                                                    <label for="time2">Time in minutes: </label>
                                                                    <input type="text" name="time2[]" class="form-control" value="{{@old('time2')}}">
                                                                    @error('time2')
                                                                        <p class="text-danger">{{$message}}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mt-3">
                                                                <div class="form-group">
                                                                    <a href="" onclick="add_fieldforteam2()" class="btn btn-primary mt-2"><i class="fa fa-plus"></i> Add</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="check" value="1" style="height: 15px; width: 15px;">
                                                <label for="check" class="mt-1">Clear Result (Mark match as upcoming)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>

    </div>


@endsection
@push('scripts')
<script>
    function add_fieldforteam1(){
        event.preventDefault();
        var x = document.getElementById("name1");
        var y = document.getElementById("time1");
        var new_field = document.createElement("input");
        var new_field2 = document.createElement("input");
        new_field.setAttribute("type", "text");
        new_field2.setAttribute("type", "text");
        new_field.setAttribute("name", "playername[]");
        new_field2.setAttribute("name", "time[]");
        new_field.setAttribute("class", "form-control");
        new_field2.setAttribute("class", "form-control");
        var pos = x.childElementCount;
        var pos2 = y.childElementCount;
        x.insertBefore(new_field, x.childNodes[pos]);
        y.insertBefore(new_field2, y.childNodes[pos2]);
    }

    function add_fieldforteam2(){
        event.preventDefault();
        var x = document.getElementById("name2");
        var y = document.getElementById("time2");
        var new_field = document.createElement("input");
        var new_field2 = document.createElement("input");
        new_field.setAttribute("type", "text");
        new_field2.setAttribute("type", "text");
        new_field.setAttribute("name", "playername2[]");
        new_field2.setAttribute("name", "time2[]");
        new_field.setAttribute("class", "form-control");
        new_field2.setAttribute("class", "form-control");
        var pos = x.childElementCount;
        var pos2 = y.childElementCount;
        x.insertBefore(new_field, x.childNodes[pos]);
        y.insertBefore(new_field2, y.childNodes[pos2]);
    }
</script>
@endpush
