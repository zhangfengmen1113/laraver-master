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
                            角色管理
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('role.role.index')}}" class="nav-link active">
                                    角色列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('role.role.create')}}" class="nav-link ">
                                    添加角色
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="table-responsive mb-0" data-toggle="lists" data-lists-values="[&quot;goal-project&quot;, &quot;goal-status&quot;, &quot;goal-progress&quot;, &quot;goal-date&quot;]">

                <table class="table table-sm table-nowrap card-table">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>角色中文名称</th>
                        <th>角色英文标识</th>
                        <th>守卫</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @if($roles->count()!=0)
                      @foreach($roles as $role)
                        <tr>
                            @if($role['id'] != 1)
                                <td>{{$role['id']}}</td>
                                <td>{{$role['title']}}</td>
                                <td>{{$role['name']}}</td>
                                <td>{{$role['guard_name']}}</td>

                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                    <a href="{{route('role.role.show',$role)}}" class="btn btn-white">设置权限</a>
                                    <a href="{{route('role.role.edit',$role)}}" class="btn btn-white">编辑</a>
                                    <button type="button" onclick="del(this)" class="btn btn-white">删除</button>
                                    <form action="{{route('role.role.destroy',$role)}}" method="post">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                      @endforeach
                      @else
                        <tr>
                            <td class="text-center text-muted" rowspan="5" colspan="5"><p>暂无角色</p></td>
                        </tr>
                      @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function del(obj) {
            require(['https://cdn.bootcss.com/sweetalert/2.1.2/sweetalert.min.js'], function (swal) {
                swal("确定删除?", {
                    icon: 'warning',
                    buttons: {
                        cancel: "取消",
                        defeat: '确定',
                    },
                }).then((value) => {
                    switch (value) {
                        case "defeat":
                            $(obj).next('form').submit();
                            break;
                        default:

                    }
                });
            })
        }
    </script>
@endpush
