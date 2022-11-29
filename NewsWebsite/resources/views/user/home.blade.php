@extends('layouts.user')
@section('content')
<section class="home">
    <div class="container" style="margin-top:-200px ;">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="owl-carousel owl-theme slide" id="featured">
                    @foreach($posts as $post)
                    <div class="item">
                        <article class="featured">
                            <div class="overlay"></div>
                            <figure>
                                <img src="{{asset($post->photo)}}" alt="Sample Article">
                            </figure>
                            <div class="details">
                                <div class="category"><a href="category.html">{{ $post->categories->name }}</a></div>
                                <h1><a
                                        href="{{route('detail.post',$post->slug)}}">{{ Str::limit($post->title, 100) }}</a>
                                </h1>
                                <div class="time">{{ $post->post_time }}</div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="line">
                    <div>Bài viết mới nhất</div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            @foreach($posts_latest2 as $key => $post_latest2 )
                            @if($key < 2) <article class="article col-md-12">
                                <div class="inner">
                                    <figure>
                                        <a href="{{route('detail.post',$post_latest2->slug)}}">
                                            <img src="{{asset($post_latest2->photo)}}" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <div class="detail">
                                            <div class="time">{{$post_latest2->post_time}}</div>
                                            <div class="category"><a
                                                    href="category.html">{{$post_latest2->categories->name}}</a></div>
                                        </div>
                                        <h2><a
                                                href="{{route('detail.post',$post_latest2->slug)}}">{{$post_latest2->title}}</a>
                                        </h2>
                                        <p>{!! Str::limit($post_latest2->content, 80) !!}
                                        </p>
                                        <footer>
                                            <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                                <div>1263</div>
                                            </a>
                                            <a class="btn btn-primary more"
                                                href="{{route('detail.post',$post_latest2->slug)}}">
                                                <div>Xem thêm</div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>
                                    </div>
                                </div>
                                </article>
                                @endif
                                @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            @foreach($posts_latest1 as $key => $post_latest1 )
                            @if($key < 2) <article class="article col-md-12">
                                <div class="inner">
                                    <figure>
                                        <a href="{{route('detail.post',$post_latest1->slug)}}">
                                            <img src="{{asset($post_latest1->photo)}}" alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <div class="detail">
                                            <div class="time">{{$post_latest1->post_time}}</div>
                                            <div class="category"><a
                                                    href="category.html">{{$post_latest1->categories->name}}</a></div>
                                        </div>
                                        <h2><a
                                                href="{{route('detail.post',$post_latest1->slug)}}">{{$post_latest1->title}}</a>
                                        </h2>
                                        <p>{!! Str::limit($post_latest1->content, 80) !!}
                                        </p>
                                        <footer>
                                            <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                                <div>1263</div>
                                            </a>
                                            <a class="btn btn-primary more"
                                                href="{{route('detail.post',$post_latest1->slug)}}">
                                                <div>Xem thêm</div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>
                                    </div>
                                </div>
                                </article>
                                @endif
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="banner">
                    <a href="#">
                        <img src="{{asset('uploads/thumbnail/ads.png')}}" alt="Sample Article">
                    </a>
                </div>
                <div class="line transparent little"></div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 trending-tags">
                        <h1 class="title-col">Trending</h1>
                        <div class="body-col">
                            <ol class="tags-list">
                                @foreach($categories as $key => $cat)
                                @if($key < 10) <li><a href="#"> {{$cat->name}}</a></li>
                                    @endif
                                    @endforeach
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <h1 class="title-col">
                            Tin nóng
                            <div class="carousel-nav" id="hot-news-nav">
                                <div class="prev">
                                    <i class="ion-ios-arrow-left"></i>
                                </div>
                                <div class="next">
                                    <i class="ion-ios-arrow-right"></i>
                                </div>
                            </div>
                        </h1>
                        <div class="body-col vertical-slider" data-max="4" data-nav="#hot-news-nav" data-item="article">
                            @foreach($posts_hot as $post_hot)
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="{{route('detail.post',$post_hot->slug)}}">
                                            <img src="{{asset($post_hot->photo)}}" alt=" Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="{{route('detail.post',$post_hot->slug)}}">{{$post_hot->title}}</a>
                                        </h1>
                                        <div class="detail">
                                            <div class="category"><a
                                                    href="category.html">{{$post_hot->categories->name}}</a></div>
                                            <div class="time">{{$post_hot->post_time}}</div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4 sidebar" id="sidebar">
                <div class="sidebar-title for-tablet">Sidebar</div>
                <aside>
                    <h1 class="aside-title">Phổ biến
                    </h1>
                    <div class="aside-body">
                        @foreach($posts_popular as $post_popular)
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('detail.post',$post_popular->slug)}}">
                                        <img src="{{asset($post_popular->photo)}}" alt="Sample Article">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a
                                            href="{{route('detail.post',$post_popular->slug)}}">{{$post_popular->title}}</a>
                                    </h1>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<section class="best-of-the-week">
    <div class="container">
        <h1>
            <div class="text">Xem nhiều nhất tuần qua</div>
            <div class="carousel-nav" id="best-of-the-week-nav">
                <div class="prev">
                    <i class="ion-ios-arrow-left"></i>
                </div>
                <div class="next">
                    <i class="ion-ios-arrow-right"></i>
                </div>
            </div>
        </h1>
        <div class="owl-carousel owl-theme carousel-1">
            @foreach($posts_best as $post_best)
            <article class="article">
                <div class="inner">
                    <figure>
                        <a href="{{route('detail.post',$post_best->slug)}}">
                            <img src="{{asset($post_best->photo)}}" alt="Sample Article">
                        </a>
                    </figure>
                    <div class="padding">
                        <div class="detail">
                            <div class="time">{{$post_best->post_time}}</div>
                            <div class="category"><a
                                    href="{{route('detail.categories',$post_best->categories->slug)}}">{{$post_best->categories->name}}</a>
                            </div>
                        </div>
                        <h2><a href="{{route('detail.post',$post_best->slug)}}">{!! Str::limit($post_best->title, 50)
                                !!}</a></h2>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>



@endsection