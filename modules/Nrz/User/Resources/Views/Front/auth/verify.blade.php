@extends('User::Front.auth.master')


@section('content')
    <div class="account">
        <form action="{{route('verification.verify')}}" class="form" method="post">
            @csrf
            <a class="account-logo" href="/">
                <img src="/img/weblogo.png" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل <strong>{{request()->user()->email}}</strong>
                    را وارد کنید
                    <a href="{{route('users.profile')}}">ایمیل را اشتباه وارد کردید؟</a>
                </p>

            </div>
            <div class="form-content form-content1">
                <input required name="verify_code"
                       class="activation-code-input @error('verify_code') 'is-invalid ' @enderror "
                       placeholder="فعال سازی">
                @error('verify_code')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br>
                <button type="submit" class="btn i-t">تایید</button>

                <a onclick="event.preventDefault();document.getElementById('frm-send').submit()">ارسال مجدد کد فعالسازی</a>

            </div>
            <div class="form-footer">
                <a href="{{route('register')}}">صفحه ثبت نام</a>
            </div>
        </form>

        <form id="frm-send" method="post" action="{{route('verification.resend')}}">
            @csrf
        </form>
    </div>
@endsection

@section('js')
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>
@endsection
