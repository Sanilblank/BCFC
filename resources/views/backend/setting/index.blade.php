@extends('backend.layouts.app')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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

        <h1 class="mt-3">Settings</h1>
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{route('setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab_1" role="tab"
                                    aria-selected="true">Site Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_2" role="tab"
                                    aria-selected="false">Social Media</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_3" role="tab"
                                    aria-selected="false">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_4" role="tab"
                                    aria-selected="false">Address</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="site address">Site Name</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="sitename" class="form-control"
                                                value="{{ $setting->sitename }}">
                                                @error('sitename')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="headerImage">Select a Header Image</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" name="headerImage" class="form-control">
                                            @error('headerImage')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="currentimage">Current Header Image</label>
                                            <img src="{{ Storage::disk('uploads')->url($setting->headerImage) }}"
                                                style='max-width: 100px;'>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="footerImage">Select a Footer Image</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" name="footerImage" class="form-control">
                                            @error('footerImage')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="currentlogo">Current Footer Image</label>
                                            <img src="{{ Storage::disk('uploads')->url($setting->footerImage) }}"
                                                style='max-width: 100px;'>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="facebook">Facebook</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="facebook" class="form-control"
                                                value="{{ $setting->facebook }}">
                                            @error('facebook')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="linkedin">Linkedin</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="linkedin" class="form-control"
                                                value="{{ $setting->linkedin }}">
                                            @error('linkedin')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="twitter">Twitter</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="twitter" class="form-control"
                                                value="{{ $setting->twitter }}">
                                            @error('twitter')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="instagram">Instagram</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="instagram" class="form-control"
                                                value="{{ $setting->instagram }}">
                                            @error('instagram')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <h4>About Us Section:</h4>
                                            <hr>
                                            <textarea name="aboutus"
                                            id="summernote">{{ $setting->aboutus }}</textarea>
                                            @error('aboutus')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <h4>Our Values Section:</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="ourvaluesimage">Select an Image</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file" name="ourvaluesimage" class="form-control">
                                                        @error('ourvaluesimage')
                                                            <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea name="ourvalues"
                                                    id="summernote1">{{ $setting->ourvalues }}</textarea>
                                                    @error('ourvalues')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <h4>Words From Coach Section:</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="wordsfromcoachimage">Select an Image</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file" name="wordsfromcoachimage" class="form-control">
                                                        @error('wordsfromcoachimage')
                                                            <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea name="wordsfromcoach"
                                                    id="summernote2">{{ $setting->wordsfromcoach }}</textarea>
                                                    @error('wordsfromcoach')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_4">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="address">Address</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="address" class="form-control"
                                                value="{{ $setting->address }}">
                                            @error('address')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="phone">Phone No</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $setting->phone }}">
                                            @error('phone')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="email" class="form-control"
                                                value="{{ $setting->email }}">
                                            @error('email')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>

                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['height', ['height']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });

        $('#summernote1').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['height', ['height']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });

        $('#summernote2').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['height', ['height']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });

    </script>
@endpush
