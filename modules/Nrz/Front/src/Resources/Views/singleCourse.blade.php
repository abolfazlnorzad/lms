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
                        <h1 class="title">دوره ساخت پیام رسان تحت وب مشابه Telegram با Laravel و ReactJs و WebSocket به
                            صورت
                            Spa</h1>
                        <div class="breadcrumb">
                            <ul>
                                <li><a href="" title="خانه">خانه</a></li>
                                <li><a href="" title="برنامه نویسی">برنامه نویسی</a></li>
                                <li><a href="" title="وب">وب</a></li>
                            </ul>
                        </div>
                    </div>

                </article>
            </div>


            <div class="main-row container">
                <div class="sidebar-right">
                    <div class="sidebar-sticky">
                        <div class="product-info-box">
                            <div class="discountBadge">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="sell_course">
                                <strong>قیمت :</strong>
                                <del class="discount-Price">{{number_format($course->price)}}</del>
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->price)}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                </p>
                            </div>

                            @auth
                                @if(auth()->id() == $course->teacher_id)
                                    <p class="mycourse ">شما مدرس این دوره هستید</p>
                                @elseif(auth()->user()->hasAccessToCourse($course))
                                    <p class="mycourse">شما این دوره رو خریداری کرده اید</p>
                                @else
                                    <div class="sell_course">
                                        <strong>قیمت :</strong>
                                        <del class="discount-Price">{{ number_format($course->price)}}</del>
                                        <p class="price">
                        <span class="woocommerce-Price-amount amount">{{ number_format($course->price)}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                        </p>
                                    </div>
                                    <button class="btn buy">خرید دوره</button>
                                @endif
                            @else
                                <div class="sell_course ">
                                    <strong>قیمت :</strong>
                                    <del class="discount-Price">{{ number_format($course->price)}}</del>
                                    <p class="price">
                        <span class="woocommerce-Price-amount amount">{{ number_format($course->price)}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                    </p>
                                </div>
                                <button class="btn buy">خرید دوره</button>
                            @endauth


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
                                         src="{{$course->teacher->image->thumb}}"
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
                                <!--                        <p>عاشق برنامه نویسی</p>-->
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
        <br>
        <br>
        <br>
    </main>
@endsection

@section('js')
    <script src="/js/modal.js"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/modal.css">
@endsection
