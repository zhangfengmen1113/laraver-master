@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                <!-- Header -->
                <div class="header mt-md-2">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    The article section
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    文章栏目
                                </h1>

                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="{{route('admin.category.home')}}" class="nav-link active">
                                            精选文章
                                        </a>

                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <!-- Buttons -->
                                <a href="{{route('admin.category.create')}}" class="btn btn-outline-primary btn-sm">
                                    写入文章
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- / .row -->
        <div class="card">
            <div class="table-responsive mb-0" data-toggle="lists" data-lists-values="[&quot;goal-project&quot;, &quot;goal-status&quot;, &quot;goal-progress&quot;, &quot;goal-date&quot;]">
                <table class="table table-sm table-nowrap card-table">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>文章标题</th>
                        <th>文章作者</th>
                        <th>个性图标</th>
                        <th>动作</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->title}}</td>
                            <td>{{$category->author}}</td>
                            <td><span class="{{$category->icon}}"></span></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                                    <a href="{{route('admin.category.edit',$category)}}" class="btn btn-white">编辑</a>
                                    <button type="button" onclick="del(this)" class="btn btn-white">删除</button>
                                    {{--伪造表单--}}
                                    <form action="{{route('admin.category.destroy',$category)}}" method="post">
                                        @csrf

                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--实现分页--}}
        {{$categories->links()}}
    </div>
@endsection
@push('js')
    <script>
        function del(obj) {
            require(['hdjs','bootstrap'],function (hdjs) {
                hdjs.confirm('真的要删除么？',function () {
                    $(obj).next('form').submit();
                })
            })
        }
    </script>
@endpush
