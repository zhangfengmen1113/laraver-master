@extends('index.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('member.layouts.menu')
            <div class="col-8">

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
                            <div class="col-2">

                                <!-- Dropdown -->
                                <div class="dropdown">

                                    <!-- Toggle -->
                                    <a href="#!" class="small text-muted dropdown-toggle" data-toggle="dropdown">
                                        筛选
                                    </a>

                                    <!-- Menu -->
                                    <div class="dropdown-menu">
                                        @foreach($categorise as $category)
                                            <a class="dropdown-item sort" href="{{route('member.user.show',[$user,'category'=>$category['id']])}}">
                                                {{$category['title']}}
                                            </a>
                                        @endforeach
                                    </div>

                                </div>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="card-body">

                        <!-- List -->
                        <ul class="list-group list-group-lg list-group-flush list my--4">

                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="" class="avatar avatar-sm">
                                            <img src="" alt="..." class="avatar-img rounded">
                                        </a>

                                    </div>
                                    <div class="col ml--2">

                                        <!-- Title -->
                                        <h4 class="card-title mb-1 name">
                                            <a href="">臣妾冤枉啊！！！陛下~陛下~~~</a>
                                        </h4>

                                        <p class="card-text small mb-1">
                                            <a href="" class="text-secondary mr-2">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>帅气的猪猪男孩
                                            </a>

                                            <i class="fa fa-clock-o" aria-hidden="true"></i>5天前

                                            <a href="" class="text-secondary ml-2">
                                                <i class="fa fa-folder-o" aria-hidden="true"></i>你的她常说的话，而你却不知话里话</a>
                                        </p>
                                    </div>
                                    <div class="col-auto">

                                        <!-- Button -->
                                        <div class="row">
                                            <div class="col text-right">
                                                <a href="" class="btn btn-outline-info">💔 收藏</a>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- / .row -->
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>
@endsection