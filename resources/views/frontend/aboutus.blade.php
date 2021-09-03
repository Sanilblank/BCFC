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
                  <h2>About Us</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->

      <div class="bg-white">
        <div class="container-fluid">
          <div class="row no-gutters">
            <div class="col-lg-6 align-self-center">
              <div class="about-content">
                <h2>Biratnager City FC</h2>
                <p>
                  {!! $setting->aboutus !!}
                </p>
              </div>
            </div>
            <div class="col-lg-6 p-5">
              <div class="about-content-img">
                <img src="{{Storage::disk('uploads')->url($setting->headerImage)}}" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-blue">
        <div class="container-fluid">
          <div class="row no-gutters">
            <div class="col-lg-6">
              <div class="about-content-img text-white pl-5">
                <img src="{{Storage::disk('uploads')->url($setting->ourvaluesimage)}}" alt="" class="img-fluid" />
              </div>
            </div>
            <div class="col-lg-6 align-self-center" style="padding-left: 50px">
              <div class="about-content text-white">
                <h2>Our Values</h2>

                  {!! $setting->ourvalues !!}

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- NewsLetter or Ad section -->
      <div class="site-blocks-vs bg-blue">
        <div class="container-fluid p-0">
          <div
            class="bg-image overlay-success rounded py-4"
            style="background-image: url('frontend/images/hero_bg_1.jpg')"
            data-stellar-background-ratio="0.5"
          >
            <div class="row align-items-center no-gutters px-5">
              <div class="col-md-12 col-lg-3 mb-4 mb-lg-0 px-5">
                <div class="text-center text-lg-left">
                  <div class="d-block d-lg-flex align-items-center">
                    <div class="image mx-auto mb-3 mb-lg-0 mr-lg-3">
                      <img
                        src="{{Storage::disk('uploads')->url($setting->headerImage)}}"
                        alt="Image"
                        class="img-fluid"
                      />
                    </div>
                    <div class="text">
                      <h3
                        class="h5 mb-0 text-white"
                        style="font-family: 'Bebas Neue', cursive"
                      >
                        Get Access to all the Events and Updates <br /><span
                          class="text-uppercase small country text-white"
                          >News Letter</span
                        >
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-9 text-center mb-4 mb-lg-0 px-5">
                <div class="">
                  <form action="#" method="post">
                    <div
                      class="input-group mb-3 d-flex align-items-center w-75"
                    >
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter Email"
                        aria-label="Enter Email"
                        aria-describedby="button-addon2"
                      />
                      <div class="input-group-append" style="height: 51px">
                        <button
                          class="btn btn-primary py-2"
                          type="button"
                          id="button-addon2"
                        >
                          Subscribe
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-blue pb-5">
        <div class="container-fluid px-0">
          <div class="row no-gutters">
            <div class="col-lg-12 align-self-center">
              <div class="about-content text-white">
                <h2>Club Management</h2>
              </div>

              <!-- Whats New Start -->
              <section class="whats-news-area pt-50 pb-20">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row d-flex justify-content-between">

                        <div class="col-lg-12 col-md-12">
                          <div class="properties__button">
                            <!--Nav Button  -->
                            <nav>
                              <div
                                class="nav nav-tabs"
                                id="nav-tab"
                                role="tablist"
                              >
                              @if (count($teampositions) > 0)
                                <a
                                  class="nav-item nav-link active"
                                  id="nav-home-tab"
                                  data-toggle="tab"
                                  href="#nav-home"
                                  role="tab"
                                  aria-controls="nav-home"
                                  aria-selected="true"
                                  >All</a
                                >
                                @foreach ($teampositions as $position)
                                    <a
                                        class="nav-item nav-link"
                                        id="nav-profile-tab"
                                        data-toggle="tab"
                                        href="#{{$position->slug}}"
                                        role="tab"
                                        aria-controls="nav-profile"
                                        aria-selected="false"
                                        >{{$position->name}}</a
                                    >
                                @endforeach
                                @endif


                              </div>
                            </nav>
                            <!--End Nav Button  -->
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <!-- Nav Card -->
                          @if (count($teammembers) > 0)
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div
                                class="tab-pane fade show active"
                                id="nav-home"
                                role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach ($teammembers as $member)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="single-what-news mb-4">
                                                <div class="card-person">
                                                    <div class="imgBx">
                                                    <img
                                                        src="{{Storage::disk('uploads')->url($member->photo)}}"
                                                    />
                                                    </div>
                                                    <div class="contentBx">
                                                    <h2>{{$member->name}} #{{$member->shirtno}}</h2>
                                                    <div class="size">
                                                        <h3>HomeTown: {{$member->hometown}}</h3>
                                                    </div>
                                                    <div class="color">
                                                        <h3>Position: {{$member->teamposition->name}}</h3>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        @endforeach



                                    {{-- <div class="col-lg-4 col-md-6">
                                        <div class="single-what-news mb-4">
                                        <div class="card-person">
                                            <div class="imgBx">
                                            <img
                                                src="https://www.footyrenders.com/render/karim-benzema-79-390x418.png"
                                            />
                                            </div>
                                            <div class="contentBx">
                                            <h2>Karim Benzema #09</h2>
                                            <div class="size">
                                                <h3>Country:France</h3>
                                            </div>
                                            <div class="color">
                                                <h3>Position:Forward</h3>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div> --}}

                                    </div>
                                </div>
                                </div>
                                @foreach ($teampositions as $position)

                                <div
                                    class="tab-pane fade"
                                    id="{{$position->slug}}"
                                    role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            @if (count($position->teammembers) > 0)
                                                @foreach ($position->teammembers as $member)
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="single-what-news mb-4">
                                                            <div class="card-person">
                                                            <div class="imgBx">
                                                                <img
                                                                src="{{Storage::disk('uploads')->url($member->photo)}}"
                                                                />
                                                            </div>
                                                            <div class="contentBx">
                                                                <h2>{{$member->name}} #{{$member->shirtno}}</h2>
                                                                <div class="size">
                                                                <h3>HomeTown: {{$member->hometown}}</h3>
                                                                </div>
                                                                <div class="color">
                                                                <h3>Position: {{$member->teamposition->name}}</h3>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                    None Available
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                          @else
                            <p>No Information Available.</p>
                          @endif
                          <!-- End Nav Card -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- Whats New End -->
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white">
        <div class="container-fluid px-0">
          <div class="row no-gutters">
            <div class="col-lg-6 align-self-center">
              <div class="about-content">
                <h2>Words from the Coach</h2>
                {!! $setting->wordsfromcoach !!}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-content-img">
                <img src="{{Storage::disk('uploads')->url($setting->wordsfromcoachimage)}}" class="img-fluid" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>

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

      <div class="site-section block-13 bg-primary fixed overlay-primary bg-image"
      style="background-image: url('frontend/images/hero_bg_3.jpg');" data-stellar-background-ratio="0.5">

      <div class="container-fluid">

        <div class="row px-5">
          <!-- Partner Logo Section Begin -->

          <div class="logo-carousel owl-carousel">
              @if (count($partners) > 0)
                  @foreach ($partners as $partner)
                  <div class="logo-item">
                    <div class="tablecell-inner">
                      <img src="{{Storage::disk('uploads')->url($partner->logo)}}" alt="">
                    </div>
                  </div>
                  @endforeach
              @endif

            {{-- <div class="logo-item">
              <div class="tablecell-inner">
                <img src="{{asset('frontend/images/logo-carousel/logo-2.png')}}" alt="">
              </div>
            </div>
            <div class="logo-item">
              <div class="tablecell-inner">
                <img src="{{asset('frontend/images/logo-carousel/logo-3.png')}}" alt="">
              </div>
            </div>
            <div class="logo-item">
              <div class="tablecell-inner">
                <img src="{{asset('frontend/images/logo-carousel/logo-4.png')}}" alt="">
              </div>
            </div>
            <div class="logo-item">
              <div class="tablecell-inner">
                <img src="{{asset('frontend/images/logo-carousel/logo-5.png')}}" alt="">
              </div>
            </div> --}}
          </div>
          <!-- Partner Logo Section End -->






        </div>
      </div>

    </div>

    </div>
@endsection
@push('scripts')

@endpush
