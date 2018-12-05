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

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">


                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('role.role.store')}}">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">角色中文名称</label>
                                <input type="text" value="" name="title" class="form-control" id="exampleInputEmail1" placeholder="请输入角色中文名称">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">角色英文标识</label>
                                <input type="text" value="" name="name" class="form-control" id="exampleInputEmail1" placeholder="请输入角色英文标识">
                            </div>
                            <button type="submit" class="btn btn-primary">保存数据</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
