@extends('frontend.layouts.app')
@push('styles')

@endpush

@section('content')

  <div class="site-wrap">
  <!-- <div class="icon-bar">
  <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
  <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
  <a href="#" class="google"><i class="fab fa-google"></i></a>
</div> -->


    <div class="slide-one-item home-slider owl-carousel">
        @if (count($sliders) > 0)
            @foreach ($sliders as $slider)
            <div class="site-blocks-cover overlay" style="background-image: url({{Storage::disk('uploads')->url($slider->images)}});" data-aos="fade"
                data-stellar-background-ratio="0.5">
                <div class="container">
                <div class="row align-items-end justify-content-start">
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

    </div>



    <div class="bg-blue">
      <div class="container-fluid">

        <div class="row no-gutters ">
            @if ($nextmatch)
              <div class="col-lg-4">
                <div class="widget-title">
                  <h3>Next <br>Match</h3>
                </div>

                <div class="widget-next-match">
                  <div class="text-center widget-vs-contents">
                    {{-- <h3>Match 01</h3> --}}
                  </div>

                  <div class="widget-body mb-3">
                    <div class="widget-vs">
                      <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                        <div class="team-1 text-center">
                          <img src="{{Storage::disk('uploads')->url($nextmatch->team1->logo)}}" alt="Image" style="max-width: 70px">
                          <h3>{{$nextmatch->team1->name}}</h3>
                        </div>
                        <div>
                          <span class="vs"><span>VS</span></span>
                        </div>
                        <div class="team-2 text-center">
                          <img src="{{Storage::disk('uploads')->url($nextmatch->team2->logo)}}" alt="Image" style="max-width: 70px">
                          <h3>{{$nextmatch->team2->name}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="text-center widget-vs-contents">
                    <h4>{{$nextmatch->matchtype->name}}</h4>
                    <p class="mb-5">
                      <span class="d-block">{{date('M d, Y', strtotime($nextmatch->datetime))}}</span>
                      <span class="d-block">{{date('h:m a', strtotime($nextmatch->datetime))}}</span>
                      <span class="d-block">{{$nextmatch->stadium->name}}</span>
                    </p>

                    <div id="date-countdown2" class="pb-1"></div>
                  </div>
                </div>
              </div>
            @endif
            @if ($lastmatch)
              <div class="col-lg-4">
                <div class="widget-title" style="bottom:0;">
                  <h3>Last <br>Match</h3>
                </div>
                <div class="widget-next-match bg-lightblue">
                  <div class="text-center widget-vs-contents">
                    {{-- <h3>Match 02</h3> --}}
                  </div>


                  <div class="widget-body mb-3">
                    <div class="widget-vs">
                      <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                        <div class="team-1 text-center">
                          <img src="{{Storage::disk('uploads')->url($lastmatch->team1->logo)}}" alt="Image" style="max-width: 70px">
                          <h3>{{$lastmatch->team1->name}}</h3>
                        </div>
                        <div>
                          <span class="vs"><span>{{$lastmatch->matchresult->team1_score}}-{{$lastmatch->matchresult->team2_score}}</span></span>
                        </div>
                        <div class="team-2 text-center">
                          <img src="{{Storage::disk('uploads')->url($lastmatch->team2->logo)}}" alt="Image" style="max-width: 70px">
                          <h3>{{$lastmatch->team2->name}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="text-center widget-vs-contents ">
                    <h4>{{$lastmatch->matchtype->name}}</h4>
                    <p class="mb-5">
                        <span class="d-block">{{date('M d, Y', strtotime($lastmatch->datetime))}}</span>
                        <span class="d-block">{{date('h:m a', strtotime($lastmatch->datetime))}}</span>
                        <span class="d-block">{{$lastmatch->stadium->name}}</span>
                    </p>

                    <div id="date-countdown2" class="pb-1"></div>
                  </div>
                </div>
              </div>
            @endif


          <div class="col-lg-4">

            <div class="widget-next-match league-table" >
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
                    @foreach ($standings as $standing)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><strong class="text-white">{{$standing->team->name}}</strong></td>
                        <td>{{$standing->win}}</td>
                        <td>{{$standing->draw}}</td>
                        <td>{{$standing->loss}}</td>
                        <td>{{$standing->points}}</td>
                    </tr>
                    @endforeach

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
            <!-- <span class="tbg">Players</span> -->
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



        <div class="widget-view text-center">
          <a href="{{route('teaminfo')}}" class="boxed-btn">View More</a></div>


      </div>
    </div>










    <!-- NewsLetter or Ad section -->
    <div class="site-blocks-vs bg-blue">
      <div class="container-fluid p-0">

        <div class="bg-image overlay-success rounded py-4"
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
                <form action="{{route('registerSubscriber')}}" method="POST">
                    @csrf
                    @method('POST')
                  <div class="input-group mb-3 d-flex align-items-center w-75">
                    <input type="email" class="form-control " placeholder="Enter Email" aria-label="Enter Email"
                      aria-describedby="button-addon2" name="email">

                    <div class="input-group-append" style="height:51px">
                      <button class="btn btn-primary py-2" type="submit" id="button-addon2">Subscribe</button>
                    </div>
                  </div>
                  @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </form>

              </div>
            </div>



          </div>
        </div>

      </div>
    </div>



          <!-- New News -->
          <div class="content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="widget-title3 text-center">
              <!-- <span class="tbg">Latest</span> -->
              <h4 class="">Let's Update</h4>
              <h3 class="text-black">News</h3>
              <p>
                Fight Defend Win Fight Defend Win Fight Defend Win Fight Defend
                Win Fight Defend Win
              </p>
            </div>
          </div>

          <div class="row section-padding">
            <div class="band">
                <div class="item-1">
                    <a
                      href="{{route('newsdetails', [$latestblog->id, Str::slug($latestblog->title)])}}"
                      class="card"
                    >
                      <div
                        class="thumb"
                        style="
                          background-image: url({{Storage::disk('uploads')->url($latestblog->image)}});
                        "
                      ></div>
                      <article>
                        {{-- <h6 class="text-danger">
                          <i class="fa fa-globe"></i> World
                        </h6> --}}
                        <h1>{{$latestblog->title}}</h1>
                        {{-- <p>
                            {{$latestblog->smalldesc}}
                          </p> --}}
                        <span>{{$latestblog->authorname}}</span>
                        <span>{{date('F d, Y', strtotime($latestblog->date))}}</span>
                      </article>
                    </a>
                  </div>
                @foreach ($latestblogs as $latest)
                  <div class="item-{{$loop->iteration + 1}}">
                    <a
                      href="{{route('newsdetails', [$latest->id, Str::slug($latest->title)])}}"
                      class="card"
                    >
                      <div
                        class="thumb"
                        style="
                          background-image: url({{Storage::disk('uploads')->url($latest->image)}});
                        "
                      ></div>
                      <article>
                        {{-- <h6 class="text-danger">
                          <i class="fa fa-globe"></i> World
                        </h6> --}}
                        <h1>{{$latest->title}}</h1>
                        <p>
                            {{$latest->smalldesc}}
                          </p>
                        <span>{{$latest->authorname}}</span>
                        <span>{{date('F d, Y', strtotime($latest->date))}}</span>
                      </article>
                    </a>
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
      <!-- <span class="tbg">Gallery</span> -->
      <h4 class="">All of us candid</h4>
      <h3 class="text-black">Gallery</h3>
      <p>
        Fight Defend Win Fight Defend Win Fight Defend Win Fight Defend Win
        Fight Defend Win
      </p>
    </div>
  </div>

<div class="row section-padding pb-0">
  <div class="col-12">
    <div class="gallery2">
      <!-- maximum 6 images> randomize the images -->
      @foreach ($pictures as $picture)
      <div class="img-w">
        <img src="{{Storage::disk('uploads')->url($picture->image)}}" alt="" />
        <h2>{{$picture->album->title}}</h2>
      </div>
      @endforeach


    </div>
  </div>


</div>


<div class="widget-view text-center">
          <a href="{{route('viewalbums')}}" class="boxed-btn">View More</a></div>
  </div>
</div>

      <!-- Merch -->
      <div class="content-wrapper pt-0">
        <div class="container-fluid">
          <div class="row">
            <div class="widget-title3 text-center">
              <!-- <span class="tbg">Merchandise</span> -->
              <h4 class="">Cool Designs</h4>
              <h3 class="text-black">Merchandise</h3>
              <p>Shop Now</p>
            </div>
          </div>

          <!-- merch carousel -->

          <div class="row py-5 px-3" style="text-align: -webkit-center">
            <div class="nonloop-block-13 owl-carousel">
                @foreach ($merchandises as $merchandise)
                <div class="item">
                    <div class="product-item">
                      <div class="pi-pic">
                        <img src="{{Storage::disk('uploads')->url($merchandise->image)}}" alt="" />
                        <!-- <div class="sale pp-sale">Sale</div> -->
                        <div class="icon">
                          <i class="icon_heart_alt"></i>
                        </div>
                      </div>
                      <div class="pi-text">
                        <a href="#">
                          <h5>{{$merchandise->name}}</h5>
                        </a>
                        <div class="product-price">Rs.{{$merchandise->price}}</div>
                        <a
                          target="_blank"
                          href="{{$merchandise->link}}"
                          class="
                            button
                            rounded-3
                            primary-bg
                            text-white
                            btn_1
                            boxed-btn
                            p-1
                          "
                        >
                          <i class="fas fa-shopping-cart"></i>Buy
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach

            </div>
            <div class="widget-view text-center">
        </div>


      </div>

      <!-- Matches -->
      <div class="content-wrapper pt-0">
        <div class="container-fluid">
          <div class="row">
            <div class="widget-title3 text-center">
              <!-- <span class="tbg">Matches</span> -->
              <h4 class="">Win lose draw wait</h4>
              <h3 class="text-black">Matches</h3>
              <p>BCFC Plays</p>
            </div>
          </div>

          <div class="row py-5 px-3" style="text-align: -webkit-center">
            <div class="nonloop-block-13 owl-carousel">
                @foreach ($finishedmatches as $finishedmatch)
                <div class="item">
                    <div class="match-box">
                      <div class="text-center widget-vs-3-contents mb-4">
                        <h4>{{$finishedmatch->matchtype->name}}</h4>
                        <p class="">
                          <span class="d-block">{{date('M d, Y', strtotime($finishedmatch->datetime))}}</span>
                          <span class="d-block">{{date('h:m a', strtotime($finishedmatch->datetime))}}, {{$finishedmatch->stadium->name}}</span>
                        </p>
                      </div>
                      <div class="widget-body">
                        <div class="widget-vs-3">
                          <div
                            class="
                              d-flex
                              align-items-center
                              justify-content-around justify-content-between
                              w-100
                            "
                          >
                            <div class="team-1 text-center">
                              <img src="{{Storage::disk('uploads')->url($finishedmatch->team1->logo)}}" alt="Image" style="max-width: 70px"/>
                            </div>
                            <div>
                              <span class="vs"><span>{{$finishedmatch->matchresult->team1_score}}-{{$finishedmatch->matchresult->team2_score}}</span></span>
                            </div>
                            <div class="team-2 text-center">
                              <img src="{{Storage::disk('uploads')->url($finishedmatch->team2->logo)}}" alt="Image" style="max-width: 70px"/>
                            </div>
                          </div>
                          <h3 class="text-center">{{$finishedmatch->team1->name}} vs {{$finishedmatch->team2->name}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach

            </div>
          </div>
        </div>
        <div class="widget-view text-center">
          <a href="{{route('getmatches')}}" class="boxed-btn">View More</a>
        </div>
      </div>


        </div>
      </div>

    <!-- this is the Sponsor Section -->

    <div class="content-wrapper pt-0">
<div class="container-fluid px-0">
  <div class="row">
    <div class="widget-title3 text-center">
      <!-- <span class="tbg">Gallery</span> -->
      <h4 class="">Supporting us since 2020</h4>
      <h3 class="text-black">Partners</h3>
      <p>
        Fight Defend Win Fight Defend Win Fight Defend Win Fight Defend Win
        Fight Defend Win
      </p>
    </div>
  </div>
                      </div>
                      </div>




    <div class="site-section block-13"
      >

      <div class="container-fluid">


        <div class="row px-5">
          <!-- Partner Logo Section Begin -->

          <div class="logo-carousel1">
              @if (count($partners) > 0)
                  @foreach ($partners as $partner)
                  <div class="logo-item">
                    <div class="tablecell-inner">
                      <img src="{{Storage::disk('uploads')->url($partner->logo)}}" alt="">
                    </div>
                  </div>
                  @endforeach
              @endif

          <!-- Partner Logo Section End -->






        </div>
      </div>

    </div>





  </div>
@endsection
@push('scripts')

@endpush


