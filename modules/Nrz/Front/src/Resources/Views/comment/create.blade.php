@auth
    <div class="comment-main">
        <div class="ct-header">
            <h3>نظرات ( 180 )</h3>
            <p>نظر خود را در مورد این مقاله مطرح کنید</p>
        </div>
        <form action='{{route("comments.store")}}' method="post">
            @csrf
            <input type="hidden" name="commentable_type" value="{{get_class($course)}}">
            <input type="hidden" name="commentable_id" value="{{$course->id}}">
            <div class="ct-row">
                <div class="ct-textarea">
                    <x-text-area placeholder="دیدگاه شما" name="body" class="txt ct-textarea-field"/>
                </div>
            </div>
            <div class="ct-row">
                <div class="send-comment">
                    <button type="submit" class="btn i-t">ثبت نظر</button>
                </div>
            </div>

        </form>
    </div>
@endauth
@guest
    <div  class="alert-warning alert">
        برای ثبت دیدگاه ابندا وارد سایت شوید
    </div>
@endauth
