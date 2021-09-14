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
                    <li class="nav-item start active open ">
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
                    <li class="nav-item  ">
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
                                <a href="{{url('/contact')}}">Contacts</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Table</span>
                            </li>
                        </ul>

                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h1 class="page-title"> Contact Dashboard
                    </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Contact Table </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                        <tr>
                                            <th > id </th>
                                            <th > name</th>
                                            <th> phone </th>
                                            <th > email </th>
                                            <th > photo </th>
                                            <th > Delete </th>
                                            <th> Edit </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contacts as $mycontact)
                                            <tr>
                                                <td> {{$mycontact->id}} </td>
                                                <td> {{$mycontact->name}} </td>
                                                <td> {{$mycontact->phone}} </td>
                                                <td> {{$mycontact->email}} </td>
                                                <td> {{$mycontact->photo}} </td>
                                                <td><a href="/contact/delete/{{$mycontact->id}}" style="color: red" class="remove">Delete </a></td>
                                                <td><a href="/contact/edit/{{$mycontact->id}}" style="color:green" class="remove">Edit </a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
