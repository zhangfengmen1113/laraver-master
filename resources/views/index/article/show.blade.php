@extends('index.layouts.master')
@section('content')
    <div class="container">
        <div class="row edu-topic-show mt-3">
            <div class="col-12 col-xl-9">
                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col text-right">
                            @auth()
                                {{--路由参数：type是指收藏的类型（article）id是指文章的id--}}
                                @if($article->enshrine->where('user_id',auth()->id())->first())
                                    <a href="{{route('index.enshrine.ens',['type'=>'article','id'=>$article['id']])}}" class="btn btn-outline-info">❤ 取消收藏</a>
                                @else
                                    <a href="{{route('index.enshrine.ens',['type'=>'article','id'=>$article['id']])}}" class="btn btn-outline-secondary">💔 收藏</a>
                                @endif
                            @else
                                <a href="{{route('user.login',['from'=>url()->full()])}}" class="btn btn-outline-white">💔 收藏</a>
                            @endauth
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <h2 class="mb-4">
                                {{$article['title']}}
                            </h2>
                            <p class="text-muted mb-1 text-muted small">
                                <a href="" class="text-secondary">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </a><a href="" class="text-secondary">{{$article->user->name}}</a>

                                <i class="fa fa-clock-o ml-2" aria-hidden="true"></i>
                                {{$article->created_at->diffForHumans()}}

                                <a href="" class="text-secondary">
                                    <i class="fa fa-folder-o ml-2" aria-hidden="true"></i>
                                    {{$article->category->title}}
                                </a>

                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="markdown editormd-html" id="content">
                                <textarea name="content" id=" " hidden cols="30" rows="10">{{$article->content}}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        @auth()
                            {{--路由参数：type是指点赞的类型（article或者comment）id是指评论或者文章的id--}}
                            @if($article->zan->where('user_id',auth()->id())->first())
                                <a href="{{route('index.zan.like',['type'=>'article','id'=>$article['id']])}}" class="btn btn-outline-info">✹</a>
                            @else
                                <a href="{{route('index.zan.like',['type'=>'article','id'=>$article['id']])}}" class="btn btn-outline-secondary">☼</a>
                            @endif
                        @else
                            <a href="{{route('user.login',['from'=>url()->full()])}}" class="btn btn-outline-white">☼</a>
                        @endauth
                    </div>
                    <div class="row">

                        <div class="col-12 mr--3">

                            <div class="avatar-group d-none d-sm-flex">
                                    @foreach($article->zan as $zan)
                                    <a href="{{route('member.user.show',$zan->user)}}" class="avatar avatar-xs" data-toggle="tooltip" title="" data-original-title="Ab Hadley" id="tool">
                                        <img src="{{$zan->user->icon}}" alt="..." class="avatar-img rounded-circle border border-white" id="mg">
                                    </a>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @include('index.layouts.comment')
            </div>
            <div class="col-12 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <a href="" class="text-secondary">
                                {{$article->user->name}}
                            </a>
                        </div>
                    </div>
                    <div class="card-block text-center p-5">
                        <div class="avatar avatar-xl">
                            <a href="">
                                <img src="{{$article->user->icon}}" alt="..." class="avatar-img rounded-circle">
                            </a>
                        </div>
                    </div>
                    @can('isNotMine',$article->user)
                        <div class="card-footer text-muted">
                            @if($article->user->fans->contains(auth()->user()))
                                <a class="btn btn-white btn-block btn-xs" href="{{route('member.attention',$article->user)}}">
                                    <i class="fa fa-plus" aria-hidden="true"></i>取消关注
                                </a>
                            @else
                                <a class="btn btn-white btn-block btn-xs" href="{{route('member.attention',$article->user)}}">
                                    <i class="fa fa-plus" aria-hidden="true"></i> 关注 TA
                                </a>
                            @endif
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        require(['hdjs','MarkdownIt','marked', 'highlight'], function (hdjs,MarkdownIt,marked) {
            //将markdown转为html代码：http://hdjs.hdphp.com/771125
            let md = new MarkdownIt();
            let content = md.render($('textarea[name=content]').val());
            $('#content').html(content);
            //代码高亮
            $(document).ready(function() {
                $('pre code').each(function(i, block) {
                    hljs.highlightBlock(block);
                });
            });
        });
    </script>
@endpush