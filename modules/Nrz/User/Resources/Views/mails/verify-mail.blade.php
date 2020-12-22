@component('mail::message')
# کد فعالسازی

این کد به منظور فعالسازی حساب کاربری شما ارسال شده است

@component('mail::panel')
کد فعالسازی اکانت شما :  {{$code}}
@endcomponent

باتشکر,<br>
{{ config('app.name') }}
@endcomponent
