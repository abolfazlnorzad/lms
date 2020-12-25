@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('categories.index')}}" title="دسته بندی ها">دسته بندی ها</a></li>
    <li><a href="#" title="ویرایش دسته بندی ">ویرایش دسته بندی </a></li>
@endsection
@section('content')
    <div class="col-4 bg-white">
        <p class="box__title">ایجاد دسته بندی جدید</p>
        <form action="{{route('categories.update',$category->id)}}" method="post" class="padding-30">
            @csrf
            @method('PATCH')
            <input required type="text" name="title" placeholder="نام دسته بندی" class="text"
                   value="{{old($category->title,$category->title)}}">
            <input required type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text"
                   value="{{old($category->slug,$category->slug)}}">
            <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
            <select name="parent_id" id="">
                <option value="">ندارد</option>
                @foreach($categories as $cate)
                    <option  value="{{$cate->id}}"
                    {{ $cate->id == $category->parent_id ? 'selected' : '' }}
                    >{{$cate->title}}</option>
                @endforeach
            </select>
            <button class="btn btn-webamooz_net"> بروزرسانی</button>
        </form>
    </div>

@endsection
