@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="دوره ها">دوره ها</a></li>
@endsection
@section('content')

    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item is-active" href="courses.html">لیست دوره ها</a>
            <a class="tab__item" href="approved.html">دوره های تایید شده</a>
            <a class="tab__item" href="new-course.html">دوره های تایید نشده</a>
            <a class="tab__item" href="{{route('courses.create')}}">ایجاد دوره جدید</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="" onclick="event.preventDefault();">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی دوره">
                    <div class="t-header-search-content ">
                        <input type="text" class="text" placeholder="نام دوره">
                        <input type="text" class="text" placeholder="ردیف">
                        <input type="text" class="text" placeholder="قیمت">
                        <input type="text" class="text" placeholder="نام مدرس">
                        <input type="text" class="text margin-bottom-20" placeholder="دسته بندی">
                        <btutton class="btn btn-webamooz_net">جستجو</btutton>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table class="table">

            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه</th>
                <th>بنر دوره</th>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>مدرس دوره</th>
                <th>جزییات</th>
                <th>قیمت (تومان)</th>

                <th>درصد مدرس</th>
                <th>وضعیت تایید</th>
                <th>وضعیت دوره</th>

                    <th>عملیات</th>

            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr role="row" class="">
                    <td><a href="">{{$course->id}}</a></td>
                    <td width="100"><img width="100" src="{{$course->banner->thumb}}" alt=""></td>
                    <td><a href="">{{$course->priority}}</a></td>
                    <td><a href="">{{$course->title}}</a></td>
                    <td><a href="">{{$course->teacher->name}}</a></td>
                    <td><a href="{{route('courses.details',$course->id)}}">مشاهده</a></td>
                    <td>{{$course->price}}</td>
                    <td>{{$course->percent}}</td>
                    <td class="confirmation_status">@lang($course->confirmation_status)</td>
                    <td class="status">@lang($course->status)</td>

                    <td>
                        @can("isAdmin")
                            <a onclick="deleteItem(event,'{{route('courses.destroy',$course->id)}}')"
                               class="item-delete mlg-15" title="حذف"></a>
                            <a onclick="changeConfirmationStatus(event,'{{route('courses.reject',$course->id)}}','آیا از رد این دوره اطمینان دارید؟','رد شده')"
                               class="item-reject mlg-15" title="رد"></a>
                            <a onclick="changeConfirmationStatus(event,'{{route('courses.lock',$course->id)}}','آیا از قفل کردن این دوره اطمینان دارید؟','قفل شده','status')"
                               class="item-lock mlg-15" title="قفل دوره"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a onclick="changeConfirmationStatus(event,'{{route('courses.accept',$course->id)}}','آیا از تایید این دوره اطمینان دارید؟','تایید شده')"
                               class="item-confirm mlg-15" title="تایید"></a>
                        @endcan
                        <a href="{{route('courses.edit',$course->id)}}" class="item-edit " title="ویرایش"></a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
