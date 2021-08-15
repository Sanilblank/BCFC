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
                  <h2>Official Partners</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->

      <div class="bg-white section-padding">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="hero-cap hero-cap2 pt-70 text-center">
                <h2>Our Partners</h2>
              </div>
            </div>
            <div class="col-lg-12 justify-content-center">
              <div class="partner-list">
                <div class="row">
                    @if (count($partners) > 0)
                        @foreach ($partners as $partner)
                          <div class="col-lg-3">
                            <div class="partner-item" onclick="location.href='{{$partner->link}}'" style="cursor: pointer">
                              <div class="pi-pic">
                                <img src="{{Storage::disk('uploads')->url($partner->logo)}}" alt="" />
                              </div>
                              <div class="pi-text">
                                <a href="#">
                                  <h5>{{$partner->name}}</h5>
                                </a>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    @else
                        <p>No Information Available</p>
                    @endif

                </div>
              </div>
            </div>
          </div>
          {{-- <div class="row">
            <div class="col-xl-12">
              <div class="hero-cap hero-cap2 pt-70 text-center">
                <h2>Title Sponsor</h2>
              </div>
            </div>
            <div class="col-lg-12 justify-content-center">
              <div class="partner-list">
                <div class="row justify-content-center">
                  <div class="col-lg-3">
                    <div class="partner-item">
                      <div class="pi-pic">
                        <img src="{{asset('frontend/images/logo_1.png')}}" alt="" />
                      </div>
                      <div class="pi-text">
                        <a href="#">
                          <h5>Adidas</h5>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="partner-item">
                      <div class="pi-pic">
                        <img src="{{asset('frontend/images/logo_1.png')}}" alt="" />
                      </div>
                      <div class="pi-text">
                        <a href="#">
                          <h5>Adidas</h5>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>


    </div>

@endsection
@push('scripts')

@endpush
