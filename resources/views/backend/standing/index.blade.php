@extends('backend.layouts.app')
@push('styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="right_col" role="main">
    <!-- MAIN -->
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


    <h1 class="mt-3">Standings </h1>
    <div class="card">
        <div class="card-body">
            <form action="{{route('standing.viewStanding')}}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="matchtype_id" class="form-control">
                                @foreach ($matchtypes as $matchtype)
                                    <option value="{{$matchtype->id}}">{{$matchtype->name}}</option>
                                @endforeach
                            </select>
                            @error('matchtype_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

            </form>
            <p>Please select the matchtype for which the standings should be displayed.</p>
        </div>
    </div>

</div>

@endsection
@push('scripts')

@endpush
