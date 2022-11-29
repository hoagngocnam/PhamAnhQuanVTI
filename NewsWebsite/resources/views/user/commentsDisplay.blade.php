@foreach($comments as $key => $post_comment)
<div class="item" @if($post_comment->parent_id != null) style="margin-left:40px;" @endif>
    <div class="user">
        <figure>
            <img style="margin-top:15px ;" src="{{asset($post_comment->user->avatar)}}">
        </figure>
        <div class="details">

            <h5 class="name">{{$post_comment->user->first_name}}
                {{$post_comment->user->last_name}}
            </h5>

            <div class="time">{{$post_comment->created_at}}</div>
            <div class="description">
                {{$post_comment->comment}}
            </div>
            @if (Auth::check())
            <footer>
                <a href="#">Trả lời</a>
                <form method="post" action="{{ route('comment.store',$post_id) }}">
                    @csrf
                    <div class="form-group">
                        <input placeholder="Để lại bình luận của bạn ..." style="padding-right: 150px;" type="text"
                            name="message" class="form-control" id="message" />
                        <input type="hidden" name="{{$post_id}}" value="{{$post_id}}" id="post_id">
                        <input type="hidden" name="parent_id" value="{{ $post_comment->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="Trả lời" />
                    </div>
                    @endif
                </form>
                @include('user.commentsDisplay', ['comments' => $post_comment->replies])
            </footer>
        </div>
    </div>
</div>
<script>
window.addEventListener('load', function(e) {
    $(`#user`).submit(function(event) {
        event.preventDefault();
        var message = $("#message").val()
        var _token = $('input[name="_token"]').val();
        $.ajax({
            method: "POST",
            url: "{{route('comment.store', $post->id)}}",
            dataType: "json",
            data: {
                _token: _token,
                message: message
            },
            success: function(data, status, xhr) {
                $("#message").val("");
                // alert("Thêm bình luận thành công");
                $('.comment-list').append(
                    `gooo`
                );
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert("something went wrong");
            }
        });
    });
});
</script>

@endforeach