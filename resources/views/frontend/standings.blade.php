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
                  <h2>Standings</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Hero End -->
      <!--? Blog Area Start-->
      <section class="blog_area bg-blue">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="widget-next-match">
                <div class="col-12 title-section d-flex justify-content-between">
                    <h2 class="heading">{{$matchtype->name}}</h2>
                  <div>
                    <!-- <i class="fa fa-calendar" aria-hidden="true"></i> -->
                    <form action="{{route('viewStandings')}}" method="GET">
                        <select name="matchtype_id" id="matchtype_id" class="btn btn-primary">
                            @foreach ($matchtypes as $item)
                                <option value="{{$item->id}}" {{$matchtype->id == $item->id?'selected':''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" id="submit" style="display: none">
                    </form>
                  </div>
                </div>
                @if (count($standings) > 0)
                <table class="table custom-table">
                    <thead>
                      <tr>
                        <th>Pos</th>
                        <th>Team</th>
                        <th>P</th>
                        <th>W</th>
                        <th>D</th>
                        <th>L</th>
                        <th>GF</th>
                        <th>GA</th>
                        <th>GD</th>
                        <th>PTS</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($standings as $standing)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td><strong class="text-white">{{$standing->team->name}}</strong></td>
                          <td>{{$standing->played}}</td>
                          <td>{{$standing->win}}</td>
                          <td>{{$standing->draw}}</td>
                          <td>{{$standing->loss}}</td>
                          <td>{{$standing->goalsscored}}</td>
                          <td>{{$standing->goalsagainst}}</td>
                          <td>{{$standing->goaldifferential}}</td>
                          <td>{{$standing->points}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                  </table>
                @else
                  <p>No Data Available as of now.</p>
                @endif

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
              <div class="item">
                <!-- uses .block-12 -->
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_1.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_2.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_3.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_4.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <!-- uses .block-12 -->
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_1.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_2.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_3.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_4.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <!-- uses .block-12 -->
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_1.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_2.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_3.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_4.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <!-- uses .block-12 -->
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_1.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_2.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_3.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="block-12">
                  <figure>
                    <img src="{{asset('frontend/images/img_4.jpg')}}" alt="Image" class="img-fluid" />
                  </figure>
                  <div class="text">
                    <span class="meta">May 20th 2018</span>
                    <div class="text-inner">
                      <h2 class="heading mb-3">
                        <a href="#" class="text-black"
                          >Nepal Cup Championship</a
                        >
                      </h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ad culpa, consectetur! Eligendi illo, repellat
                        repudiandae cumque fugiat optio!
                      </p>
                    </div>
                  </div>
                </div>
              </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#matchtype_id').on('change', function() {
            var $form = $(this).closest('form');
            $form.find('input[type=submit]').click();
        });
    });
</script>
@endpush
