@extends('User::Front.auth.master')

@section('content')

    <form action="{{ route('login')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="{{url('/')}}">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" name="email" class="txt-l txt @error('email') is-invalid @enderror"
                   placeholder="ایمیل یا شماره موبایل" value="{{ old('email') }}" required autocomplete="email"
                   autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <input type="password" name="password" class="txt-l txt @error('password') is-invalid @enderror"
                   placeholder="رمز عبور" required autocomplete="current-password">

            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input name="remember" type="checkbox" checked="checked">
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="{{route('password.request')}}">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{route('register')}}">صفحه ثبت نام</a>
        </div>
    </form>

@endsection
