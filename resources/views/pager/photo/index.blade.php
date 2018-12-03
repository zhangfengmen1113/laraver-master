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
                            轮播图Img管理
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('pager.photo.index')}}" class="nav-link">
                                    Img展示
                                </a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="col-sm-12 mt-3">
                <div style="display: inline-block;width: 1027px;">
                    {{--{{dd($paths)}}--}}
                        @foreach($photos as $photo)
                            <img style="cursor: pointer;float: left" src="{{$photo->path}}" class="img-responsive img-thumbnail" width="150" onclick="del(this)">

                            <form action="{{route('pager.photo.destroy',$photo)}}" method="post">
                                @csrf @method('DELETE')
                            </form>
                        @endforeach

                </div>
            </div>
            <div id="upLoads" class="input-group mb-1" style="display: block;text-align: center;width: 100%">
                <button onclick="upImagePc(this)" class="btn btn-info" type="button" style="height: 35px">上传</button>
            </div>
            <form  action="{{route('pager.photo.store')}}" method="post">
                @csrf
                <input hidden type="text" value="" name="thumb">
            </form>
        </div>
        {{$photos->links()}}
    </div>
@endsection
@push('js')
    <script>
        require(['hdjs','bootstrap']);
        //上传图片
        function upImagePc() {
            require(['hdjs'], function (hdjs) {
                var options = {
                    multiple: false,//是否允许多图上传
                    //data是向后台服务器提交的POST数据
                    data: {name: '后盾人', year: 2099},
                };
                hdjs.image(function (images) {
                    //alert(1);
                    //上传成功的图片，数组类型
                    $("[name='thumb']").val(images[0]);

                    $(".img-thumbnail").attr('src', images[0]);

                    $('#upLoads').next().submit();
                }, options)
            });
        }
        //移除图片
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