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
        <h1 class="mt-3">Show Slider <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Sliders</a></h1>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <p><b>SubTitle:</b> {{$slider->subtitle}}</p>
                                    <p><b>Title:</b> {{$slider->title}}</p>
                                    <p><b>Date:</b> {{date('Y/m/d h:m a', strtotime($slider->created_at))}}</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{Storage::disk('uploads')->url($slider->images)}}" alt="{{$slider->title}}" style="max-width: 240px;">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><b>Details: </b></p>
                                    {!! $slider->description !!}
                                </div>
                            </div>
                        </div>
                    </div>


    </div>


@endsection
@push('scripts')

@endpush
