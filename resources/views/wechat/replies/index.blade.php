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
                            微信文本回复
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('wechat.reply.index')}}" class="nav-link active">
                                    回复列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechat.reply.create')}}" class="nav-link ">
                                    添加自动回复
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="table-responsive mb-0" data-toggle="lists"
                 data-lists-values="[&quot;goal-project&quot;, &quot;goal-status&quot;, &quot;goal-progress&quot;, &quot;goal-date&quot;]">
                <table class="table table-sm table-nowrap card-table">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>规则名称</th>
                        <th>关键词</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @if($field->count()!=0)
                        @foreach($field as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->rule->name}}</td>
                                <td>
                                    {{implode('-',$v->rule->keyword->pluck('key')->toArray())}}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="First group">

                                        <a href="{{route('wechat.reply.edit',$v)}}" class="btn btn-info">编辑</a>

                                        <button onclick="del(this)" type="button" class="btn btn-info">删除</button>
                                        <form action="{{route('wechat.reply.destroy',$v)}}" method="post">
                                            @csrf  @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center text-muted" rowspan="5" colspan="5"><p>暂无文本回复</p></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function del(obj) {
            require(['https://cdn.bootcss.com/sweetalert/2.1.2/sweetalert.min.js'], function (swal) {
                swal("确定删除?", {
                    icon: 'warning',
                    buttons: {
                        cancel: "取消",
                        defeat: '确定',
                    },
                }).then((value) => {
                    switch (value) {
                        case "defeat":
                            $(obj).next('form').submit();
                            break;
                        default:

                    }
                });
            })
        }
    </script>
@endpush
