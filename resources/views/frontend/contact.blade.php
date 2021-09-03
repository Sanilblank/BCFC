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
                  <h2>Contact Us</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->

      <!--?  Contact Area start  -->
      <section class="contact-section">
        <div class="container">
          <!-- <div class="d-none d-sm-block mb-5 pb-4">

                <script>
                    function initMap() {
                        var uluru = {
                            lat: -25.363,
                            lng: 131.044
                        };
                        var grayStyles = [{
                            featureType: "all",
                            stylers: [{
                                saturation: -90
                            },
                            {
                                lightness: 50
                            }
                            ]
                        },
                        {
                            elementType: 'labels.text.fill',
                            stylers: [{
                                color: '#ccdee9'
                            }]
                        }
                        ];
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: {
                                lat: -31.197,
                                lng: 150.744
                            },
                            zoom: 9,
                            styles: grayStyles,
                            scrollwheel: false
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&amp;callback=initMap">
                </script>

            </div> -->
          <div class="row">
            <div class="col-12">
              <h2 class="contact-title">Get in Touch</h2>
            </div>
            <div class="col-lg-8">
              <form action="{{route('contactMail')}}"
                class="form-contact contact_form"

                id="contactForm"
                novalidate="novalidate"
              >

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <textarea
                        class="form-control w-100"
                        name="message"
                        id="message"
                        cols="30"
                        rows="9"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter Message'"
                        placeholder=" Enter Message"
                      ></textarea>
                    @error('message')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input
                        class="form-control valid"
                        name="fullname"
                        id="fullname"
                        type="text"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your name'"
                        placeholder="Enter your name"
                      />
                      @error('fullname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input
                        class="form-control valid"
                        name="email"
                        id="email"
                        type="email"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email address'"
                        placeholder="Email"
                      />
                      @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <input
                        class="form-control"
                        name="subject"
                        id="subject"
                        type="text"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter Subject'"
                        placeholder="Enter Subject"
                      />
                      @error('subject')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <button
                    type="submit"
                    class="button button-contactForm boxed-btn"
                  >
                    Send
                  </button>
                </div>
              </form>
            </div>
            <div class="col-lg-3 offset-lg-1">
              <div class="media contact-info">
                <span class="contact-info__icon"
                  ><i class="fa fa-home"></i
                ></span>
                <div class="media-body">
                  <h3>{{$setting->address}}</h3>
                  {{-- <p>Rosemead, CA 91770</p> --}}
                </div>
              </div>
              <div class="media contact-info">
                <span class="contact-info__icon"
                  ><i class="fa fa-tablet"></i
                ></span>
                <div class="media-body">
                  <h3>{{$setting->phone}}</h3>
                  <p>Mon to Fri 9am to 6pm</p>
                </div>
              </div>
              <div class="media contact-info">
                <span class="contact-info__icon"
                  ><i class="fa fa-envelope" aria-hidden="true"></i
                ></span>
                <div class="media-body">
                  <h3>{{$setting->email}}</h3>
                  <p>Send us your query anytime!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Contact Area End -->

      <!-- NewsLetter or Ad section -->
      <div class="site-blocks-vs bg-blue">
        <div class="container-fluid p-0">
          <div
            class="bg-image overlay-success rounded py-4"
            style="background-image: url('images/hero_bg_1.jpg')"
            data-stellar-background-ratio="0.5"
          >
            <div class="row align-items-center no-gutters px-5">
              <div class="col-md-12 col-lg-3 mb-4 mb-lg-0 px-5">
                <div class="text-center text-lg-left">
                  <div class="d-block d-lg-flex align-items-center">
                    <div class="image mx-auto mb-3 mb-lg-0 mr-lg-3">
                      <img
                        src="{{asset('frontend/images/logo.png')}}"
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

    </div>

@endsection
@push('scripts')

@endpush
