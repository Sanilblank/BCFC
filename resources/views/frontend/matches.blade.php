@extends('frontend.layouts.app')
@push('styles')

@endpush

@section('content')
      <!--? Hero Start -->
      <div class="slider-area2 overlay">
        <div class="slider-height2 d-flex align-items-center">
          <div class="container align-self-end">
            <div class="row">
              <div class="col-xl-12">
                <div class="hero-cap hero-cap2 pt-70">
                  <h2>Fixtures and Results</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Hero End -->
      <!--? Blog Area Start-->
      <section class="blog_area section-padding bg-blue">
        <div class="container">
          <div class="row">
            <div class="col-12 title-section d-flex justify-content-between">
              <h2 class="heading">Upcoming Match</h2>
              <div>
                <!-- <i class="fa fa-calendar" aria-hidden="true"></i> -->

                <select name="cars" id="cars" class="btn btn-primary">
                  <option value="volvo">All</option>
                  <option value="saab">August</option>
                  <option value="mercedes">September</option>
                  <option value="audi">October</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12 mb-4">
              <div class="bg-light p-4 rounded">
                <div class="widget-body">
                  <div class="widget-vs-2">
                    <div
                      class="
                        d-flex
                        align-items-center
                        justify-content-around justify-content-between
                        w-100
                      "
                    >
                      <div class="team-1 text-center">
                        <img src="{{asset('frontend/images/logo_1.png')}}" alt="Image" />
                        <h3>Football League</h3>
                      </div>
                      <div>
                        <span class="vs"><span>VS</span></span>
                      </div>
                      <div class="team-2 text-center">
                        <img src="{{asset('frontend/images/logo_2.png')}}" alt="Image" />
                        <h3>Soccer</h3>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-center widget-vs-2-contents mb-4">
                  <h4>World Cup League</h4>
                  <p class="">
                    <span class="d-block">December 20th, 2020</span>
                    <span class="d-block">9:30 AM GMT+0</span>
                    <strong class="text-primary">New Euro Arena</strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-12 mb-4">
              <div class="bg-light p-4 rounded">
                <div class="widget-body">
                  <div class="widget-vs-2">
                    <div
                      class="
                        d-flex
                        align-items-center
                        justify-content-around justify-content-between
                        w-100
                      "
                    >
                      <div class="team-1 text-center">
                        <img src="{{asset('frontend/images/logo_3.png')}}" alt="Image" />
                        <h3>Football League</h3>
                      </div>
                      <div>
                        <span class="vs"><span>VS</span></span>
                      </div>
                      <div class="team-2 text-center">
                        <img src="{{asset('frontend/images/logo_4.png')}}" alt="Image" />
                        <h3>Soccer</h3>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-center widget-vs-2-contents mb-4">
                  <h4>World Cup League</h4>
                  <p class="">
                    <span class="d-block">December 20th, 2020</span>
                    <span class="d-block">9:30 AM GMT+0</span>
                    <strong class="text-primary">New Euro Arena</strong>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-12 mb-4">
              <div class="bg-light p-4 rounded">
                <div class="widget-body">
                  <div class="widget-vs-2">
                    <div
                      class="
                        d-flex
                        align-items-center
                        justify-content-around justify-content-between
                        w-100
                      "
                    >
                      <div class="team-1 text-center">
                        <img src="{{asset('frontend/images/logo_1.png')}}" alt="Image" />
                        <h3>Football League</h3>
                      </div>
                      <div>
                        <span class="vs"><span>VS</span></span>
                      </div>
                      <div class="team-2 text-center">
                        <img src="{{asset('frontend/images/logo_2.png')}}" alt="Image" />
                        <h3>Soccer</h3>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-center widget-vs-2-contents mb-4">
                  <h4>World Cup League</h4>
                  <p class="">
                    <span class="d-block">December 20th, 2020</span>
                    <span class="d-block">9:30 AM GMT+0</span>
                    <strong class="text-primary">New Euro Arena</strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-12 mb-4">
              <div class="bg-light p-4 rounded">
                <div class="widget-body">
                  <div class="widget-vs-2">
                    <div
                      class="
                        d-flex
                        align-items-center
                        justify-content-around justify-content-between
                        w-100
                      "
                    >
                      <div class="team-1 text-center">
                        <img src="{{asset('frontend/images/logo_3.png')}}" alt="Image" />
                        <h3>Football League</h3>
                      </div>
                      <div>
                        <span class="vs"><span>VS</span></span>
                      </div>
                      <div class="team-2 text-center">
                        <img src="{{asset('frontend/images/logo_4.png')}}" alt="Image" />
                        <h3>Soccer</h3>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-center widget-vs-2-contents mb-4">
                  <h4>World Cup League</h4>
                  <p class="">
                    <span class="d-block">December 20th, 2020</span>
                    <span class="d-block">9:30 AM GMT+0</span>
                    <strong class="text-primary">New Euro Arena</strong>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <nav class="blog-pagination justify-content-center d-flex">
          <ul class="pagination">
            <li class="page-item">
              <a href="#" class="page-link" aria-label="Previous">
                <i class="fa fa-angle-left"></i>
              </a>
            </li>
            <li class="page-item">
              <a href="#" class="page-link">1</a>
            </li>
            <li class="page-item active">
              <a href="#" class="page-link">2</a>
            </li>
            <li class="page-item">
              <a href="#" class="page-link" aria-label="Next">
                <i class="fa fa-angle-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </section>

      <div class="site-section pb-2">
        <div class="container-fluid">
          <div class="row pb-5">
            <div class="widget-title2 text-black">
              <h3 class="text-black">LATEST NEWS</h3>
            </div>
          </div>

          <!-- Slider News -->

          <div class="row pt-5 px-3">
            <div class="nonloop-block-13 owl-carousel">
                @foreach ($latestblogs as $item)
                <div class="item" onclick="location.href='{{route('newsdetails', [$item->id, Str::slug($item->title)])}}'" style="cursor: pointer">
                    <!-- uses .block-12 -->
                    <div class="block-12">
                      <figure>
                        <img src="{{Storage::disk('uploads')->url($item->image)}}" alt="Image" class="img-fluid" />
                      </figure>
                      <div class="text">
                        <span class="meta">{{date('F d, Y', strtotime($item->date))}}</span>
                        <div class="text-inner">
                          <h2 class="heading mb-3">
                            <a href="#" class="text-black"
                              >{{$item->title}}</a
                            >
                          </h2>
                          <p>
                            {{$item->smalldesc}}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach

            </div>
          </div>
        </div>
      </div>

      <!-- this is the Sponsor Section -->

      <div
        class="site-section block-13 bg-primary fixed overlay-primary bg-image"
        style="background-image: url('images/hero_bg_3.jpg')"
        data-stellar-background-ratio="0.5"
      >
        <div class="container-fluid">
          <div class="row px-5">
            <!-- Partner Logo Section Begin -->

            <div class="logo-carousel owl-carousel">
              <div class="logo-item">
                <div class="tablecell-inner">
                  <img src="{{asset('frontend/images/logo-carousel/logo-1.png')}}" alt="" />
                </div>
              </div>
              <div class="logo-item">
                <div class="tablecell-inner">
                  <img src="{{asset('frontend/images/logo-carousel/logo-2.png')}}" alt="" />
                </div>
              </div>
              <div class="logo-item">
                <div class="tablecell-inner">
                  <img src="{{asset('frontend/images/logo-carousel/logo-3.png')}}" alt="" />
                </div>
              </div>
              <div class="logo-item">
                <div class="tablecell-inner">
                  <img src="{{asset('frontend/images/logo-carousel/logo-4.png')}}" alt="" />
                </div>
              </div>
              <div class="logo-item">
                <div class="tablecell-inner">
                  <img src="{{asset('frontend/images/logo-carousel/logo-5.png')}}" alt="" />
                </div>
              </div>
            </div>
            <!-- Partner Logo Section End -->
          </div>
        </div>
      </div>

@endsection
@push('scripts')

@endpush
