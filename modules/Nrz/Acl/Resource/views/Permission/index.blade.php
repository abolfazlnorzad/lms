@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('permissions.index') }}" title="نقشهای کاربری">نقشهای کاربری</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">نقش های کاربری</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام اجازه دسترسی</th>
                        <th>توضیحات</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr role="row" class="">
                            <td><a href="">{{ $permission->id }}</a></td>
                            <td><a href="">{{ $permission->name }}</a></td>
                            <td><a href="">{{ $permission->label }}</a></td>

                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('permissions.destroy', $permission->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('permissions.edit',  $permission->id) }}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('Acl::Permission.create')
        </div>
    </div>
@endsection
