<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/fonts/feather/feather.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/highlight/styles/vs2015.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/quill/dist/quill.core.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_839711_tsh46r0x4g.css">

    <meta name="csrf-token" content="{{csrf_token()}}">
    @stack('css')
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">

    <title>{{hd_config('base.title')}}</title>
</head>
<body>

<!-- TOPNAV
================================================== -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">

        <!-- Toggler -->
        <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand mr-auto" href="{{route('index')}}">
            <span class="iconfont icon-tianjinhangkong_GX"></span>
        </a>

        <!-- Form -->
        <form class="form-inline mr-4 d-none d-lg-flex" action="{{route('index.search')}}">
            <div class="input-group input-group-rounded input-group-merge" data-toggle="lists" data-lists-values='["name"]'>

                <!-- Input -->
                <input type="search" name="wd" class="form-control form-control-prepended  dropdown-toggle search" data-toggle="dropdown" placeholder="快爱我！" aria-label="Search">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fe fe-search"></i>
                    </div>
                </div>
            </div>
        </form>

        <!-- User -->
        <div class="navbar-user">
        @auth()
            <!-- Dropdown -->
            <div class="dropdown mr-4 d-none d-lg-flex">

                <!-- Toggle -->
                <a href="#" class="text-muted" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="icon @if(auth()->user()->unreadNotifications()->count() != 0) active @endif">
                <i class="fe fe-bell"></i>
              </span>
                </a>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="card-header-title">
                                    消息({{auth()->user()->unreadNotifications()->count()}})
                                </h5>

                            </div>
                            <div class="col-auto">

                                <!-- Link -->
                                <a href="{{route('member.notify',auth()->user())}}" class="small" style="color: black">
                                    所有消息
                                </a>

                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .card-header -->
                    <div class="card-body">
                        @if(auth()->user()->unreadNotifications()->count() != 0)

                            <!-- List group -->
                            <div class="list-group list-group-flush my--3">
                                 @foreach(auth()->user()->unreadNotifications()->limit(3)->get() as $notification)
                                    <a class="list-group-item px-0" href="{{route('member.notify.show',$notification)}}">

                                        <div class="row">
                                            <div class="col-auto">

                                                <!-- Avatar -->
                                                <div class="avatar avatar-sm">
                                                    <img src="{{$notification['data']['user_icon']}}" alt="..." class="avatar-img rounded-circle">
                                                </div>

                                            </div>
                                            <div class="col ml--2">

                                                <!-- Content -->
                                                <div class="small text-muted">
                                                    <strong class="text-body">{{$notification['data']['user_name']}}</strong> 评论了
                                                    <strong class="text-body">{{$notification['data']['article_title']}}</strong>
                                                </div>

                                            </div>
                                            <div class="col-auto">

                                                <small class="text-muted">
                                                    {{$notification->created_at->diffForHumans()}}
                                                </small>

                                            </div>
                                        </div> <!-- / .row -->

                                    </a>
                                 @endforeach
                            </div>
                        @else
                          <p class="text-muted text-center">暂无消息</p>
                        @endif
                    </div>
                </div>
            </div>
            @endauth
            {{--写入文章--}}
            <div class="dropdown mr-4 d-none d-lg-flex">

                <!-- Toggle -->
                <a href="{{route('index.article.create')}}" class="text-muted">
              <span class="active">
                  @auth()
                    <i class="fe fe-edit-2"></i>
                  @endauth
              </span>
                </a>
            </div>

            <!-- 用户头像 Dropdown -->
            <div class="dropdown">
                @auth()
                <!-- Toggle -->
                <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{auth()->user()->icon}}" alt="..." class="avatar-img rounded-circle">
                </a>
                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('member.user.show',auth()->user())}}" class="dropdown-item">{{auth()->user()->name}}</a>
                    @can('Admin~admin~index')
                    <a href="{{route('admin.index')}}" class="dropdown-item">后台管理</a>
                    @endcan
                    <hr class="dropdown-divider">
                    <a href="{{route('user.loginOut')}}" class="dropdown-item">注销用户</a>
                </div>
                @else
                <a href="{{route('user.login')}}" class="btn btn-white btn-sm">登录</a>
                <a href="{{route('user.register')}}" class="btn btn-white btn-sm">注册</a>
               @endauth
            </div>

        </div>
        <!-- Collapse -->

        <div class="collapse navbar-collapse mr-auto order-lg-first" id="navbar">

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <input type="search" class="form-control form-control-rounded" placeholder="Search" aria-label="Search">
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}" style="font-size: 18px;font-weight: 700">
                        论坛Forum
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fa fa-dashcube" style="margin-top: 5px" href="{{route('index.article.index')}}" id="topnavPages">
                        论坛说
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fa fa-info" style="margin-top: 5px" href="#!" id="topnavAuth">
                        留信
                    </a>
                </li>
            </ul>

        </div>

    </div> <!-- / .container -->
</nav>

<!-- MAIN CONTENT
================================================== -->
<div class="main-content">

    @yield('content')

</div>
<footer class="container">
    <hr class="my-0">
    <div class="text-center py-6">
        <div>
            <p class="text-muted">我们的使命：自由言论，想怎么说怎么说</p>
            <small class="small text-secondary">
                Copyright © 2010-2018 houdunren.com All Rights Reserved
                京ICP备12048441号-3
            </small>
            <p class="small text-secondary">
                <i class="fa fa-phone-square" aria-hidden="true"></i> : 010-88888888
                <i class="fa fa-telegram ml-2" aria-hidden="true"></i> :
                <a href="mailto:23000711698@qq.com" class="text-secondary">
                    2524346947@qq.com
                </a>
                <br>
            </p>
        </div>
    </div>
</footer>
@include('layouts.hdjs')
<script>
    require(['bootstrap']);
</script>
@include('layouts.message')
@stack('js')
</body>
</html>
