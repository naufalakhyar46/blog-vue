@extends('layouts.portal.blueprint')

@section('content')
<?php 
  $konfig = App\Models\Konfigurasi::first();
?>
 <!-- ======= Blog Header ======= -->
    <div class="header-bg page-area" style="background: url({{url('image/default/test3.jpg')}});background-position: center;
    background-size: cover;">
      <div class="home-overly"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="slider-content text-center">
              <div class="header-bottom">
                <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                  <h1 class="title2">{{$title}}</h1>
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
	          @foreach($data as $i)
              <div class="col-md-12 col-sm-12 col-xs-12">
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
                      <i class="fa fa-calendar"></i>{{$i->created_at->diffForHumans()}}
                    </span>
                    <span class="tag-meta">
                        <i class="fa fa-folder-o"></i>
                          Blog
                      </span>
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href="{{url('/blog/detail-blog',$i->slug)}}">{{$i->title}}</a>
                    </h4>
                    <p>
                      {!! Str::limit($i->deskripsi, 170) !!}
                    </p>
                  </div>
                  <span>
                      <a href="{{url('/blog/detail-blog',$i->slug)}}" class="ready-btn">Selengkapnya</a>
                  </span>
                </div>
              </div>
              <!-- End single blog -->
             @endforeach
	         </div>
         </div>
              <!-- Pagination Start -->
                        <?php 
                            $link_limit = $data->total()+2;
                        ?>
                        @if ($data->hasPages())
                        <div class="col-md-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    @if ($data->onFirstPage())
                                        <!-- <li class="page-item disabled"><a href="#" class="page-link">Previous</a></li> -->
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}" tabindex="-1">Previous</a></li>
                                    @endif
                                    @for ($i = 1; $i <= $data->lastPage(); $i++)
                                        <?php
                                        $half_total_links = floor($link_limit / 2);
                                        $from = $data->currentPage() - $half_total_links;
                                        $to = $data->currentPage() + $half_total_links;
                                        if ($data->currentPage() < $half_total_links) {
                                           $to += $half_total_links - $data->currentPage();
                                        }
                                        if ($data->lastPage() - $data->currentPage() < $half_total_links) {
                                            $from -= $half_total_links - ($data->lastPage() - $data->currentPage()) - 1;
                                        }
                                        ?>
                                        @if ($from < $i && $i < $to)
                                            <li class="{{ ($data->currentPage() == $i) ? 'page-item active' : 'page-item' }}">
                                                <a class="page-link" href="{{ ($data->currentPage() == $i) ? 'javascript:void(0)' : $data->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor
                                    @if ($data->hasMorePages())
                                        <li class="page-item"><a href="{{ $data->nextPageUrl() }}" class="page-link" rel="next">Next</a></li>
                                    @else
                                        <!-- <li class="page-item disabled"><a href="#" class="page-link">Next</a></li> -->
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        @endif
                        <!-- Pagination Start -->
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Blog Page -->
@endsection