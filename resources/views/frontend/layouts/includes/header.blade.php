<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-logo">
        <a href="{{route('index')}}"><img src="{{Storage::disk('uploads')->url($setting->headerImage)}}" alt="Image" style="max-height:120px;"></a>
      </div>
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <header class="site-navbar absolute transparent" role="banner">
    <div class="pb-3 ">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-md-3">
            <a href="{{$setting->facebook}}" target="_blank" class="text-secondary px-2 pl-0"><span class="icon-facebook"></span></a>
            <a href="{{$setting->instagram}}" target="_blank" class="text-secondary px-2"><span class="icon-instagram"></span></a>
            <a href="{{$setting->twitter}}" target="_blank" class="text-secondary px-2"><span class="icon-twitter"></span></a>
            <a href="{{$setting->linkedin}}" target="_blank" class="text-secondary px-2"><span class="icon-linkedin"></span></a>
          </div>
          <div class="col-6 col-md-9 text-right">
            <div class="d-inline-block"><a href="#" class="text-secondary p-2 d-flex align-items-center"><span
                  class="icon-envelope mr-3"></span> <span class="d-none d-md-block">{{$setting->email}}</span></a>
            </div>
            <div class="d-inline-block"><a href="#" class="text-secondary p-2 d-flex align-items-center"><span
                  class="icon-phone mr-0 mr-md-3"></span> <span class="d-none d-md-block">{{$setting->phone}}</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="site-navigation position-relative text-right text-md-right" role="navigation">
      <div class="container position-relative">
        <div class="site-logo">
          <a href="index.html"><img src="{{asset('frontend/images/logo.png')}}" alt="" style="max-height: 120px;"></a>
        </div>

        <div class="d-inline-block d-md-none ml-md-0 mr-auto py-3"><a href="#"
            class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

        <ul class="site-menu js-clone-nav d-none d-md-block">
          <li class="has-children active">
            <a href="index.html">Home</a>
            <ul class="dropdown arrow-top">
              <li><a href="#">Menu One</a></li>
              <li><a href="#">Menu Two</a></li>
              <li><a href="#">Menu Three</a></li>
              <li class="has-children">
                <a href="#">Sub Menu</a>
                <ul class="dropdown">
                  <li><a href="#">Menu One</a></li>
                  <li><a href="#">Menu Two</a></li>
                  <li><a href="#">Menu Three</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="has-children">
            <a href="news.html">News</a>
            <ul class="dropdown arrow-top">
              <li><a href="#">Menu One</a></li>
              <li><a href="#">Menu Two</a></li>
              <li><a href="#">Menu Three</a></li>
            </ul>
          </li>
          <li><a href="matches.html">Matches</a></li>
          <li><a href="team.html">Team</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
    </nav>
  </header>
  @if (session('success'))
        <div class="row">
            <div class="col-sm-4 ml-auto message scroll">
                <div class="alert  alert-success alert-dismissible fade show" role="alert" style="background: seagreen; color: white;">
                {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session('failure'))
        <div class="row">
            <div class="col-sm-4 ml-auto message scroll">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert" style="background: rgb(134, 7, 7); color: white;">
                {{ session('failure') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

