@extends('frontend.layouts.app')
@push('styles')

@endpush

@section('content')

<div class="site-wrap">
      <!--? Hero Start -->
      <div class="slider-area2 overlay">
        <div class="slider-height2 d-flex align-items-center">
          <div class="container align-self-end">
            <div class="row">
              <div class="col-xl-12">
                <div class="hero-cap hero-cap2 pt-70">
                  <h2>Albums</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->

      <div class="main-album pt-5 bg-blue">
        <div class="container-fluid">
          <section class="row align-items-stretch photos">
            <div class="col-12">
              <div class="row align-items-stretch">
                  @if (count($albums) == 0)
                     <p style="margin-left: 25px">No Albums Present</p>
                  @else
                    @foreach ($albums as $album)
                        <div
                            class="col-6 col-md-6 col-lg-4"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            <a href="{{route('viewgallery', [$album->id, Str::slug($album->title)])}}" class="d-block photo-item">
                            <img src="{{Storage::disk('uploads')->url($album->cover_image)}}" alt="Image" class="img-fluid" />

                            <div class="photo-text-more">
                                <span class="icon icon-search"></span>
                                <h1 class="heading">{{$album->title}}</h1>
                                <p class="meta">{{date('d F, Y', strtotime($album->date))}}</p>
                            </div>
                            </a>
                        </div>
                    @endforeach
                  @endif


              </div>
              @if (count($albums) > 0)
                <div class="mt-5 text-center">
                    {{ $albums->links() }}
                </div>
              @endif

            </div>
          </section>
          <!-- #section-photos -->
        </div>
      </div>
</div>





@endsection
@push('scripts')

@endpush
