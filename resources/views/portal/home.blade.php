@extends('layouts.portal.blueprint')

@section('content')
  <!-- ======= Slider Section ======= -->
  <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        @foreach($blog as $i)
          @if($i->image)
          <img src="{{url('image/blog',$i->image)}}" style="max-height:700px !important;" alt="" title="#slider-direction-{{$i->id}}" />
          @else
          <img src="{{url('image/default/test.jpg')}}" style="max-height:700px !important;" alt="" title="#slider-direction-{{$i->id}}" />
          @endif
        @endforeach
      </div>

      <!-- direction 1 -->
        @foreach($blog as $i)
          <div id="slider-direction-{{$i->id}}" class="slider-direction slider-one">
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="slider-content">
                    <!-- layer 1 -->
                    <div class="layer-1-1 hidden-xs wow animate__slideInDown animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                      <h2 class="title1">{{$i->title}} </h2>
                    </div>
                    <!-- layer 2 -->
                    <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                      <h1 class="title2">{{ Str::limit($i->deskripsi, 40) }}</h1>
                    </div>
                    <!-- layer 3 -->
                    <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                      <a class="ready-btn right-btn page-scroll" href="{{url('/blog/detail-blog',$i->slug)}}">Lihat selengkapnya</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach

    </div>
  </div><!-- End Slider -->

  <main id="main">

        <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="blog-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Blog</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start Left Blog -->
            @foreach($blog as $i)
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                    @if($i->image)
                      <img src="{{url('image/blog',$i->image)}}" alt="">
                    @else
                      <img src="{{url('image/default/test.jpg')}}" alt="" >
                    @endif
                </div>
                <div class="blog-meta">
                  <span class="date-type">
                    <i class="fa fa-calendar"></i>{{$i->created_at->isoFormat('DD MMMM YYYY')}}
                  </span>
                </div>
                <div class="blog-text">
                  <h4>
                    <a href="{{url('/blog/detail-blog',$i->slug)}}">{{$i->title}}</a>
                  </h4>
                  <p>
                    {!! Str::limit($i->deskripsi, 60) !!}
                  </p>
                </div>
                <span>
                  <a href="{{url('/blog/detail-blog',$i->slug)}}" class="ready-btn">Selengkapnya</a>
                </span>
              </div>
              <!-- Start single blog -->
            </div>
            <!-- End Left Blog-->
            @endforeach
          </div>
        </div>
            <div style="text-align: center;">
              <span>
                  <a href="{{url('/blog')}}" class="blog-btn">Lihat lebih banyak..</a>
                </span>
            </div>
      </div>
    </div><!-- End Blog Section -->

    <!-- ======= About Section ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Tentang Kami</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single-well start-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-left">
              <div class="single-well">
                @if($konfigurasi->icon)
                <a href="{{url('image/konfigurasi',$konfigurasi->icon)}}" target="_blank">
                  <img src="{{url('image/konfigurasi',$konfigurasi->icon)}}" alt="">
                </a>
                @else
                <a href="{{url('image/default/images.png')}}" target="_blank">
                  <img src="{{url('image/default/images.png')}}" alt="">
                </a>
                @endif
              </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-middle">
              <div class="single-well">
                <p style="font-size:20px;text-align: justify">
                  {!! $konfigurasi->deskripsi !!}
                </p>
                
              </div>
            </div>
          </div>
          <!-- End col-->
        </div>
      </div>
    </div><!-- End About Section -->
<style>
.our-team-area .slick-prev,
.our-team-area .slick-next {
    top: -75px;
    width: 30px;
    height: 30px;
    z-index: 1;
    transition: .5s;
    color: #fff;
    background: #007bff;
    border: 1px solid ;
    border-radius: 4px;
}

.our-team-area .slick-prev {
    left: calc(100% - 120px);
}

.our-team-area .slick-next {
    right: 45px;
}

.our-team-area .slick-prev:hover,
.our-team-area .slick-prev:focus,
.our-team-area .slick-next:hover,
.our-team-area .slick-next:focus {
    background: #3EC1D5;
}

.our-team-area .slick-prev::before,
.our-team-area .slick-next::before {
    font-family: "FontAwesome";
    font-size: 18px;
    font-weight: 900;
    color: #fff;
}

.our-team-area .slick-prev::before {
    content: "\f104";
}

.our-team-area .slick-next::before {
    content: "\f105";
}

.our-team-area .slick-prev:hover::before,
.our-team-area .slick-prev:focus::before,
.our-team-area .slick-next:hover::before,
.our-team-area .slick-next:focus::before {
    color: #ffffff;
}
</style>

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Kontak</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-mobile"></i>
                  <p>
                    Telepon: {{$konfigurasi->nohp}}<br>
                    <span>Senin-Jumat (08:00-16:00)</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-envelope-o"></i>
                  <p>
                    Email: {{$konfigurasi->email}}<br>
                    <span>Web: {{$konfigurasi->website}}</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-map-marker"></i>
                  <p>
                    Alamat: {{$konfigurasi->alamat}}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- Start Google Map -->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <!-- Start Map -->
                {!!$konfigurasi->map!!}
              <!-- End Map -->
            </div>
            <!-- End Google Map -->
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->

@endsection
 