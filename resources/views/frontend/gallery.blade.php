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
                  <h2>Gallery/Albums</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->

      <div class="main-content pt-5 bg-blue">
        <div class="container-fluid">
          <section class="row align-items-stretch photos" id="section-photos">
            <div class="col-12">
              <div class="row align-items-stretch">
                <div class="col-6 col-md-6 col-lg-4" data-aos="fade-up">
                  <a
                    href="images/img_4.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_4.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
                    </div>
                  </a>
                </div>
                <div
                  class="col-6 col-md-6 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="100"
                >
                  <a
                    href="images/img_2.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
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
                    </div>
                  </a>
                </div>

                <div class="col-6 col-md-6 col-lg-4" data-aos="fade-up">
                  <a
                    href="images/img_2.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
                    </div>
                  </a>
                </div>
                <div
                  class="col-6 col-md-6 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="100"
                >
                  <a
                    href="images/img_3.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
                    </div>
                  </a>
                </div>
                <div
                  class="col-6 col-md-6 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="200"
                >
                  <a
                    href="images/img_6.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_6.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
                    </div>
                  </a>
                </div>

                <div
                  class="col-6 col-md-6 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="100"
                >
                  <a
                    href="images/img_1.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
                    </div>
                  </a>
                </div>

                <div
                  class="col-6 col-md-6 col-lg-4"
                  data-aos="fade-up"
                  data-aos-delay="200"
                >
                  <a
                    href="images/img_4.jpg"
                    class="d-block photo-item"
                    data-fancybox="gallery"
                  >
                    <img src="images/img_5.jpg" alt="Image" class="img-fluid" />
                    <div class="photo-text-more">
                      <span class="icon icon-search"></span>
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
