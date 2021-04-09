@extends('Front::layout.master')

@section('content')
    <main id="single">
        <div class="content">

            <div class="container">
                <article class="article">
                    <div class="ads mb-10">
                        <a href="" rel="nofollow noopener"><img src="img/ads/1440px/test.jpg" alt=""></a>
                    </div>
                    <div class="h-t">
                        <h1 class="title">
                            {{$course->title}}
                        </h1>
                        <div class="breadcrumb">
                            <ul>
                                <li><a href="/" title="خانه">خانه</a></li>
                                @if($course->category->parentCategory)
                                    <li><a href="{{ $course->category->parentCategory->path() }}"
                                           title="{{ $course->category->parentCategory->title }}">
                                            {{ $course->category->parentCategory->title }}</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ $course->category->path() }}"
                                       title="{{ $course->category->title }}">{{ $course->category->title }}</a></li>
                            </ul>
                        </div>
                    </div>

                </article>
            </div>


            <div class="main-row container">
                <div class="sidebar-right">
                    <div class="sidebar-sticky">
                        <div class="product-info-box">
                            @if($course->getDiscountPercent())
                                <div class="discountBadge">
                                    <p>{{$course->getDiscountPercent()}}%</p>
                                    تخفیف
                                </div>
                            @endif
                            {{--                            <div class="sell_course">--}}
                            {{--                                <strong>قیمت :</strong>--}}
                            {{--                                <del class="discount-Price">{{$course->getFormattedPrice()}}</del>--}}
                            {{--                                <p class="price">--}}
                            {{--                        <span class="woocommerce-Price-amount amount">{{$course->getFormattedPrice()}}--}}
                            {{--                            <span class="woocommerce-Price-currencySymbol">تومان</span>--}}
                            {{--                        </span>--}}
                            {{--                                </p>--}}
                            {{--                            </div>--}}
                            @auth
                                @if(auth()->id() == $course->teacher_id)
                                    <p class="mycourse ">شما مدرس این دوره هستید</p>
                                @elseif(auth()->user()->hasAccessToCourse($course))
                                    <p class="mycourse">شما این دوره رو خریداری کرده اید</p>
                                @else
                                    <div class="sell_course">
                                        <strong>قیمت :</strong>
                                        @if($course->getDiscountPercent())
                                            <del class="discount-Price">{{$course->getFormattedPrice() }}</del>
                                        @endif
                                        <p class="price">
                        <span class="woocommerce-Price-amount amount">{{ $course->getFormattedFinalPrice() }}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                        </p>
                                    </div>
                                    <button class="btn buy btn-buy">خرید دوره</button>
                                @endif
                            @endauth
                            @guest()

                                <small>جهت خرید دوره ابتدا در سایت لاگین کنید.</small>
                                <a href="{{ route('login')}}" class="btn text-white w-100">ورود به سایت</a>
                            @endguest

                            <div class="average-rating-sidebar">
                                <div class="rating-stars">
                                    <div class="slider-rating">
                                            <span class="slider-rating-span slider-rating-span-100" data-value="100%"
                                                  data-title="خیلی خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-80" data-value="80%"
                                              data-title="خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-60" data-value="60%"
                                              data-title="معمولی"></span>
                                        <span class="slider-rating-span slider-rating-span-40" data-value="40%"
                                              data-title="بد"></span>
                                        <span class="slider-rating-span slider-rating-span-20" data-value="20%"
                                              data-title="خیلی بد"></span>
                                        <div class="star-fill"></div>
                                    </div>
                                </div>

                                <div class="average-rating-number">
                                    <span class="title-rate title-rate1">امتیاز</span>
                                    <div class="schema-stars">
                                        <span class="value-rate text-message"> 4 </span>
                                        <span class="title-rate">از</span>
                                        <span class="value-rate"> 555 </span>
                                        <span class="title-rate">رأی</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info-box">
                            <div class="product-meta-info-list">
                                <div class="total_sales">
                                    تعداد دانشجو : <span>{{count($course->students)}}</span>
                                </div>
                                <div class="meta-info-unit one">
                                    <span class="title">تعداد جلسات منتشر شده :  </span>
                                    <span class="vlaue">{{$course->lessonsCount()}}</span>
                                </div>
                                <div class="meta-info-unit two">
                                    <span class="title">مدت زمان دوره تا الان : </span>
                                    <span class="vlaue">{{$course->formattedDuration()}}</span>
                                </div>
                                <div class="meta-info-unit three">
                                    <span class="title">مدت زمان کل دوره : </span>
                                    <span class="vlaue">-</span>
                                </div>
                                <div class="meta-info-unit four">
                                    <span class="title">مدرس دوره : </span>
                                    <span class="vlaue">{{$course->teacher->name}}</span>
                                </div>
                                <div class="meta-info-unit five">
                                    <span class="title">وضعیت دوره : </span>
                                    <span class="vlaue">@lang($course->status)</span>
                                </div>
                                <div class="meta-info-unit six">
                                    <span class="title">پشتیبانی : </span>
                                    <span class="vlaue">دارد</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-teacher-details">
                            <div class="top-part">
                                <a href="{{route('singleTutor',$course->teacher->username)}}">
                                    <img alt="{{$course->teacher->name}}"
                                         class="img-fluid lazyloaded"
                                         src="{{$course->teacher->image->thumb ?? "/img/profile.jpg"}}"
                                         loading="lazy">
                                    <noscript>
                                        <img class="img-fluid" src="img/profile.jpg" alt="{{$course->teacher->name}}">
                                    </noscript>
                                </a>
                                <div class="name">
                                    <a href="{{route('singleTutor',$course->teacher->username)}}" class="btn-link"><h6>
                                            {{$course->teacher->name}}
                                        </h6>
                                    </a>
                                    <span class="job-title">{{$course->teacher->headline}}</span>
                                </div>
                            </div>
                            <div class="job-content">
                            </div>
                        </div>
                        <div class="short-link">
                            <div class="">
                                <span>لینک کوتاه</span>
                                <input class="short--link" value="{{$course->shortUrl()}}">
                                <a href="" class="short-link-a" data-link="{{$course->shortUrl()}}"></a>
                            </div>
                        </div>
                        @include("Front::layout.sidebar-banners")

                    </div>
                </div>
                <div class="content-left">
                    @if($lesson->media->type=='video')
                        <div class="preview">
                            <video width="100%" controls>
                                <source src="{{$lesson->downloadLink() }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                    <a href="{{$lesson->downloadLink() }}" class="episode-download">دانلود این قسمت
                        (قسمت {{$lesson->priority}})</a>
                    <div class="course-description">

                        <div class="course-description-title">توضیحات دوره
                            <div class="study-mode"></div>
                        </div>

                        <div>
                            {!! $course->body !!}
                        </div>

                        <div class="tags">
                            <ul>
                                <li><a href="">ری اکت</a></li>
                                <li><a href="">reactjs</a></li>
                                <li><a href="">جاوااسکریپت</a></li>
                                <li><a href="">javascript</a></li>
                                <li><a href="">reactjs چیست</a></li>
                            </ul>
                        </div>
                    </div>

                    @include("Front::layout.episodes-list")
                </div>
            </div>
        </div>
        <div id="Modal-buy" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p>کد تخفیف را وارد کنید</p>
                    <div class="close">&times;</div>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route("courses.buy", $course->id) }}">
                        @csrf
                        <div><input type="text" name="code" id="code-discount" class="txt"
                                    placeholder="کد تخفیف را وارد کنید">
                            <p id="response"></p>
                        </div>
                        <button class="btn i-t " type="button" onclick="handleDiscount()">اعمال
                            <img src="/img/loading.gif" alt="" id="loading" class="loading d-none">
                        </button>

                        <table class="table text-center  table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>قیمت کل دوره</th>
                                <td> {{ $course->getFormattedPrice() }} تومان</td>
                            </tr>
                            <tr>
                                <th>درصد تخفیف</th>
                                <td>
                                    <span id="percentDiscount" data-value="{{ $course->getDiscountPercent() }}"> {{ $course->getDiscountPercent() }}</span>
                                    %
                                </td>
                            </tr>
                            <tr>
                                <th> مبلغ تخفیف</th>
                                <td class="text-red">
                                    <span id="amountDiscount" data-value="{{ $course->getDiscountAmount() }}">  {{ $course->getDiscountAmount() }}</span>

                                    تومان
                                </td>
                            </tr>
                            <tr>
                                <th> قابل پرداخت</th>
                                <td class="text-blue">
                                    <span id="payableAmount" data-value="{{$course->getFinalPrice() }}"> {{ $course->getFormattedFinalPrice() }}</span>
                                    تومان


                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn i-t">پرداخت آنلاین</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="/js/modal.js"></script>
    <script>

        function handleDiscount() {
            $("#loading").removeClass("d-none")
            const code = $("#code-discount").val();
            const url = "{{route("discounts.check",["code",$course->id])}}";
            $("#loading").addClass("d-none")
            $("#response").text("")
            $.get(url.replace("code", code))
                .done(data => {
                    $("#percentDiscount").text(parseInt($("#percentDiscount").attr("data-value")) + data.percentDiscount);
                    $("#amountDiscount").text(parseInt($("#amountDiscount").attr("data-value")) + data.amountDiscount);
                    $("#payableAmount").text(parseInt($("#payableAmount").attr("data-value")) - data.amountDiscount);
                    $("#response").text("کد تخفیف با موفقیت اعمال شد.").removeClass("text-error").addClass("text-success")
                })
                .fail(err => {
                    $("#response").text("کد وارده شده برای این درس معتبر نیست.").removeClass("text-success").addClass("text-error")
                })
                .always(function () {
                    $("#loading").addClass("d-none")
                })
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/modal.css">
@endsection
