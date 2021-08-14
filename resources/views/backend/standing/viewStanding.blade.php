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
        </div>
    </div>
    <h1 class="mt-3">Standings => {{$reqmatchtype->name}}

        @if (!$standing)
        <form action="{{route('standing.initialize')}}" method="POST" style="display: inline;">
            @csrf
            @method('POST')
            <input type="hidden" value="{{$reqmatchtype->id}}" name="matchtype_id">
            <button class="btn btn-success btn-sm" type="submit"> <i class="fa fa-plus" aria-hidden="true"></i> Initialize Standings</button>
        </form>
        @else
            <a href="{{route('standing.create', $reqmatchtype->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> Add New Team Standing</a>
            <form action="{{route('standing.destroyall', $reqmatchtype->id)}}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit"> Delete All Standings</button>
            </form>
        @endif
    </h1>
    <div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-bordered yajra-datatable text-center">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Team</th>
                        <th class="text-center">Played(P)</th>
                        <th class="text-center">Win(W)</th>
                        <th class="text-center">Draw(D)</th>
                        <th class="text-center">Loss(L)</th>
                        <th class="text-center">Goals For(GF)</th>
                        <th class="text-center">Goals Against(GA)</th>
                        <th class="text-center">Goal Differential(GD)</th>
                        <th class="text-center">Points(PTS)</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(function () {

      var table = $('.yajra-datatable').DataTable({

          processing: true,
          serverSide: true,
          ajax: "{{ request()->fullUrl() }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'team_id', name: 'team_id'},
              {data: 'played', name: 'played'},
              {data: 'win', name: 'win'},
              {data: 'draw', name: 'draw'},
              {data: 'loss', name: 'loss'},
              {data: 'goalsscored', name: 'goalsscored'},
              {data: 'goalsagainst', name: 'goalsagainst'},
              {data: 'goaldifferential', name: 'goaldifferential'},
              {data: 'points', name: 'points'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ]
      });

    });
  </script>
@endpush
