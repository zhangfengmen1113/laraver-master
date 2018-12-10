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
                            给 <span class="text-muted">{{$role->title}}</span> 设置权限
                        </h2>
                    </div>

                </div> <!-- / .row -->
            </div>
        </div>

        <form action="{{route('role.role.set_role_permission',$role)}}" method="post">
            @csrf
            <div class="card">

                <div class="card-body">
                    @foreach($modules as $module)
                        <div class="card">
                            <div class="card-header" style="font-weight: 700">
                                {{$module['title']}}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($module['permissions'] as $v)
                                        <div class="col-4">
                                            <input type="checkbox" name="permission[]" value="{{$module['name']}}~{{$v['name']}}"
                                            {{--角色是否拥有权限--}}
                                            @if($role->hasPermissionTo($module['name'].'~'.$v['name'])) checked @endif
                                            @if('Admin~admin~index'==$module['name'].'~'.$v['name']) checked @endif
                                            >
                                            <strong style="font-size: 14px">{{$v['title']}}</strong>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <button class="btn btn-primary">保存数据</button>
        </form>
    </div>

@endsection
