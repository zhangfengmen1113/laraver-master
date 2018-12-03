@extends('index.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('member.layouts.menu')
            <div class="col-sm-9">
                <div class="container-fluid">
                    <div class="header-body mt--5 ">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="{{route('member.my.like',[$user,'type'=>'article'])}}" class="nav-link active">
                                            文章
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('member.my.like',[$user,'type'=>'comment'])}}" class="nav-link">
                                            评论
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <!-- Files -->
                            <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <!-- Title -->
                                            <h4 class="card-header-title">
                                                我赞过的文章
                                            </h4>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="card-body">
                                    @if($zanData->count() != 0)
                                        <!-- List -->
                                        <ul class="list-group list-group-lg list-group-flush list my--4">
                                              @foreach($zanData as $zan)
                                                <li class="list-group-item px-0">

                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <!-- Avatar -->
                                                            <a href="{{route('member.user.show',$zan->belongsModel->user)}}" class="avatar avatar-sm">
                                                                <img src="{{$zan->belongsModel->user->icon}}" alt="..." class="avatar-img rounded">
                                                            </a>

                                                        </div>
                                                        <div class="col ml--2">

                                                            <!-- Title -->
                                                            <h4 class="card-title mb-1 name">
                                                                <a href="{{route('index.article.show',$zan->belongsModel->id)}}">
                                                                    {{$zan->belongsModel->title}}
                                                                </a>
                                                            </h4>

                                                            <p class="card-text small mb-1">
                                                                <a href="{{route('member.user.show',$zan->belongsModel->user)}}" class="text-secondary mr-2">
                                                                    <i class="fa fa-user-circle" aria-hidden="true"></i>{{$zan->belongsModel->user->name}}
                                                                </a>

                                                                <i class="fa fa-clock-o" aria-hidden="true"></i>{{$zan->belongsModel->created_at->diffForHumans()}}

                                                                <a href="#" class="text-secondary ml-2">
                                                                    <i class="fa fa-folder-o" aria-hidden="true"></i>
                                                                    {{$zan->belongsModel->category->title}}
                                                                </a>
                                                            </p>

                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="row">
                                                                <div class="col text-right">
                                                                    @auth()
                                                                        {{--路由参数：type是指点赞的类型（article或者comment）id是指评论或者文章的id--}}
                                                                        @if($zan->where('user_id',auth()->id())->first())
                                                                            <a href="{{route('index.zan.like',['type'=>'article','id'=>$zan['zan_id']])}}" class="btn btn-outline-info" >✹</a>
                                                                        @else
                                                                            <a href="{{route('index.zan.like',['type'=>'article','id'=>$zan['zan_id']])}}" class="btn btn-outline-secondary" >✪</a>
                                                                        @endif
                                                                    @else
                                                                        <a href="{{route('user.login',['from'=>url()->full()])}}" class="btn btn-outline-white">✪</a>
                                                                    @endauth
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div> <!-- / .row -->

                                                </li>
                                              @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted text-center p-5">暂无欣赏的文章</p>
                                    @endif

                                </div>
                            </div>

                         {{$zanData->appends(['type'=>Request::query('type')])->links()}}
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>

        </div>
    </div>
@endsection