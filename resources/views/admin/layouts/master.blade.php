
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
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Theme CSS -->
    @stack('css')
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">

    <title>后台管理</title>
</head>
<body>

<!-- SIDEBAR
================================================== -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="{{route('index')}}">
            <img src="{{asset('org/assets')}}/img/logo.svg" class="navbar-brand-img
          mx-auto" alt="...">
        </a>

        <!-- User (xs) -->
        <div class="navbar-user d-md-none">

            <!-- Dropdown -->
            <div class="dropdown">

                <!-- Toggle -->
                <a href="#!" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <img src="{{asset('org/assets')}}/img/avatars/profiles/avatar-1.jpg" class="avatar-img rounded-circle" alt="...">
                    </div>
                </a>


            </div>

        </div>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fe fe-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin.index')}}">
                        <i class="fe fe-home"></i> 论坛首页
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.category.index')}}">
                        <i class="fe fe-folder"></i> 管理首页
                    </a>
                </li>
                <li class="nav-item">
                    {{--<a class="nav-link" href="{{route('admin.category.index')}}">--}}
                    <a class="nav-link" href="#sidebarPages" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="fe fe-inbox"></i> 管理系统
                    </a>
                    <div class="collapse" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.category.home')}}" class="nav-link">
                                    文章栏目
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.category.create')}}" class="nav-link">
                                    写入文章
                                </a>
                            </li>
                        </ul>  <!-- / .navbar-collapse -->
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarLayouts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="fe fe-layout"></i> 网站配置
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.config.edit',['name'=>'base'])}}" class="nav-link">
                                    基础配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'upload'])}}" class="nav-link">
                                    上传配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'mail'])}}" class="nav-link">
                                    邮件配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'search'])}}" class="nav-link">
                                    搜索配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'wechat'])}}" class="nav-link">
                                    微信配置
                                </a>
                                <a href="{{route('admin.config.edit',['name'=>'code'])}}" class="nav-link">
                                    验证码配置
                                </a>
                            </li>
                        </ul>  <!-- / .navbar-collapse -->
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarWechat" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fe fe-message-square"></i> 微信管理
                    </a>
                    <div class="collapse show" id="sidebarWechat">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('wechat.button.index')}}" class="nav-link" >
                                    微信菜单
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechat.reply.index')}}" class="nav-link" >
                                    基本回复
                                </a>

                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarImage" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fe fe fe-image"></i> 轮播图设置
                    </a>
                    <div class="collapse" id="sidebarImage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('pager.photo.index')}}" class="nav-link" >
                                    图片Manage
                                </a>

                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="fe fe-git-branch"></i> 系统版本 <span class="badge badge-primary ml-auto">v1.1.2</span>
                    </a>
                </li>

            </ul>
            <div class="navbar-user mt-auto d-none d-md-flex">

                <a href="{{route('member.user.show',auth()->user())}}" class="btn btn-info" style="text-align: center;display: inline-block;width: 30px;height: 10px;font-size: 12px;line-height: 10px;margin-right: 5px">
                    <p style="text-align: center;margin-top: -5px;margin-left: -3px">❤</p>
                </a>

                <!-- Dropup -->
                <div class="dropup">
                    <!-- Toggle -->
                    <a href="#!" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <img src="{{asset('org/img/gyp.jpg')}}" class="avatar-img rounded-circle" alt="...">
                        </div>
                    </a>

                    <!-- Menu -->
                    <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
                        <a href="{{route('user.loginOut')}}" class="dropdown-item">注销登录</a>
                    </div>
                </div>



            </div>
        </div> <!-- / .container-fluid -->
    </div>
</nav>

<!-- MAIN CONTENT
================================================== -->
<div class="main-content">

   @yield('content')

</div>

<!-- JAVASCRIPT
================================================== -->
@include('layouts.hdjs')
@include('layouts.message')
<script>
    require(['bootstrap']);
</script>
@stack('js')
</body>
</html>