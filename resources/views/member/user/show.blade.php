@extends('index.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="container-fluid">
            <div class="row">
                @include('member.layouts.menu')
                <div class="col-9">
                    <!-- Files -->
                    <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h4 class="card-header-title">
                                        @if(auth()->id()==$user['id'])我@else他@endif的文章
                                    </h4>

                                </div>
                                <div class="col-auto">

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
                                @can('isMine',$user)
                                    <div class="col-auto">
                                        <!-- Button -->
                                        <a href="{{route('index.article.create')}}" class="btn btn-sm btn-primary">
                                            发表文章
                                        </a>
                                    </div>
                                @endcan
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
                                                <a href="{{route('member.user.show',$user)}}" class="avatar avatar-sm">
                                                    <img src="{{$article->user->icon}}" alt="..." class="avatar-img rounded">
                                                </a>

                                            </div>
                                            <div class="col ml--2">

                                                <!-- Title -->
                                                <h4 class="card-title mb-1 name">
                                                    <a href="{{route('index.article.show',$article)}}">{{$article->title}}</a>
                                                </h4>

                                                <p class="card-text small mb-1">
                                                    <a href="{{route('member.user.show',$article->user)}}" class="text-secondary mr-2">
                                                        <i class="fa fa-user-circle" aria-hidden="true"></i>{{$article->user->name}}
                                                    </a>
                                                    {{--Carbon 处理时间库--}}
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i>{{$article->created_at->diffForHumans()}}

                                                    <a href="{{route('member.user.show',[$user,'category'=>$article->category->id])}}" class="text-secondary ml-2">
                                                        <i class="fa fa-folder-o" aria-hidden="true"></i>{{$article->category->title}}</a>
                                                </p>

                                            </div>
                                            <div class="col-auto">

                                                <!-- Dropdown -->
                                                <div class="dropdown">
                                                    <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="" class="dropdown-item">
                                                            查看详情
                                                        </a>
                                                        @can('update',$article)
                                                        <a href="" class="dropdown-item">
                                                            编辑
                                                        </a>
                                                        @endcan

                                                        @can('delete',$article)
                                                        <a href="javascript:;" onclick="del(this)" class="dropdown-item">
                                                            删除
                                                        </a>
                                                        <form action="" method="post">
                                                            @csrf @method('DELETE')
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- / .row -->
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{$articles->links()}}
                </div>
            </div> <!-- / .row -->
        </div>
    </div>
@endsection
@push('js')
    <script>
        function del(obj) {
            require(['hdjs', 'bootstrap'], function (hdjs) {
                hdjs.confirm('确定删除吗?', function () {
                    $(obj).next('form').submit();
                })
            })
        }
    </script>
@endpush