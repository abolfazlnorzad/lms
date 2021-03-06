<p class="box__title">ایجاد نقش کاربری جدید</p>
<form action="{{ route('roles.store') }}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" required placeholder="عنوان" class="text" value="{{ old('name') }}">
    <input type="text" name="label" required placeholder="توضیحات" class="text" value="{{ old('name') }}">
    @error("name")
    <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror

    <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
    @foreach($permissions as $permission)
        <label class="ui-checkbox pt-1 pr-3">
            <input type="checkbox" name="permissions[{{ $permission->name }}]" class="sub-checkbox" data-id="2"
                   value="{{ $permission->id }}"

                   @if(is_array(old('permissions')) && array_key_exists($permission->name, old('permissions'))) checked @endif
            >
            <span class="checkmark"></span>
            @lang($permission->name)
        </label>
    @endforeach

    @error("permissions")
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <hr>
    <button class="btn btn-webamooz_net mt-2">اضافه کردن</button>
</form>
