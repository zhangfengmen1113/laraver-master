@extends('admin.layouts.master')
@section('content')
<!-- MAIN CONTENT
================================================== -->

        <div class="container-fluid">
            <div class="pt-7 pb-8 bg-dark bg-ellipses">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">

                        <!-- Title -->
                        <h1 class="display-3 text-center text-white">
                            论一论，谈一谈
                        </h1>

                        <!-- Text -->
                        <p class="lead text-center text-muted">
                            Welcome to talk about it
                        </p>

                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container-fluid -->


        <!-- CONTENT -->
        <div class="container-fluid">
            <div class="row mt--7">
                <div class="col-12 col-lg-4">

                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">

                            <!-- Title -->
                            <h6 class="text-uppercase text-center text-muted my-4">
                                Handpick
                            </h6>

                            <!-- Price -->
                            <div class="row no-gutters align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div class="h1 mb-0">精选</div>
                                </div>
                            </div> <!-- / .row -->

                            <!-- Period -->
                            <div class="h6 text-uppercase text-center text-muted mb-5">

                            </div>

                            <!-- Features -->
                            <div class="mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Unlimited activity</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Direct messaging</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Members</small> <small>10 members</small>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Admins</small> <small>No access</small>
                                    </li>
                                </ul>
                            </div>

                            <!-- Button -->
                            <a href="{{route('admin.category.home')}}" class="btn btn-block btn-light">
                                进入
                            </a>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-4">

                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">

                            <!-- Title -->
                            <h6 class="text-uppercase text-center text-muted my-4">
                                BBS with said
                            </h6>

                            <!-- Price -->
                            <div class="row no-gutters align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div class="display-4 mb-0">论谈随说</div>
                                </div>
                            </div> <!-- / .row -->

                            <!-- Period -->
                            <div class="h6 text-uppercase text-center text-muted mb-5"></div>

                            <!-- Features -->
                            <div class="mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Unlimited activity</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Direct messaging</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Members</small> <small>Unlimited</small>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Admins</small> <small>Unlimited</small>
                                    </li>
                                </ul>
                            </div>
                            <!-- Button -->
                            <a href="#!" class="btn btn-block btn-primary">
                                Let's go
                            </a>


                        </div>
                    </div>

                </div>

                <div class="col-12 col-lg-4">

                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">

                            <!-- Title -->
                            <h6 class="text-uppercase text-center text-muted my-4">
                                Information
                            </h6>

                            <!-- Price -->
                            <div class="row no-gutters align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div class="h1 mb-0">资讯</div>
                                </div>
                            </div> <!-- / .row -->

                            <!-- Period -->
                            <div class="h6 text-uppercase text-center text-muted mb-5"></div>

                            <!-- Features -->
                            <div class="mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Unlimited activity</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Direct messaging</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Members</small> <small>50 members</small>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                        <small>Admins</small> <small>5 admins</small>
                                    </li>
                                </ul>
                            </div>

                            <!-- Button -->
                            <a href="#!" class="btn btn-block btn-light">
                                查看
                            </a>

                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-12 col-md-6">

                    <!-- Card -->
                    <div class="card card-inactive">
                        <div class="card-body">

                            <!-- Title -->
                            <h3 class="text-center">
                                Need some help deciding?
                            </h3>

                            <!-- Text -->
                            <p class="text-muted text-center">
                                We can help you decide what’s the best for your company based on a lot of factors and other cool stuff that I’m going to write about.
                            </p>

                            <!-- Button -->
                            <div class="text-center">
                                <a href="#!" class="btn btn-outline-secondary">
                                    Contact us
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6">

                    <!-- Card -->
                    <div class="card card-inactive">
                        <div class="card-body">

                            <!-- Title -->
                            <h3 class="text-center">
                                Want a custom plan?
                            </h3>

                            <!-- Text -->
                            <p class="text-muted text-center">
                                We can help you decide what’s the best for your company based on a lot of factors and other cool stuff that I’m going to write about.
                            </p>

                            <!-- Button -->
                            <div class="text-center">
                                <a href="#!" class="btn btn-outline-secondary">
                                    Build it
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container-fluid -->

@endsection
