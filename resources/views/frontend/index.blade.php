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
      <div class="site-blocks-cover overlay" style="background-image: url(frontend/images/hero_bg_2.jpg);" data-aos="fade"
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
      </div>

      <div class="site-blocks-cover overlay" style="background-image: url(frontend/images/hero_bg_4.jpg);" data-aos="fade"
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
      </div>

      <div class="site-blocks-cover overlay" style="background-image: url(frontend/images/hero_bg_3.jpg);" data-aos="fade"
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
      </div>
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
                  <strong class="text-white">Dashrath Rangasala</strong>
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
                  <strong class="text-white">Dashrath Rangasala</strong>
                </p>

                <div id="date-countdown2" class="pb-1"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">

            <div class="widget-next-match">
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



    <div class="site-blocks-cover overlay py-5" style="background-image: url(frontend/images/hero2.jpg); height:90vh; ">
      <div class="container">
        <!-- <div class="row">
          <div class="col-6 title-section">
            <h2 class="heading">Videos</h2>
          </div>
          <div class="col-6 text-right">
            <div class="custom-nav">
            <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
            <span></span>
            <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
            </div>
          </div>
        </div> -->

        <div class="section-title pt-150">
          <h2>Players</h2>
        </div>
        <div class="owl-4-slider owl-carousel mt-5">
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



    <div class="site-section pb-2">
      <div class="container-fluid">
        <div class="row pb-5">
          <div class="widget-title2 text-black">
            <h3 class="text-black">NEWS</h3>
          </div>
        </div>
        <div class="row mt-5 ">
          <div class="col-md-6 col-lg-7">
            <div class="site-blocks-cover overlay" style="background-image: url({{Storage::disk('uploads')->url($latestblog->image)}}); height: 466px; cursor: pointer;" onclick="location.href='{{route('newsdetails', [$latestblog->id, Str::slug($latestblog->title)])}}'">
              <div class="container">
                <div class="row align-items-center justify-content-start" style='height: auto;'>
                  <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                    {{-- <p><a href="#" class="btn btn-primary btn-sm rounded-0 px-3">Hero Section</a></p> --}}
                    <h1 class="">{{$latestblog->title}}</h1>
                    <p>{{$latestblog->smalldesc}}</p>
                    <p><a href="{{route('newsdetails', [$latestblog->id, Str::slug($latestblog->title)])}}" class="border-bottom border-primary" style="color:white;">Read More</a></p>
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
                    <div class="custom-media-2 d-lg-flex d-md-flex">
                      {{-- <div class="cat"><a href="#" class="btn btn-primary btn-sm rounded-0 px-3">Goal!</a></div> --}}

                      <div class="img mr-4">
                        <img src="{{Storage::disk('uploads')->url($blog->image)}}" alt="Image" class="">

                      </div>
                      <div class="text">
                        <span class="meta">{{date('F d, Y', strtotime($blog->date))}}</span>
                        <h3 class="mb-4"><a href="{{route('newsdetails', [$blog->id, Str::slug($blog->title)])}}">{{$blog->title}}</a></h3>
                        <p>{{$blog->smalldesc}}</p>

                          <a href="{{route('newsdetails', [$blog->id, Str::slug($blog->title)])}}" class="border-bottom border-primary">Read More</a>
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

<div class="row pb-5">
  <div class="widget-title2 text-black">
    <h3 class="text-black">Gallery</h3>
  </div>
</div>

    <div class="gallery pt-5">

      <div class="gallery__column">
        <a href="https://unsplash.com/@jeka_fe" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80" alt="Portrait by Jessica Felicio" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Jessica Felicio</figcaption>
          </figure>
        </a>

        <a href="https://unsplash.com/@oladimeg" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1522778526097-ce0a22ceb253?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Portrait by Oladimeji Odunsi" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Oladimeji Odunsi</figcaption>
          </figure>
        </a>

        <a href="https://unsplash.com/@a2eorigins" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1434648957308-5e6a859697e8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=967&q=80" alt="Portrait by Alex Perez" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Alex Perez</figcaption>
          </figure>
        </a>
      </div>

      <div class="gallery__column">
        <a href="https://unsplash.com/@noahbuscher" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1486286701208-1d58e9338013?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80" alt="Portrait by Noah Buscher" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Noah Buscher</figcaption>
          </figure>
        </a>

        <a href="https://unsplash.com/@von_co" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1581187375550-48c9a182e38b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=926&q=80" alt="Portrait by Ivana Cajina" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Ivana Cajina</figcaption>
          </figure>
        </a>

        <a href="https://unsplash.com/@samburriss" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1546608235-3310a2494cdf?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=582&q=80" alt="Portrait by Sam Burriss" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Sam Burriss</figcaption>
          </figure>
        </a>
      </div>

      <div class="gallery__column">
        <a href="https://unsplash.com/@marilezhava" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1516283250450-174387a1af6b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80" alt="Portrait by Mari Lezhava" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Mari Lezhava</figcaption>
          </figure>
        </a>

        <a href="https://unsplash.com/@ethanhaddox" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1560272564-c83b66b1ad12?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Portrait by Ethan Haddox" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Ethan Haddox</figcaption>
          </figure>
        </a>


      </div>

      <div class="gallery__column">
        <a href="https://unsplash.com/@frxgui" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1489944440615-453fc2b6a9a9?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1482&q=80" alt="Portrait by Guilian Fremaux" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Guilian Fremaux</figcaption>
          </figure>
        </a>

        <a href="https://unsplash.com/@majestical_jasmin" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1511426463457-0571e247d816?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=700&q=80" alt="Portrait by Jasmin Chew" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Jasmin Chew</figcaption>
          </figure>
        </a>

        <a href="https://unsplash.com/@dimadallacqua" target="_blank" class="gallery__link">
          <figure class="gallery__thumb">
            <img src="https://images.unsplash.com/photo-1420316078344-6149cb82b2c7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80" alt="Portrait by Dima DallAcqua" class="gallery__image">
            <figcaption class="gallery__caption">Portrait by Dima DallAcqua</figcaption>
          </figure>
        </a>

      </div>
    </div>




    <!-- gallery two -->




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


