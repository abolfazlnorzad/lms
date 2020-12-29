@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی دوره</p>
            <form method="post" action="{{ route('courses.store') }}" class="padding-30" enctype="multipart/form-data">
                @csrf
                <x-input type="text"  name="title" placeholder="عنوان دوره" required/>
                <x-input type="text" class="text-left " name="slug" placeholder="نام انگلیسی دوره" required/>
                <div class="d-flex multi-text mb-30">
                    <x-input type="text" class="text-left " name="priority" placeholder="ردیف دوره"/>
                    <x-input type="text" placeholder="مبلغ دوره" name="price" class="text-left  " required/>
                    <x-input type="number" placeholder="درصد مدرس" name="percent" class="text-left " required/>
                </div>
                <x-select  name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                    @endforeach
                </x-select>
                 <x-tag-select name="tags"></x-tag-select>
                <x-select name="type" required>
                    <option value="">نوع دوره</option>
                    @foreach(\Nrz\Course\Model\Course::$types as $type)
                        <option value="{{$type}}">@lang($type)  </option>
                    @endforeach
                </x-select>
                <x-select name="status" required>
                    <option value="">وضعیت دوره</option>
                    @foreach(\Nrz\Course\Model\Course::$statuses as $status)
                        <option value="{{$status}}">@lang($status)</option>
                    @endforeach
                </x-select>
                <x-select name="category_id" required>
                    <option value="">دسته بندی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </x-select>
                <x-file name="image" placeholder="آپلود بنر دوره"></x-file>
                <x-text-area placeholder="توضیحات دوره" name="body"/>
                <br>
                <br>
                <button class="btn btn-webamooz_net">ایجاد دوره</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
