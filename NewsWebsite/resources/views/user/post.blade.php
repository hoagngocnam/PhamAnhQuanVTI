@extends('layouts.user')
@section('content')

<section class="single">
    <div class="container" style="margin-top:-200px ;">
        <div class="row">
            <div class="col-md-4 sidebar" id="sidebar">
                <aside>
                    <div class="aside-body">
                        <figure class="ads">
                            <img src="{{asset('uploads/thumbnail/ad.png')}}">
                            <figcaption>Advertisement</figcaption>
                        </figure>
                    </div>
                </aside>
                <aside>
                    <h1 class="aside-title">Bài viết liên quan</h1>
                    <div class="aside-body">
                        @foreach($same_posts as $key => $same_post)
                        @if($key < 5 ) <article class="article-fw">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('detail.post',$same_post->slug)}}">
                                        <img src="{{asset($same_post->photo)}}">
                                    </a>
                                </figure>
                                <div class="details">
                                    <h1><a href="{{route('detail.post',$same_post->slug)}}">{{$same_post->title}}</a>
                                    </h1>
                                    <p>
                                        {!! Str::limit($same_post->content, 80) !!}
                                    </p>
                                    <div class="detail">
                                        <div class="time">{{$same_post->post_time}}</div>
                                        <div class="category"><a
                                                href="{{route('detail.categories',$same_post->categories->slug)}}">{{$same_post->categories->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </article>
                            @endif
                            @endforeach
                    </div>
                </aside>
            </div>
            <div class="col-md-8">
                <article class="article main-article">
                    <header>
                        <h1>{{$post->title}}</h1>
                        <ul class="details">
                            <li>{{$post->post_time}}</li>
                            <li><a>{{$post->categories->name}}</a></li>
                            <li>By <a href="#">{{$post->user->first_name}} {{$post->user->last_name}}</a></li>
                        </ul>
                    </header>
                    <div class="main">
                        {!!$post->content!!}
                    </div>
                    <footer>
                        <div class="col" style="margin-left:450px ;">
                            <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                <div>1220</div>
                            </a>
                        </div>
                    </footer>
                </article>
                <div class="sharing">
                    <div class="title"><i class="ion-android-share-alt"></i> Sharing is caring</div>
                    <ul class="social">
                        <li>
                            <a href="#" class="facebook">
                                <i class="ion-social-facebook"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="#" class="twitter">
                                <i class="ion-social-twitter"></i> Twitter
                            </a>
                        </li>
                        <li>
                            <a href="#" class="googleplus">
                                <i class="ion-social-googleplus"></i> Google+
                            </a>
                        </li>
                        <li>
                            <a href="#" class="linkedin">
                                <i class="ion-social-linkedin"></i> Linkedin
                            </a>
                        </li>
                        <li>
                            <a href="#" class="skype">
                                <i class="ion-ios-email-outline"></i> Email
                            </a>
                        </li>
                        <li class="count">
                            20
                            <div>Shares</div>
                        </li>
                    </ul>
                </div>
                <div class="line thin"></div>
                <div class="comments">
                    <h2 class="title">Bình luận </h2>
                    <div class="comment-list">
                        @include('user.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                    </div>
                    @if (Auth::check())
                    <form method="post" action="{{ route('comment.add',$post->id) }}" enctype="multipart/form-data"
                        class="comment row" id="comment">
                        @csrf
                        <div class="form-group col-md-12">
                            <input type="hidden" name="{{$post->id}}" value="{{$post->id}}" id="{{$post->id}}">
                            <div class="form-group row">
                                <div>
                                    <input maxlength="50" disabled id="name" type="text" name="name"
                                        value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}">
                                </div>
                                <textarea class="form-control" name="message" id="comment-message"
                                    placeholder="Để lại bình luận của bạn ..."></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-primary">Gửi Bình luận</button>
                            </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@if (Auth::check())
<script>
window.addEventListener('load', function(e) {
    $(`#comment`).submit(function(event) {
        event.preventDefault();
        var message = $("#comment-message").val()
        var _token = $('input[name="_token"]').val();
        $.ajax({
            method: "POST",
            url: "{{route('comment.add', $post->id)}}",
            dataType: "json",
            data: {
                _token: _token,
                message: message
            },
            success: function(data, status, xhr) {
                $("#comment-message").val("");
                // alert("Thêm bình luận thành công");
                $('.comment-list').append(
                    `<li class="comment" style="list-style:none">
                <div class="item">
                            <div class="user">
                            <figure>
                            <img style="margin-top:15px ;" src="{{asset(Auth::user()->avatar)}}">
                                </figure>
                                <div class="details">
                                    <h5 class="name">${data.user.first_name} ${data.user.last_name}</h5>
                                    <div class="time">Vừa xong</div>
                                    <div class="description">
                                    ${data.comment}
                                    </div>
                                    <footer>
                                        <a href="#">Reply</a>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </li>`
                );
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert("Hãy nhập bình luận của bạn !");
            }
        });
    });
});
</script>

@endif
@endsection