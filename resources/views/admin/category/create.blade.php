@extends('admin.layouts.master')
@section('content')
<!-- MAIN CONTENT
================================================== -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    The article section
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    文章栏目
                                </h1>

                            </div>
                        </div> <!-- / .row -->
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="{{route('admin.category.home')}}" class="nav-link active">
                                            抒写新文章
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="{{route('admin.category.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">文章标题</label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">作者</label>
                                <input type="text" name="author" class="form-control" id="exampleInputPassword1">
                            </div>
                            <label for="exampleInputPassword1">个性图标</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="icon"></span>
                                </div>
                                <input type="text" class="form-control" name="icon" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="lick()" style="cursor: pointer">选择图标</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">文章内容</label>
                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>

                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container-fluid -->
<!-- JAVASCRIPT
================================================== -->
@endsection
@push('js')
    <script>
        function lick() {
            require(['hdjs'],function (hdjs) {
                hdjs.font(function (icon) {
                    //alert(icon)
                    $('input[name=icon]').val(icon);
                    $('#icon').addClass(icon)
                })
            })
        }
    </script>
    @endpush