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
                            微信基本回复
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('wechat.reply.index')}}" class="nav-link ">
                                    回复列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechat.reply.edit',$reply)}}" class="nav-link active">
                                    编辑自动回复
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('wechat.reply.update',$reply)}}" method="post">
            @csrf
           @method('PUT')
           {!! $ruleView !!}

            <div class="card" id="keyword">
                <div class="card-body" id="keyword-textarea">
                    <div class="form-group" v-for="(v,k) in contents">
                        <label for="exampleInputEmail1">回复内容</label>
                        <a href="" style="border: 1px solid #d1d9e1;font-size: 14px;display: inline-block;float: right;" @click.prevent="del(k)" class="text-muted">删除</a>
                        <a href="javascript:;" style="border: 1px solid #d1d9e1;font-size: 14px;display: inline-block;float: right;margin-right: 5px">表情</a>
                        <textarea class="form-control" v-model="v.content" ></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-white" @click="add" type="button">添加回复内容</button>
                </div>
                <textarea hidden name="data" cols="30" rows="10">@{{ contents }}</textarea>
            </div>
            <button class="btn btn-primary">保存</button>
        </form>

    </div>
@endsection
@push('js')
    <script>
        require(['vue','hdjs'],function (Vue,hdjs) {
            new Vue({
                el:'#keyword',
                data:{
                    contents:{!! $reply['content'] !!}
                },
                mounted(){
                   this.emotion()
                },
                updated(){
                   this.emotion()
                },
                methods:{
                    emotion(){
                        //因为btn里面的this，我们后面会用到，所以不能把这个函数转为挂钩函数
                        //所以我们在外面先定义this
                        var _this = this;
                        $('#keyword textarea').each(function () {
                            hdjs.emotion({
                                //点击的元素，可以为任何元素触发
                                btn: $(this).prev('a'),
                                //选中图标后填入的文本框
                                input: $(this),
                                //选中图片后，执行回调
                                callback: function (con,btn,input) {
                                     //console.log(con);表情
                                    //先获得文本域的序号
                                    let index = $(input).index('#keyword-textarea textarea');
                                    //console.log(index);
                                    _this.contents[index].content = input.val();

                                }
                            })
                        })
                    },
                    add(){
                       this.contents.push({content:''});
                    },
                    del(k){
                       this.contents.splice(k,1);
                    }
                }
            })
        })
    </script>
@endpush
