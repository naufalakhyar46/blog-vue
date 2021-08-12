<?php 
  $konfig = App\Models\Konfigurasi::first();
?>
 <!-- ======= Footer ======= -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <div class="footer-logo">
                  <h2><span>{{substr($konfig->nama_portal,0,1)}}</span>{{substr($konfig->nama_portal,1)}}</h2>
                </div>

                <p>{{$konfig->deskripsi}}</p>
                <div class="footer-icons">
                  <ul>
                    @if(Request::session()->get('id'))
                        <li>
                          <a href="{{url('/panel/dashboard')}}" title="Dashboard"><i class="fa fa-globe"></i></a>
                        </li>
                    @else
                    <li>
                      <a href="{{url('/auth/login')}}" title="Login"><i class="fa fa-key"></i></a>
                    </li>
                    @endif
                    <li>
                      <a href="{{$konfig->fb}}" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                      <a href="{{$konfig->tw}}" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                      <a href="{{$konfig->ig}}" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <h4>information</h4>
                <p>
                  {{$konfig->alamat}}
                </p>
                <div class="footer-contacts">
                  <p><span>Telepon :</span> {{$konfig->nohp}}</p>
                  <p><span>Email :</span> {{$konfig->email}}</p>
                  <p><span>Buka :</span> Sening-Jumat (08:00-16:00)</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
          <?php 
          $informasi = App\Models\Blog::limit(4)->orderBy('created_at','desc')->get();
          ?>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <h4>Informasi</h4>
                <div>
                  @foreach($informasi as $i)
                  <li style="list-style-type: none;font-size: 16px">> <a href="{{url('/portal/blog/detail-blog',$i->slug)}}">{{$i->title}}</a></li>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright {{date('Y')}} <strong>{{$konfig->nama_portal}}</strong>. All Rights Reserved
              </p>
            </div>
            <div class="credits">
              <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eBusiness
            -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('portal') }}/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/appear/jquery.appear.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/knob/jquery.knob.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/parallax/parallax.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/wow/wow.min.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{ asset('portal') }}/assets/vendor/venobox/venobox.min.js"></script>
  <script src="{{ asset('portal') }}/assets/slick/slick.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('portal') }}/assets/js/main.js"></script>
<script type="text/javascript">
  $('.product-slider').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
 
</script>
</body>

</html>