@extends('layouts.portal.blueprint')

@section('content')
<?php 
  $konfig = App\Models\Konfigurasi::first();
?>
 <!-- ======= Blog Header ======= -->
    <div class="header-bg page-area" style="background: url({{url('image/default/test2.jpg')}});background-position: center;
    background-size: cover;">
      <div class="home-overly"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="slider-content text-center">
              <div class="header-bottom">
                <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                  <h1 class="title2">{{ucwords($data->title)}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Blog Header -->

    <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="page-head-blog">
              <div class="single-blog-page">
                <!-- search option start -->
                
                <!-- search option end -->
              </div>

              <div class="single-blog-page">
                <!-- recent start -->
                <div class="left-blog">
                  <h4>Blog Terbaru</h4>
                  <div class="recent-post">
                  	@foreach($blog_baru as $i)
                    <!-- start single post -->
                    <div class="recent-single-post">
                      <div class="post-img">
	                    <a href="{{url('/blog/detail-blog',$i->slug)}}">
	                      @if($i->image)
                          <img src="{{url('image/blog',$i->image)}}" alt="">
                        @else
                          <img src="{{url('image/default/test.jpg')}}" alt="" >
                        @endif
	                    </a>
                      </div>
                      <div class="pst-content">
                        <p><a href="{{url('/blog/detail-blog',$i->slug)}}"> {{$i->title}}</a></p>
                      </div>
                    </div>
                    <!-- End single post -->
                  	@endforeach
                    
                  </div>
                </div>
                <!-- recent end -->
              </div>

            </div>
          </div>
          <!-- End left sidebar -->
          <!-- Start single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- single-blog start -->
                <article class="blog-post-wrapper">
                  <div class="post-thumbnail">
                    @if($data->image)
                        <img src="{{url('image/blog',$i->image)}}" alt="">
                      @else
                        <img src="{{url('image/default/test.jpg')}}" alt="" >
                      @endif
                  </div>
                  <div class="post-information">
                    <h2>{{$data->title}}</h2>
                    <div class="entry-meta">
                      <span class="author-meta"><i class="fa fa-user"></i> {{ucwords($data->user->first_name)}} {{ucwords($data->user->last_name)}}</span>
                      <span><i class="fa fa-clock-o"></i> {{$i->created_at->diffForHumans()}}</span>
                      <span><i class="fa fa-eye"></i> {{$data->view}} views</span>
                      <span class="tag-meta">
                      	<i class="fa fa-folder-o"></i>
		                    Blog
                      </span>
                    </div>
                    <div class="entry-content">
                      {!! $data->deskripsi !!}
                    </div>
                  </div>
                </article>
                <div class="clear"></div>
                
                <!-- single-blog end -->
	         </div>
         </div>
           
            </div>
            </div>
      </div>
    </div><!-- End Blog Page -->
@endsection