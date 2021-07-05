<div id="Modal2" class="modal">
    <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
            <p>ارسال پاسخ</p>
            <div class="close">×</div>
        </div>
        <div class="modal-body">
            <form action='{{route("comments.store")}}' method="post">
                @csrf
                <input type="hidden" name="parent_id" value="" id="parent_id">
                <input type="hidden" name="commentable_type" value="{{get_class($commentable)}}">
                <input type="hidden" name="commentable_id" value="{{$commentable->id}}">
                <x-text-area placeholder="دیدگاه شما" name="body" class="txt ct-textarea-field" />
                <button class="btn i-t">ثبت پاسخ</button>
            </form>
        </div>

    </div>
</div>
