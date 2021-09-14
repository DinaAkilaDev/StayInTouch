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
                <li class="nav-item start active open">
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
                <li class="nav-item  ">
                    <a href="{{url('/contact/add')}}" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">New Contact</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{url('/home')}}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>

            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title"> Admin Dashboard
            </h1>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$contact->count()}}">{{$contact->count()}}</span>
                            </div>
                            <div class="desc"> Contacts</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$events->count()}}">{{$events->count()}}</span>
                            </div>
                            <div class="desc">Events</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$users->count()}}">{{$users->count()}}</span>
                            </div>
                            <div class="desc">All Users</div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Contacts</span>
                            </div>
                        </div>
                        @foreach($contact as $mycontact)
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_comments_1">
                                        <div class="mt-comments">
                                            <div class="mt-comment">
                                                <div class="mt-comment-img">
                                                    <img width="50px" height="50px"
                                                         src="{{ asset('storage/'.$mycontact->photo) }}"/>
                                                </div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author">{{$mycontact->name}}</span>
                                                        <span
                                                            class="mt-comment-date">{{date('d-m-Y', strtotime($mycontact->created_at))}}</span>
                                                    </div>
                                                    <div class="mt-comment-text"> {{$mycontact->phone}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
{{--                        {{$contact->links()}}--}}
                    </div>

                </div>
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bubble font-dark hide"></i>
                                <span class="caption-subject font-hide bold uppercase">Users</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                @foreach($users as $myuser)
                                    <div class="col-md-6 " style="margin-bottom: 20px;">
                                        <div class="mt-widget-1 ">
                                            <div class="mt-img">
                                                <img width="100px" height="100px"
                                                     src="{{ asset('storage/'.$myuser->photo) }}">
                                            </div>
                                            <div class="mt-body">
                                                <h3 class="mt-username">{{$myuser->name}}</h3>
                                                <p class="mt-user-title">{{$myuser->email}} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            {{--                            {{$users->links()}}--}}
                        </div>
                    </div>

                </div>


                </div>


            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-directions font-green hide"></i>
                                <span class="caption-subject bold font-dark uppercase"> Events</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class=" mt-timeline-horizontal" data-spacing="60">
                                <br>
                                @foreach($events as $myevent)
                                    <div class=" events-content">
                                        <ol>
                                            <li class="selected" data-date="16/01/2014">
                                                <div class="mt-title">
                                                    <h2 class="mt-content-title">{{$myevent->name}}</h2>
                                                </div>
                                                <div class="mt-author">
                                                    <div class="mt-avatar">
                                                        @foreach($myevent->Contacts as $con)
                                                            <img width="420" height="345" src="{{ asset('storage/'.$con->photo) }}">
                                                        @endforeach
                                                    </div>
                                                    <div class="mt-author-name">
                                                        <a href="javascript:;" class="font-blue-madison">@foreach($myevent->Contacts as $con)
                                                                {{$con->name}}
                                                            @endforeach</a>
                                                    </div>
                                                    <div
                                                        class="mt-author-datetime font-grey-mint">{{date('d-m-Y', strtotime($myevent->date))}}</div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="mt-content border-grey-steel" style="text-align: center;">
                                                    <p>{{$myevent->text}}</p>
                                                    <iframe width="420" height="315"
                                                            src="{{$myevent->video}}">
                                                    </iframe>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>

                            @endforeach
                            {{--                                {{$events->links()}}--}}

                            <!-- .events-content -->
                            </div>
                        </div>
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



