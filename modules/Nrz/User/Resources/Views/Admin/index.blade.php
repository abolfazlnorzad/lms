@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">کاربران</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>ایمیل</th>
                        <th>شماره موبایل</th>
                        <th>ادمین</th>
                        <th>کارمند</th>
                        <th>سطوح دسترسی</th>
                        <th>نقش کاربری</th>
                        <th>تاریخ عضویت</th>
                        <th>وضعیت حساب</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr role="row" class="">
                            <td><a href="">{{ $user->id }}</a></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->is_admin == 1 ?'بله':'خیر' }}</td>
                            <td>{{ $user->is_staff == 1 ?'بله':'خیر'  }}</td>
                            <td>
                                <ul>
                                    @foreach($user->permissions as $userPermission)

                                        <li class="deleteable-list-item">
                                            {{$userPermission->label}}
                                            <a href=""
                                               onclick="deleteItem(event, '{{ route('removePermission', ['user'=>$user,'permission'=>$userPermission])}}','li')"
                                               class="item-delete mlg-15 text-error" title="حذف"></a>
                                        </li>

                                    @endforeach
                                    <li><a
                                            onclick="SetUserIdForAddPermission({{$user->id}})"
                                            href="#add-permission-frm" rel="modal:open">افزودن سطح دسترسی</a></li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach($user->roles as $userRole)
                                        <li class="deleteable-list-item">
                                            {{$userRole->label}}
                                            <a href=""
                                               onclick="deleteItem(event, '{{ route('removeRole', ['user'=>$user,'role'=>$userRole])}}','li')"
                                               class="item-delete mlg-15 text-error" title="حذف"></a>
                                        </li>

                                    @endforeach
                                        <li><a
                                                onclick="SetUserIdForAddRole({{$user->id}})"
                                                rel="modal:open"    href="#add-role-frm">افزودن نقش کاربری</a></li>
                                </ul>
                            </td>
                            <td>{{ $user->created_at }}</td>

                            <td class="confirmation_status">{!! $user->hasVerifiedEmail() ? "<span class='text-success'>تایید شده</span>"  : "<span class='text-error'>تایید نشده</span>" !!}</td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('users.destroy', $user->id) }}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('users.edit', $user->id) }}" class="item-edit mlg-15"
                                   title="ویرایش"></a>
                                  <a href="" onclick="changeConfirmationStatus(event, '{{ route('users.manualVerify', $user->id) }}',
                                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')" class="item-confirm mlg-15" title="تایید"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <form
                id="add-permission-frm" method="post" class="modal" action="{{route('addPermission',0)}}">
                @csrf
                <select name="permission" id="">
                    <option>یک سطح دسترسی را انتخاب کنید</option>
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->label}}</option>
                    @endforeach
                </select>
                <br>
                <button class="btn btn-webamooz_net">افزودن</button>
            </form>


            <form
                id="add-role-frm" method="post" class="modal" action="{{route('addRole',0)}}">
                @csrf
                <select name="role" id="">
                    <option>یک نقش کاربری را انتخاب کنید</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->label}}</option>
                    @endforeach
                </select>
                <br>
                <button class="btn btn-webamooz_net">افزودن</button>
            </form>


        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script>
        $('a[data-modal]').click(function (event) {
            $(this).modal();
            return false;

        });


        function SetUserIdForAddPermission(userId) {
            let action = '{{route('addPermission',0)}}'
            $('#add-permission-frm').attr('action', action.replace('/0/', '/' + userId + '/'))

        }

        function SetUserIdForAddRole(userId) {
            let action = '{{route('addRole',0)}}'
            $('#add-role-frm').attr('action', action.replace('/0/', '/' + userId + '/'))

        }

        @include('Common::layout.feedback')
    </script>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
@endsection
