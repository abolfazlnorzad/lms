@component('mail::message')
# بازیابی رمز عبور

این کد به منظور بازیابی رمز عبور حساب کاربری شما ارسال شده است .

@component('mail::panel')
کد فعالسازی اکانت شما :  {{$code}}
@endcomponent

باتشکر,<br>
{{ config('app.name') }}
@endcomponent
