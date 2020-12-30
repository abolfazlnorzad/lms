<p class="box__title">ایجاد سطح دسترسی جدید جدید</p>
<form action="{{ route('permissions.store') }}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" required placeholder="عنوان" class="text" value="{{ old('name') }}">
    <input type="text" name="label" required placeholder="توضیحات" class="text" value="{{ old('label') }}">
    @error("name")
    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
    </span>
    @enderror
    <hr>
    <button class="btn btn-webamooz_net mt-2">اضافه کردن</button>
</form>
