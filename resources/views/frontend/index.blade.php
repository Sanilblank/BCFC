@extends('frontend.layouts.app')
@push('styles')

@endpush

@section('content')

  <div class="site-wrap">
  <div class="icon-bar">
  <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
  <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
  <a href="#" class="google"><i class="fab fa-google"></i></a>
</div>


    <div class="slide-one-item home-slider owl-carousel">
        @if (count($sliders) > 0)
            @foreach ($sliders as $slider)
            <div class="site-blocks-cover overlay" style="background-image: url({{Storage::disk('uploads')->url($slider->images)}});" data-aos="fade"
                data-stellar-background-ratio="0.5">
                <div class="container">
                <div class="row align-items-center justify-content-start">
                    <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    <p><a href="#" class="btn btn-primary btn-sm rounded-0 px-3">{{$slider->subtitle}}</a></p>
                    <h1 class="">{{$slider->title}}</h1>
                    <p><a href="{{route('sliderinfo', [$slider->id, Str::slug($slider->title)])}}" class="border-bottom border-primary" style="color:white;">Read More</a></p>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        @endif


      {{-- <div class="site-blocks-cover overlay" style="background-image: url(frontend/images/hero_bg_4.jpg);" data-aos="fade"
        data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-start">
            <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
              <p><a href="#" class="btn btn-primary btn-sm rounded-0 px-3">Hero Section</a></p>
              <h1 class="">Player of the Week</h1>
              <p><a href="#" class="border-bottom border-primary" style="color:white;">Read More</a></p>
            </div>
          </div>
        </div>
      </div> --}}

      {{-- <div class="site-blocks-cover overlay" style="background-image: url(frontend/images/hero_bg_3.jpg);" data-aos="fade"
        data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-start">
            <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
              <p><a href="#" class="btn btn-primary btn-sm rounded-0 px-3">Hero Section</a></p>
              <h1 class="">Player of the Week</h1>
              <p><a href="#" class="border-bottom border-primary" style="color:white;">Read More</a></p>
            </div>
          </div>
        </div>
      </div> --}}
    </div>


    <div class="site-section pt-0 feature-blocks-1" data-aos="fade" data-aos-delay="100">
      <div class="container-fluid d-flex justify-content-end">
        <div class="row">

          <!-- <div class="col-md-6 col-lg-4" >
            </div> -->
          {{-- <div class="col-md-6 col-lg-6">
            <div class="custom-media d-flex">
              <div class="img mr-4">
                <img src="{{asset('frontend/images/img_2.jpg')}}" alt="Image" class="img-fluid">
              </div>
              <div class="text">
                <span class="meta">May 20, 2020</span>
                <h3 class="mb-4"><a href="#">Romolu to stay at Real Nadrid?</a></h3>

                <p><a href="#">Read more</a></p>
              </div>
            </div>
          </div> --}}
          {{-- <div class="col-md-6 col-lg-6">
            <div class="custom-media d-flex">
              <div class="img mr-4">
                <img src="{{asset('frontend/images/img_1.jpg')}}" alt="Image" class="img-fluid">
              </div>
              <div class="text">
                <span class="meta">May 20, 2020</span>
                <h3 class="mb-4"><a href="#">Romolu to stay at Real Nadrid?</a></h3>

                <p><a href="#">Read more</a></p>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>


    <div class="bg-blue">
      <div class="container-fluid">

        <div class="row no-gutters ">
          <div class="col-lg-4">
            <div class="widget-title">
              <h3>Next <br>Match</h3>
            </div>

            <div class="widget-next-match">
              <div class="text-center widget-vs-contents">
                <h3>Match 01</h3>
              </div>

              <div class="widget-body mb-3">
                <div class="widget-vs">
                  <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                    <div class="team-1 text-center">
                      <img src="{{asset('frontend/images/logo_1.png')}}" alt="Image">
                      <h3>Football League</h3>
                    </div>
                    <div>
                      <span class="vs"><span>VS</span></span>
                    </div>
                    <div class="team-2 text-center">
                      <img src="{{asset('frontend/images/logo_2.png')}}" alt="Image">
                      <h3>Soccer</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center widget-vs-contents">
                <h4>Nepal Super League</h4>
                <p class="mb-5">
                  <span class="d-block">December 20th, 2020</span>
                  <span class="d-block">9:30 AM GMT+0</span>
                  <span class="d-block">Dashrath Rangasala</span>
                </p>

                <div id="date-countdown2" class="pb-1"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="widget-title" style="bottom:0;">
              <h3>Last <br>Match</h3>
            </div>
            <div class="widget-next-match bg-lightblue">
              <div class="text-center widget-vs-contents">
                <h3>Match 02</h3>
              </div>


              <div class="widget-body mb-3">
                <div class="widget-vs">
                  <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                    <div class="team-1 text-center">
                      <img src="{{asset('frontend/images/logo_1.png')}}" alt="Image">
                      <h3>Football League</h3>
                    </div>
                    <div>
                      <span class="vs"><span>4-4</span></span>
                    </div>
                    <div class="team-2 text-center">
                      <img src="{{asset('frontend/images/logo_2.png')}}" alt="Image">
                      <h3>Soccer</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center widget-vs-contents ">
                <h4>Nepal Cup League</h4>
                <p class="mb-5">
                  <span class="d-block">December 20th, 2020</span>
                  <span class="d-block">9:30 AM GMT+0</span>
                  <span class="d-block">Dashrath Rangasala</span>
                </p>

                <div id="date-countdown2" class="pb-1"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">

            <div class="widget-next-match"  style="max-height: 500px; padding: 100px 50px;line-height:1;">
              <table class="table custom-table">
                <thead>
                  <tr>
                    <th>P</th>
                    <th>Team</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>PTS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><strong class="text-white">Football League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><strong class="text-white">Soccer</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><strong class="text-white">Juvendo</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><strong class="text-white">French Football League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><strong class="text-white">Legia Abante</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><strong class="text-white">Gliwice League</strong></td>
                    <td>22</td>
                    <td>3</td>
                    <td>2</td>
                    <td>140</td>
                  </tr>

                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div> <!-- .site-section -->



    <div class="site-blocks-cover content-wrapper" style="background-image: url(frontend/images/hero2.jpg); ">
      <div class="container-fluid">
      <div class="widget-title2 text-center">
            <span class="tbg">Players</span>
            <h4 class="">Meet the Super Team</h4>
            <h3 class="text-black">Players</h3>
            <p>
              Fight Defend Win Fight Defend Win Fight Defend Win Fight Defend
              Win Fight Defend Win
            </p>
          </div>
        <div class="owl-4-slider owl-carousel mt-5" style="padding:0 100px;">
            @foreach ($teammembers as $member)
                <div class="item">
                    <div class="video-media">

                    <div class="player-no">
                        <h1>{{$member->shirtno}}</h1>
                    </div>
                    <img src="{{Storage::disk('uploads')->url($member->photo)}}" alt="Image" class="img-fluid" style="max-width: 300px">
                    <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>

                        <!-- <div class="caption">
                        <h3 class="m-0">Pogma Kai</h3>
                        </div> -->
                    </a>
                    </div>
                    <div class="caption">
                    <h3 class="m-0">{{$member->name}}</h3>
                    <h2>#{{$member->teamposition->name}}</h2>
                    </div>
                </div>
            @endforeach


        </div>

      </div>
    </div>









    <!-- NewsLetter or Ad section -->
    <div class="site-blocks-vs bg-blue">
      <div class="container-fluid p-0">

        <div class="bg-image overlay-success rounded py-4" style="background-image: url('frontend/images/hero_bg_1.jpg');"
          data-stellar-background-ratio="0.5">

          <div class="row align-items-center no-gutters px-5">
            <div class="col-md-12 col-lg-3 mb-4 mb-lg-0 px-5">

              <div class="text-center text-lg-left">
                <div class="d-block d-lg-flex align-items-center">
                  <div class="image mx-auto mb-3 mb-lg-0 mr-lg-3">
                    <img src="{{asset('frontend/images/logo.png')}}" alt="Image" class="img-fluid">
                  </div>
                  <div class="text">
                    <h3 class="h5 mb-0 text-white" style=" font-family: 'Bebas Neue', cursive;">Get Access to all the Events and Updates
                      <br><span class="text-uppercase small country text-white">News Letter</span></h3>

                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-12 col-lg-9 text-center mb-4 mb-lg-0 px-5">
              <div class="">
                <form action="#" method="post">
                  <div class="input-group mb-3 d-flex align-items-center w-75">
                    <input type="text" class="form-control " placeholder="Enter Email" aria-label="Enter Email"
                      aria-describedby="button-addon2">
                    <div class="input-group-append" style="height:51px">
                      <button class="btn btn-primary py-2" type="button" id="button-addon2">Subscribe</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>



          </div>
        </div>

      </div>
    </div>



    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
        <div class="widget-title3 text-center">
              <span class="tbg">Latest</span>
              <h4 class="">Let's Update</h4>
              <h3 class="text-black">News</h3>
              <p>
                Fight Defend Win Fight Defend Win Fight Defend Win Fight Defend
                Win Fight Defend Win
              </p>
            </div>
        </div>
        <div class="row section-padding">
          <div class="col-md-6 col-lg-7">
            <div class="site-blocks-cover overlay" style="background-image: url({{Storage::disk('uploads')->url($latestblog->image)}}); height: 466px; cursor: pointer;" onclick="location.href='{{route('newsdetails', [$latestblog->id, Str::slug($latestblog->title)])}}'">
              <div class="container">
                <div class="row align-items-center justify-content-start" style='height: auto;'>
                  <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    {{-- <p><a href="#" class="btn btn-primary btn-sm rounded-0 px-3">Hero Section</a></p> --}}
                    <h1 class="" style="background-color: #00000080; padding:20px 0px;">{{$latestblog->title}}</h1>
                    <!-- <p>{{$latestblog->smalldesc}}</p> -->
                    <!-- <p><a href="{{route('newsdetails', [$latestblog->id, Str::slug($latestblog->title)])}}" class="border-bottom border-primary" style="color:white;">Read More</a></p> -->
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-md-6 col-lg-5">
            <!--
            <div class="row">
              <div class="post-entry">
                <div class="image">
                  <img src="{{asset('frontend/images/img_2.jpg')}}" alt="Image" class="img-fluid">
                </div>
                <div class="text p-4">
                  <h2 class="h5 text-black"><a href="#">RealMad vs Striker Who Will Win?</a></h2>
                  <span class="text-uppercase date d-block mb-3"><small>By Colorlib &bullet; Sep 25, 2018</small></span>
                  <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat beatae doloremque, ex corrupti perspiciatis.</p>
                </div>
              </div>
              <div class="post-entry">
                <div class="image">
                  <img src="{{asset('frontend/images/img_3.jpg')}}" alt="Image" class="img-fluid">
                </div>
                <div class="text p-4">
                  <h2 class="h5 text-black"><a href="#">RealMad vs Striker Who Will Win?</a></h2>
                  <span class="text-uppercase date d-block mb-3"><small>By Colorlib &bullet; Sep 25, 2018</small></span>
                  <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat beatae doloremque, ex corrupti perspiciatis.</p>
                </div>
              </div>


            </div> -->

            <div class="row">

              <!-- <div class="col-md-6 col-lg-4" >
                </div> -->
                @foreach ($latestthreeblogs as $blog)
                  <div class="col-md-6 col-lg-12 mb-2" style="cursor: pointer" onclick="location.href='{{route('newsdetails', [$blog->id, Str::slug($blog->title)])}}'">
                    <div class="custom-media-2 d-lg-flex">
                      {{-- <div class="cat"><a href="#" class="btn btn-primary btn-sm rounded-0 px-3">Goal!</a></div> --}}

                      <div class="img mr-4">
                        <img src="{{Storage::disk('uploads')->url($blog->image)}}" alt="Image" class="">

                      </div>
                      <div class="text">
                        <span class="meta">{{date('F d, Y', strtotime($blog->date))}}</span>
                        <h3 class="mb-4"><a href="{{route('newsdetails', [$blog->id, Str::slug($blog->title)])}}">{{$blog->title}}</a></h3>
                        <!-- <p>{{$blog->smalldesc}}</p>

                          <a href="{{route('newsdetails', [$blog->id, Str::slug($blog->title)])}}" class="border-bottom border-primary">Read More</a> -->
                      </div>
                    </div>
                  </div>
                @endforeach

            </div>

          </div>
          <!-- <div class="col-md-6 col-lg-4">
            <div class="post-entry">
              <div class="image">
                <img src="{{asset('frontend/images/img_3.jpg')}}" alt="Image" class="img-fluid">
              </div>
              <div class="text p-4">
                <h2 class="h5 text-black"><a href="#">RealMad vs Striker Who Will Win?</a></h2>
                <span class="text-uppercase date d-block mb-3"><small>By Colorlib &bullet; Sep 25, 2018</small></span>
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat beatae doloremque, ex corrupti perspiciatis.</p>
              </div>
            </div>
          </div> -->
        </div>

        <!-- Slider News -->

        <div class="row pt-5 px-3">
          <div class="nonloop-block-13 owl-carousel">
              @foreach ($latestblogs as $latestblog)
              <div class="item" style="cursor: pointer" onclick="location.href='{{route('newsdetails', [$blog->id, Str::slug($blog->title)])}}'">
                <!-- uses .block-12 -->
                <div class="block-12">
                  <figure>
                    <img src="{{Storage::disk('uploads')->url($latestblog->image)}}" alt="Image" class="img-fluid">
                  </figure>
                  <div class="text">
                    <span class="meta">{{date('F d, Y', strtotime($latestblog->date))}}</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3"><a href="{{route('newsdetails', [$latestblog->id, Str::slug($latestblog->title)])}}" class="text-black">{{$latestblog->title}}</a></h2>
                      {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad culpa, consectetur! Eligendi illo,
                        repellat repudiandae cumque fugiat optio!</p> --}}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach


          </div>
        </div>

      </div>
    </div>

      <!-- gallery one -->
      <div class="content-wrapper pt-0">
<div class="container-fluid px-0">
  <div class="row">
    <div class="widget-title3 text-center">
      <span class="tbg">Gallery</span>
      <h4 class="">All of us candid</h4>
      <h3 class="text-black">Gallery</h3>
      <p>
        Fight Defend Win Fight Defend Win Fight Defend Win Fight Defend Win
        Fight Defend Win
      </p>
    </div>
</div>

<div class="row no-gutters section-padding pb-0">
  <div class="col-9 bg-blue">
    <div class="gallery2">
      <!-- maximum 6 images> randomize the images -->
      <div class="img-w">
        <img src="https://images.unsplash.com/photo-1485766410122-1b403edb53db?dpr=1&auto=format&fit=crop&w=1500&h=846&q=80&cs=tinysrgb&crop=" alt="" />
        <h2>Caption</h2>
      </div>
      <div class="img-w"><img src="https://images.unsplash.com/photo-1485793997698-baba81bf21ab?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=" alt="" />
        <h2>Football</h2></div>
      <div class="img-w"><img src="https://images.unsplash.com/photo-1485871800663-71856dc09ec4?dpr=1&auto=format&fit=crop&w=1500&h=2250&q=80&cs=tinysrgb&crop=" alt="" />
      <h2>Biratnagar City FC</h2>
      </div>
      <div class="img-w"><img src="https://images.unsplash.com/photo-1485871882310-4ecdab8a6f94?dpr=1&auto=format&fit=crop&w=1500&h=2250&q=80&cs=tinysrgb&crop=" alt="" /></div>
      <div class="img-w"><img src="https://images.unsplash.com/photo-1485872304698-0537e003288d?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=" alt="" /></div>
      <div class="img-w"><img src="https://images.unsplash.com/photo-1485872325464-50f17b82075a?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=" alt="" /></div>
      <div class="img-w"><img src="https://images.unsplash.com/photo-1470171119584-533105644520?dpr=1&auto=format&fit=crop&w=1500&h=886&q=80&cs=tinysrgb&crop=" alt="" /></div>
    </div>
  </div>


  <!-- this is for ad-section -->
  <div class="col-3 bg-primary">
    <div class="img-ad"><img src="https://images.unsplash.com/photo-1517747614396-d21a78b850e8?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1482&q=80" alt="" /></div>
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
            <div class="logo-item">
              <div class="tablecell-inner">
                <img src="{{asset('frontend/images/logo-carousel/logo-1.png')}}" alt="">
              </div>
            </div>
            <div class="logo-item">
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
            </div>
          </div>
          <!-- Partner Logo Section End -->






        </div>
      </div>

    </div>





  </div>
@endsection
@push('scripts')

@endpush


