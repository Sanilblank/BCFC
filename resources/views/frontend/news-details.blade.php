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
                  <h2>{{$selectedblog->title}}</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->
      <!--? Blog Area Start -->
      <section class="blog_area single-post-area section-padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 posts-list">
              <div class="single-post">
                <div class="feature-img">
                  <img class="img-fluid" src="{{Storage::disk('uploads')->url($selectedblog->image)}}" alt="" />
                </div>
                <div class="blog_details px-3">
                  <h2 style="color: #2d2d2d">
                    {{$selectedblog->smalldesc}}
                  </h2>
                  <ul class="blog-info-link mt-3 mb-4">
                    <li>
                        <i class="fa fa-user"></i>
                        @foreach ($selectedblog->tag as $tagid)
                        @php
                            $tagitem = DB::table('blog_tags')->where('id', $tagid)->first();

                        @endphp
                            <a href="{{route('gettagnews', [$tagitem->id, $tagitem->slug])}}"> {{$tagitem->name}} ,</a>
                        @endforeach
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-comments"></i> 03 Comments</a>
                    </li>
                  </ul>

                  <p>
                    {!! $selectedblog->details !!}
                  </p>
                  {{-- <div class="quote-wrapper">
                    <div class="quotes">
                      MCSE boot camps have its supporters and its detractors.
                      Some people do not understand why you should have to spend
                      money on boot camp when you can get the MCSE study
                      materials yourself at a fraction of the camp price.
                      However, who has the willpower to actually sit through a
                      self-imposed MCSE training.
                    </div>
                  </div> --}}


                </div>
              </div>
              <div class="navigation-top">
                <div class="d-sm-flex justify-content-between text-center">
                  {{-- <p class="like-info">
                    <span class="align-middle"
                      ><i class="fa fa-heart"></i
                    ></span>
                    Lily and 4 people like this
                  </p> --}}
                  {{-- <div class="col-sm-4 text-center my-2 my-sm-0"> --}}
                    <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                  {{-- </div> --}}
                  {{-- <ul class="social-icons">
                    <li>
                      <a href="https://www.facebook.com/sai4ull"
                        ><i class="fab fa-facebook-f"></i
                      ></a>
                    </li>
                    <li>
                      <a href="#"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fab fa-dribbble"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fab fa-behance"></i></a>
                    </li>
                  </ul> --}}
                </div>
                <div class="navigation-area">
                  <div class="row">

                        <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                            @if ($previousblog)
                            <div class="thumb">
                            <a href="{{route('newsdetails', [$previousblog->id, Str::slug($previousblog->title)])}}">
                                <img class="img-fluid" src="{{Storage::disk('uploads')->url($previousblog->image)}}" alt=""/>
                            </a>
                            </div>
                            <div class="arrow">
                            <a href="#">
                                <span class="lnr text-white ti-arrow-left"></span>
                            </a>
                            </div>
                            <div class="detials">
                            <p>Prev Post</p>
                            <a href="{{route('newsdetails', [$previousblog->id, Str::slug($previousblog->title)])}}">
                                {{-- <h4 style="color: #2d2d2d">
                                Space The Final Frontier
                                </h4> --}}
                            </a>
                            </div>
                            @endif

                        </div>
                      <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                        @if ($nextblog)

                        <div class="detials">
                          <p>Next Post</p>
                          <a href="{{route('newsdetails', [$nextblog->id, Str::slug($nextblog->title)])}}">
                            {{-- <h4 style="color: #2d2d2d">Telescopes 101</h4> --}}
                          </a>
                        </div>
                        <div class="arrow">
                          <a href="#">
                            <span class="lnr text-white ti-arrow-right"></span>
                          </a>
                        </div>
                        <div class="thumb">
                          <a href="{{route('newsdetails', [$nextblog->id, Str::slug($nextblog->title)])}}">
                            <img
                              class="img-fluid"
                              src="{{Storage::disk('uploads')->url($nextblog->image)}}"
                              alt=""
                            />
                          </a>
                        </div>
                        @endif

                      </div>

                  </div>
                </div>
              </div>
              <div class="blog-author">
                <div class="media align-items-center">
                  <img src="{{Storage::disk('uploads')->url($selectedblog->authorimage)}}" alt="" />
                  <div class="media-body">
                    <a href="{{route('getauthornews', $selectedblog->authorname)}}">
                      <h4>{{$selectedblog->authorname}}</h4>
                    </a>
                    <p>
                        <a href="{{route('getauthornews', $selectedblog->authorname)}}">
                            Click to view all posts made by the author.
                        </a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="comments-area">
                <h4>05 Comments</h4>
                <div class="comment-list">
                  <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                      <div class="thumb">
                        <img src="{{asset('frontend/images/person_1.jpg')}}" alt="" />
                      </div>
                      <div class="desc">
                        <p class="comment">
                          Multiply sea night grass fourth day sea lesser rule
                          open subdue female fill which them Blessed, give fill
                          lesser bearing multiply sea night grass fourth day sea
                          lesser
                        </p>
                        <div class="d-flex justify-content-between">
                          <div class="d-flex align-items-center">
                            <h5>
                              <a href="#">Emilly Blunt</a>
                            </h5>
                            <p class="date">December 4, 2017 at 3:12 pm</p>
                          </div>
                          <div class="reply-btn">
                            <a href="#" class="btn-reply text-uppercase"
                              >reply</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="comment-list">
                  <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                      <div class="thumb">
                        <img src="{{asset('frontend/images/person_3.jpg')}}" alt="" />
                      </div>
                      <div class="desc">
                        <p class="comment">
                          Multiply sea night grass fourth day sea lesser rule
                          open subdue female fill which them Blessed, give fill
                          lesser bearing multiply sea night grass fourth day sea
                          lesser
                        </p>
                        <div class="d-flex justify-content-between">
                          <div class="d-flex align-items-center">
                            <h5>
                              <a href="#">Emilly Blunt</a>
                            </h5>
                            <p class="date">December 4, 2017 at 3:12 pm</p>
                          </div>
                          <div class="reply-btn">
                            <a href="#" class="btn-reply text-uppercase"
                              >reply</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="comment-list">
                  <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                      <div class="thumb">
                        <img src="{{asset('frontend/images/person_4.jpg')}}" alt="" />
                      </div>
                      <div class="desc">
                        <p class="comment">
                          Multiply sea night grass fourth day sea lesser rule
                          open subdue female fill which them Blessed, give fill
                          lesser bearing multiply sea night grass fourth day sea
                          lesser
                        </p>
                        <div class="d-flex justify-content-between">
                          <div class="d-flex align-items-center">
                            <h5>
                              <a href="#">Emilly Blunt</a>
                            </h5>
                            <p class="date">December 4, 2017 at 3:12 pm</p>
                          </div>
                          <div class="reply-btn">
                            <a href="#" class="btn-reply text-uppercase"
                              >reply</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="comment-form">
                <h4>Leave a Reply</h4>
                <form
                  class="form-contact comment_form"
                  action="#"
                  id="commentForm"
                >
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <textarea
                          class="form-control w-100"
                          name="comment"
                          id="comment"
                          cols="30"
                          rows="9"
                          placeholder="Write Comment"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input
                          class="form-control"
                          name="name"
                          id="name"
                          type="text"
                          placeholder="Name"
                        />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input
                          class="form-control"
                          name="email"
                          id="email"
                          type="email"
                          placeholder="Email"
                        />
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <input
                          class="form-control"
                          name="website"
                          id="website"
                          type="text"
                          placeholder="Website"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button
                      type="submit"
                      class="button button-contactForm btn_1 boxed-btn"
                    >
                      Post Comment
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget search_widget">
                    <form action="{{route('page.search')}}" method="GET">
                      @csrf
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Search Keyword"
                            onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Search Keyword'"
                            name="word"
                          />
                          <div class="input-group-append">
                            <button class="btns" type="submit">
                              <i class="fa fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </aside>

                <aside class="single_sidebar_widget tag_cloud_widget">
                    <h4 class="widget_title" style="color: #2d2d2d">Latest Tags</h4>
                    <ul class="list">
                      @foreach ($latesttags as $latesttag)
                        <li>
                          <a href="{{route('gettagnews', [$latesttag->id, $latesttag->slug])}}">{{$latesttag->name}}</a>
                        </li>
                      @endforeach

                    </ul>
                  </aside>

                <aside class="single_sidebar_widget newsletter_widget">
                  <h4 class="widget_title" style="color: #2d2d2d">
                    Newsletter
                  </h4>
                  <form action="#">
                    <div class="form-group">
                      <input
                        type="email"
                        class="form-control"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email'"
                        placeholder="Enter email"
                        required
                      />
                    </div>
                    <button
                      class="
                        button
                        rounded-0
                        primary-bg
                        text-white
                        w-100
                        btn_1
                        boxed-btn
                      "
                      type="submit"
                    >
                      Subscribe
                    </button>
                  </form>
                </aside>
                <aside class="single_sidebar_widget newsletter_widget">
                  <h4 class="widget_title" style="color: #2d2d2d">Standings</h4>
                  <table class="table custom-table2" style="padding: 0px">
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
                        <td><strong class="">Football League</strong></td>
                        <td>22</td>
                        <td>3</td>
                        <td>2</td>
                        <td>140</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td><strong class="">Soccer</strong></td>
                        <td>22</td>
                        <td>3</td>
                        <td>2</td>
                        <td>140</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td><strong class="">Juvendo</strong></td>
                        <td>22</td>
                        <td>3</td>
                        <td>2</td>
                        <td>140</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>
                          <strong class="">French Football League</strong>
                        </td>
                        <td>22</td>
                        <td>3</td>
                        <td>2</td>
                        <td>140</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td><strong class="">Legia Abante</strong></td>
                        <td>22</td>
                        <td>3</td>
                        <td>2</td>
                        <td>140</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td><strong class="">Gliwice League</strong></td>
                        <td>22</td>
                        <td>3</td>
                        <td>2</td>
                        <td>140</td>
                      </tr>
                    </tbody>
                  </table>
                </aside>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Blog Area End -->

      <div class="site-section pb-2">
        <div class="container-fluid">
          <div class="row pb-5">
            <div class="widget-title2 text-black">
              <h3 class="text-black">LATEST NEWS/BLOGS</h3>
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

    </div>

@endsection
@push('scripts')

@endpush
