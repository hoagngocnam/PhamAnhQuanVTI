<style>
.replyform1 {
    display: none;
}
</style>

@foreach($comments as $key => $post_comment)
<div class="item">
    <div class="user" id="user">
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
                <button onclick='myFunction("{{ $post_comment->id }}")'>Trả lời</button>
                <form id="replyForm-{{ $post_comment->id }}" class="replyform1" method="post"
                    action="{{ route('comment.store',$post_id) }}">
                    @csrf
                    <div class="form-group">
                        <input placeholder="Để lại bình luận của bạn ..." style="padding-right: 150px;" type="text"
                            name="message" class="form-control" id="message" />
                        <input type="hidden" name="{{$post_id}}" value="{{$post_id}}" id="post_id">
                        <input type="hidden" name="parent_id" value="{{ $post_comment->id }}" />
                    </div>
                    <button class="btn btn-primary">Trả lời </button>
                    @endif
                </form>
                @include('user.commentsDisplay', ['comments' => $post_comment->replies])
            </footer>
        </div>
    </div>
</div>
@endforeach
<script>
function myFunction(id) {
    var element = document.getElementById("replyForm-" + id);
    element.classList.remove("replyform1");
}
</script>
<script>
window.addEventListener('load', function(e) {
    $(`#replyform1`).submit(function(event) {
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
                $("#comment").val("");
                alert("Thêm bình luận thành công");
                $('.details').append(
                    `123`
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