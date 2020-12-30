@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('permissions.index') }}" title="نقشهای کاربری">نقشهای کاربری</a></li>
    <li><a href="#" title="ویرایش نقش کاربری">ویرایش نقش کاربری</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
            <p class="box__title">بروزرسانی نقش کاربری</p>
            <form action="{{ route('permissions.update', $permission->id) }}" method="post" class="padding-30">
                @csrf
                @method('patch')
                <input type="hidden" name="id" value="{{ $permission->id }}">
                <input type="text" name="name" required placeholder="نام سطح دسترسی" class="text"
                       value="{{ $permission->name}}">
                <input type="text" name="label" required placeholder="توضیحات سطح دسترسی" class="text"
                       value="{{ $permission->label}}">
                @error("name")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <hr>

                <button class="btn btn-webamooz_net mt-2">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
