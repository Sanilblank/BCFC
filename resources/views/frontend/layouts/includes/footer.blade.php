<footer class="site-footer bg-blue">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="mb-5">
            <h3 class="footer-heading mb-4">About {{$setting->sitename}}</h3>
            <p>{!! $setting->aboutus !!}</p>
          </div>

          <div class="mb-5">
            <h3 class="footer-heading mb-4">Follow Us</h3>

            <div>
              <a href="{{$setting->facebook}}" target="_blank" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="{{$setting->twitter}}" target="_blank" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="{{$setting->instagram}}" target="_blank" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="{{$setting->linkedin}}" target="_blank" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>

          </div>

        </div>
        <div class="col-lg-4 mb-5 mb-lg-0">
          <div class="row mb-5">
            <div class="col-md-12">
              <h3 class="footer-heading mb-4">Quick Menu</h3>
            </div>
            <div class="col-md-6 col-lg-6">
              <ul class="list-unstyled">
                <li><a href="#">Home</a></li>
                <li><a href="#">Matches</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Team</a></li>
              </ul>
            </div>
            <div class="col-md-6 col-lg-6">
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Membership</a></li>
              </ul>
            </div>
          </div>


        </div>

        <div class="col-lg-4 mb-5 mb-lg-0">


          <div class="mb-5">
            <h3 class="footer-heading mb-2">Subscribe Newsletter</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit minima minus odio.</p>

            <form action="#" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-white bg-transparent"
                  placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button" id="button-addon2">Send</button>
                </div>
              </div>
            </form>

          </div>

        </div>

      </div>
      <div class="row pt-5 mt-5 text-center">
        <div class="col-md-12">
          <p>

            Copyright &copy;
            <script data-cfasync="false"
              src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script>document.write(new Date().getFullYear());</script> All rights reserved

          </p>
        </div>

      </div>
    </div>
  </footer>
