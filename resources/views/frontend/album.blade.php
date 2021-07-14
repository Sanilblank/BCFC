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
                <div
                  class="col-6 col-md-6 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="100"
                >
                  <a href="gallery.html" class="d-block photo-item">
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid" />

                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
                      <h1 class="heading">Album Name</h1>
                      <p class="meta">2021.1.1</p>
                    </div>
                  </a>
                </div>
                <div
                  class="col-6 col-md-6 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="200"
                >
                  <a
                    href="images/img_1.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
                      <h1 class="heading">Album Name</h1>
                      <p class="meta">2021.1.1</p>
                    </div>
                  </a>
                </div>
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
