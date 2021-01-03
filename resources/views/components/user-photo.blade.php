<form method="post" action="{{route('users.photo')}}" enctype="multipart/form-data">
    @csrf
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{auth()->user()->image ? auth()->user()->image->thumb :'/img/avatar.jpg'}}" class="avatar___img">
            <input onchange="this.form.submit()" name="userPhoto" type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر :  {{auth()->user()->name}}</span>
    </div>
</form>
