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
        <h1 class="mt-3">Create Result for Match => {{$matchdetail->id}} <a href="{{ route('match.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View All Upcoming Matches</a></h1>
                            <div class="card mt-3">
                                <form action="{{route('match.storeresult')}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{$matchdetail->id}}" name="matchdetail_id">
                                    <div class="row">
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="row text-center">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img src="{{Storage::disk('uploads')->url($matchdetail->team1->logo)}}" style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-md-9">
                                                                <label for="team1_score">Score of {{$matchdetail->team1->name}}: </label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" name="team1_score" class="form-control" value="{{@old('team1_score')}}">

                                                            </div>
                                                            @error('team1_score')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <p style="font-size: 80px">VS</p>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img src="{{Storage::disk('uploads')->url($matchdetail->team2->logo)}}" style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-md-9">
                                                                <label for="team2_score">Score of {{$matchdetail->team2->name}}: </label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" name="team2_score" class="form-control" value="{{@old('team2_score')}}">

                                                            </div>
                                                            @error('team2_score')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>

    </div>


@endsection
@push('scripts')

@endpush
