@extends('layouts.app')

@section('content')


    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="clearfix"></div>
    <div class="page-container">
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="200" style="padding-top: 20px">
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a href="{{url('/home')}}" class="nav-link nav-toggle ">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="heading">
                        <h3 class="uppercase">Tables</h3>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{url('/event')}}" class="nav-link nav-toggle">
                            <i class="icon-bulb"></i>
                            <span class="title">Events</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{url('/contact')}}" class="nav-link nav-toggle">
                            <i class="icon-call-end"></i>
                            <span class="title">Contacts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/user')}}" class="nav-link nav-toggle">
                            <i class="icon-user"></i>
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li class="heading">
                        <h3 class="uppercase">Add</h3>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{url('/event/add')}}" class="nav-link nav-toggle">
                            <i class="icon-note"></i>
                            <span class="title">New Event</span>
                        </a>
                    </li>
                    <li class="nav-item  start active open">
                        <a href="{{url('/contact/add')}}" class="nav-link nav-toggle">
                            <i class="icon-users"></i>
                            <span class="title">New Contact</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END SIDEBAR -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="{{url('/contact/add')}}">New Contact</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Add</span>
                            </li>
                        </ul>

                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h1 class="page-title"> Add New Contact
                    </h1>
                    <div class="tab-pane" id="tab_2">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>New Contact</div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form enctype="multipart/form-data" action="{{route('newcontact')}}" method="post" class="form-horizontal">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" class="form-control" placeholder="Enter Contact Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label class="control-label col-md-3">Phone</label>
                                                    <div class="col-md-9">
                                                        <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Email</label>
                                                    <div class="col-md-9">
                                                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Photo</label>
                                                    <div class="col-md-9">
                                                        <input type="file" name="photo" class="form-control" accept="image/png, image/jpeg" > </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" name="submit" class="btn green">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                @if($errors->any())
                                                    <h4 style="color: green;">{{$errors->first()}}</h4>
                                                @endif </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner"> 2021 @ copyright
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>

            <div class="quick-nav-overlay"></div>
        </div>
    </div>


@endsection
