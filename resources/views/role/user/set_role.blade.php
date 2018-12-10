@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- Header -->
        <div class="header mt-md-2">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h2 class="header-title">
                            设置角色
                        </h2>

                    </div>

                </div> <!-- / .row -->
            </div>
        </div>


        <form action="{{route('role.user.set_role_store',$user)}}" method="post">
            @csrf
            <div class="card">

                <div class="card-body">

                    <div class="row">
                    @foreach($roles as $role)
                        {{--{{$role['name']}}--}}
                            <div class="col-4">
                                <input type="checkbox" name="roles[]" value="{{$role['name']}}"
                                {{--是否是超级管理员--}}
                                @if($user->hasRole($role['name'])) checked @endif
                                >
                                <strong style="font-size: 14px">{{$role['title']}}</strong>
                            </div>
                    @endforeach
                    </div>

                </div>
            </div>
            <button class="btn btn-primary">保存</button>
        </form>
    </div>
@endsection
