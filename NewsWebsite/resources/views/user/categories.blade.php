@extends('layouts.user')
@section('content')
<section class="category">
    <div class="container" style="margin-top:-200px ;">
        <div class="row">
            <div class="col-md-8 text-left">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-title">Danh mục: {{$categories->name}}</h1>
                    </div>
                </div>
                <div class="line"></div>
                <div class="row">
                    @foreach($categories->posts as $cat)
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{route('detail.post',$cat->slug)}}">
                                    <img src="{{asset($cat->photo)}}">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a
                                            href="{{route('detail.categories',$categories->slug)}}">{{$cat->categories->name}}</a>
                                    </div>
                                    <div class="time">{{$cat->post_time}}</div>
                                </div>
                                <h1><a href="{{route('detail.post',$cat->slug)}}">{{$cat->title}}</a></h1>
                                <p>
                                    {!! Str::limit($cat->content, 250)
                                    !!}
                                </p>
                                <footer>
                                    <a class="btn btn-primary more" href="{{route('detail.post',$cat->slug)}}">
                                        <div>Xem thêm</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 sidebar">
                <aside>
                    <div class="aside-body">
                        <figure class="ads">
                            <a href="single.html">
                                <img src="{{asset('uploads/thumbnail/ad.png')}}">
                            </a>
                            <figcaption>Advertisement</figcaption>
                        </figure>
                    </div>
                </aside>

            </div>
        </div>
    </div>
</section>


@endsection