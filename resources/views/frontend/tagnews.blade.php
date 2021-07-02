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
                  <h2>News/Blogs with tag {{$selectedtag->name}}</h2>
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
            <div class="col-lg-8 mb-5 mb-lg-0">
              <div class="blog_left_sidebar">
                {{-- <article class="blog_item">
                  <div class="blog_item_img">
                    <div class="cat">
                      <a href="#" class="btn btn-primary btn-sm rounded-0 px-3"
                        >Goal!</a
                      >
                      <a href="#" class="btn btn-primary btn-sm rounded-0 px-3"
                        >Goal!</a
                      >

                      <a href="#" class="btn btn-primary btn-sm rounded-0 px-3"
                        >Goal!</a
                      >
                    </div>

                    <img
                      class="card-img rounded-0"
                      src="images/hero_bg_1.jpg"
                      alt=""
                    />
                    <a href="#" class="blog_item_date">
                      <h3>15</h3>
                      <p>Jan</p>
                    </a>
                  </div>
                  <div class="blog_details">
                    <a class="d-inline-block" href="{{route('newsdetails', [1, Str::slug('Hello Whats Up')])}}">
                      <h2 class="blog-head" style="color: #2d2d2d">
                        Google inks pact for new 35-storey office
                      </h2>
                    </a>
                    <p>
                      That dominion stars lights dominion divide years for
                      fourth have don't stars is that he earth it first without
                      heaven in place seed it second morning saying.
                    </p>
                    <ul class="blog-info-link">
                      <li>
                        <a href="#"
                          ><i class="fa fa-user"></i> Travel, Lifestyle</a
                        >
                      </li>
                      <li>
                        <a href="#"
                          ><i class="fa fa-comments"></i> 03 Comments</a
                        >
                      </li>
                    </ul>
                  </div>
                </article> --}}
                @if (count($blogs) == 0)
                    <h3>No news/blogs with this tag.</h3>
                @endif
                @foreach ($blogs as $blog)
                    <article class="blog_item" onclick="location.href='{{route('newsdetails', [$blog->id, Str::slug($blog->title)])}}'" style="cursor: pointer">
                        <div class="blog_item_img">
                        <img
                            class="card-img rounded-0"
                            src="{{Storage::disk('uploads')->url($blog->image)}}"
                            alt=""
                        />
                        <a href="#" class="blog_item_date">
                            <p>{{date('F d, Y h:i a', strtotime($blog->date))}}</p>

                        </a>
                        </div>
                        <div class="blog_details">
                        <a class="d-inline-block" href="#">
                            <h2 class="blog-head" style="color: #2d2d2d">
                            {{$blog->title}}
                            </h2>
                        </a>
                        <p>
                            {{$blog->smalldesc}}
                        </p>
                        <ul class="blog-info-link">

                            <li>
                            <a href="#"><i class="fa fa-user"></i>
                                @php
                                    $tagname = '';
                                @endphp
                                @foreach ($blog->tag as $tagid)
                                    @php
                                        $tag = DB::table('blog_tags')->where('id', $tagid)->first();
                                        $tagname .= $tag->name . ' ';
                                    @endphp
                                @endforeach
                                {{$tagname}}
                            </a>
                            </li>
                            <li>
                            <a href="#"
                                ><i class="fa fa-comments"></i> 03 Comments</a
                            >
                            </li>
                        </ul>
                        </div>
                    </article>
                @endforeach

                <nav class="blog-pagination justify-content-center d-flex">
                  {{-- <ul class="pagination">
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
                  </ul> --}}
                  {{ $blogs->links() }}
                </nav>
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


    </div>
@endsection
@push('scripts')

@endpush
