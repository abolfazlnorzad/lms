@extends('User::Front.auth.master')

@section('content')

    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <a class="account-logo" href="{{url('/')}}">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" name="name" class="txt @error('name') is-invalid @enderror "
                   placeholder="نام و نام خانوادگی" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="email" name="email" class="txt txt-l @error('email') is-invalid @enderror" placeholder="ایمیل" value="{{ old('email') }}" required
                   autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="text" name="phone" class="txt txt-l @error('phone') is-invalid @enderror" placeholder="شماره موبایل" value="{{ old('phone') }}"
                   required autocomplete="phone">
            @error('phone')
            <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="password" name="password" class="txt txt-l @error('password') is-invalid @enderror" placeholder="رمز عبور" required
                   autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="password" name="password_confirmation" class="txt txt-l  @error('password') is-invalid @enderror" placeholder="رمز عبور" required>


            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            <br>
            <button type="submit" class="btn continue-btn">ثبت نام و ادامه</button>
        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>

@endsection
