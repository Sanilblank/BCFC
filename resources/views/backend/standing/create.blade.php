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
        <h1 class="mt-3">Create New Team Standings for {{$reqmatchtype->name}} <a href="{{ route('standing.viewStanding') }}{{'?matchtype_id=' .$reqmatchtype->id}}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Standings</a></h1>
                            <div class="card mt-3">
                                <form action="{{route('standing.store')}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{$reqmatchtype->id}}" name="matchtype_id">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="team_id">Select Team:</label>
                                                <select name="team_id" class="form-control">
                                                    @foreach ($teammatchtypes as $teammatchtype)
                                                        <option value="{{$teammatchtype->team_id}}">{{$teammatchtype->team->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('team_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="played">Played(P): </label>
                                                <input type="number" name="played" class="form-control" value="{{@old('played')?@old('played'):'0'}}">
                                                @error('played')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="win">No of Wins(W): </label>
                                                <input type="number" name="win" class="form-control" value="{{@old('win')?@old('win'):'0'}}">
                                                @error('win')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div><div class="col-md-2">
                                            <div class="form-group">
                                                <label for="draw">No of Draws(D): </label>
                                                <input type="number" name="draw" class="form-control" value="{{@old('draw')?@old('draw'):'0'}}">
                                                @error('draw')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div><div class="col-md-2">
                                            <div class="form-group">
                                                <label for="loss">No of Loss(L): </label>
                                                <input type="number" name="loss" class="form-control" value="{{@old('loss')?@old('loss'):'0'}}">
                                                @error('loss')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div><div class="col-md-2">
                                            <div class="form-group">
                                                <label for="goalsscored">Goals For(GF): </label>
                                                <input type="number" name="goalsscored" class="form-control" value="{{@old('goalsscored')?@old('goalsscored'):'0'}}">
                                                @error('goalsscored')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div><div class="col-md-2">
                                            <div class="form-group">
                                                <label for="goalsagainst">Goals Against(GA): </label>
                                                <input type="number" name="goalsagainst" class="form-control" value="{{@old('goalsagainst')?@old('goalsagainst'):'0'}}">
                                                @error('goalsagainst')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="goaldifferential">Goal Differential(GD): </label>
                                                <input type="number" name="goaldifferential" class="form-control" value="{{@old('goaldifferential')?@old('goaldifferential'):'0'}}">
                                                @error('goaldifferential')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="points">Points(PTS): </label>
                                                <input type="number" name="points" class="form-control" value="{{@old('points')?@old('points'):'0'}}">
                                                @error('points')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p style="color: red; font-size: 12px;">Note*:Goal Differential(GD) and Points(P) will be calculated automatically.</p>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>

    </div>


@endsection
@push('scripts')

@endpush
