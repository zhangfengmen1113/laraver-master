@extends('index.layouts.master')
@section('content')
    {{--@can('update',$data)--}}
    {{--@endcan--}}
    <div class="container mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Files -->
                    <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h4 class="card-header-title">
                                        搜索列表
                                    </h4>

                                </div>
                            </div> <!-- / .row -->
                        </div>

                        <div class="card-body">

                            <!-- List -->
                            <ul class="list-group list-group-lg list-group-flush list my--4">
                                @foreach($articles as $article)
                                   <li class="list-group-item px-0">

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <!-- Avatar -->
                                            <a href="{{route('member.user.show',$article->user)}}" class="avatar avatar-sm">
                                                <img src="{{$article->user->icon}}" alt="..." class="avatar-img rounded">
                                            </a>

                                        </div>
                                        <div class="col ml--2">

                                            <!-- Title -->
                                            <h4 class="card-title mb-1 name">
                                                <a href="{{route('member.user.show',$article)}}">{{$article->title}}</a>
                                            </h4>

                                            <p class="card-text small mb-1">
                                                <a href="{{route('member.user.show',$article->user)}}" class="text-secondary mr-2">
                                                    <i class="fa fa-user-circle" aria-hidden="true"></i> {{$article->user->name}}
                                                </a>
                                                {{--Carbon 处理时间库--}}
                                                <i class="fa fa-clock-o" aria-hidden="true"></i> {{$article->created_at->diffForHumans()}}

                                                <a href="#!" class="text-secondary ml-2">
                                                    <i class="fa fa-folder-o" aria-hidden="true"></i> {{$article->category->title}}</a>
                                            </p>

                                        </div>
                                        <div class="col-auto">

                                            <!-- Dropdown -->
                                            <div class="dropdown">
                                                <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('index.article.show',$article)}}" class="dropdown-item">
                                                        查看详情
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- / .row -->

                                </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    {{--自定义分页url--}}
                    {{--手册位置：分页-->附加参数到分页链接--}}
                    {{--appends(['参数名' => '参数值'])--}}
{{--                    {{$articles->appends(['wd' => Request::query('wd'),'category'=>Request::query('category')])->links()}}--}}
                    {{$articles->appends(['wd' => Request::query('wd')])->links()}}
                </div>
            </div> <!-- / .row -->
        </div>
    </div>
@endsection