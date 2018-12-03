@extends('index.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('member.layouts.menu')
            <div class="col-sm-9">

                <!-- Files -->
                <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h4 class="card-header-title">
                                    @if(auth()->id()==$user['id'])我@else他@endif的收藏
                                </h4>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="card-body">
                        @if($enshrineData->count() != 0)
                            <!-- List -->
                            <ul class="list-group list-group-lg list-group-flush list my--4">
                            @foreach($enshrineData as $enshrine)
                             <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="{{route('member.user.show',$enshrine->belongsModel->user)}}" class="avatar avatar-sm">
                                            <img src="{{$enshrine->belongsModel->user->icon}}" alt="..." class="avatar-img rounded">
                                        </a>

                                    </div>
                                    <div class="col ml--2">

                                        <!-- Title -->
                                        <h4 class="card-title mb-1 name">
                                            <a href="{{route('member.user.show',$enshrine->belongsModel->user)}}">{{$enshrine->belongsModel->title}}</a>
                                        </h4>

                                        <p class="card-text small mb-1">
                                            <a href="{{route('member.user.show',$enshrine->belongsModel->user)}}" class="text-secondary mr-2">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>{{$enshrine->belongsModel->user->name}}
                                            </a>

                                            <i class="fa fa-clock-o" aria-hidden="true"></i>{{$enshrine->belongsModel->created_at->diffForHumans()}}

                                            <a href="#" class="text-secondary ml-2">
                                                <i class="fa fa-folder-o" aria-hidden="true"></i>{{$enshrine->belongsModel->category->title}}</a>
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Button -->
                                        <div class="row">
                                            <div class="col text-right">
                                                @auth()

                                                    @if($enshrine->where('user_id',auth()->id())->first())
                                                        <a href="{{route('index.enshrine.ens',['type'=>'article','id'=>$enshrine['enshrine_id']])}}" class="btn btn-outline-info">❤ 取消收藏</a>
                                                    @else
                                                        <a href="{{route('index.enshrine.ens',['type'=>'article','id'=>$enshrine['enshrine_id']])}}" class="btn btn-outline-secondary">💔 收藏</a>
                                                    @endif
                                                @else
                                                    <a href="{{route('user.login',['from'=>url()->full()])}}" class="btn btn-outline-white">💔 收藏</a>
                                                @endauth
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- / .row -->
                            </li>
                            @endforeach
                        </ul>
                        @else
                            <p class="text-muted text-center p-5">暂无收藏</p>
                        @endif
                    </div>
                </div>
                {{$enshrineData->appends(['type'=>Request::query('type')])->links()}}
            </div>
        </div> <!-- / .row -->
    </div>
@endsection