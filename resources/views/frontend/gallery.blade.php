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
                  <h2>{{$album->title}}</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->

      <div class="main-content pt-5 bg-blue">
        <div class="container">
          <section class="row align-items-stretch photos" id="section-photos">
            <div class="col-12">
              <div class="row align-items-stretch">
                  @if (count($photos) == 0)
                     <p style="margin-left: 25px">No Photos in selected Album</p>
                  @else
                    @foreach ($photos as $photo)
                      <div class="col-6 col-md-6 col-lg-4" data-aos="fade-up">
                        <a href="{{Storage::disk('uploads')->url($photo->image)}}" class="d-block photo-item" data-fancybox="gallery">
                          <img src="{{Storage::disk('uploads')->url($photo->image)}}" alt="Image" class="img-fluid" />
                          <div class="photo-text-more">
                            <span class="icon icon-search"></span>
                          </div>
                        </a>
                      </div>
                    @endforeach
                  @endif


              </div>
            </div>
          </section>
          <!-- #section-photos -->
        </div>
      </div>



</div>







@endsection
@push('scripts')

@endpush
