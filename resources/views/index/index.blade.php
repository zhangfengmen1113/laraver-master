@extends('index.layouts.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="card col-9">
                <div class="card-body text-center">
                    <div class="row justify-content-center">

                        <!-- Image -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($photos as $photo)
                                <div class="swiper-slide">
                                    <img src="{{$photo->path}}">
                                </div>
                                @endforeach
                            </div>
                            <!-- 如果需要分页器 -->
                            <div class="swiper-pagination"></div>

                            <!-- 如果需要导航按钮 -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            <div class="col-3">
                <!-- Files -->
                <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h4 class="card-header-title">
                                    最新动态
                                </h4>

                            </div>
                        </div> <!-- / .row -->
                    </div>

                    <div class="card-body">

                        <!-- List group -->
                        <div class="list-group list-group-flush my--3">
                            @foreach($actives as $active)
                                @if($active['log_name']=='article')
                                   @include('index.layouts._article')
                                @elseif($active['log_name']=='comment')
                                    @include('index.layouts._comment')
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <!-- List -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .swiper-container {
            width: 600px;
            height: 300px;
        }
        img{
            width: 600px;
            height: 300px;
        }
    </style>
@endpush
@push('js')
    <script>
        require(['hdjs'], function (hdjs) {
            hdjs.swiper('.swiper-container', {
                loop: true,
                //自动轮换
                autoplay: {
                    delay: 1000,
                },
                //如果需要分页器
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                //如果需要前进后退按钮
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            })
        })
    </script>
@endpush
