<div class="page-header navbar navbar-fixed-top">

    <div class="page-header-inner ">

        <div class="page-logo">
            <a href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}</a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
            <span></span>
        </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif



                @else
                    <li class=" dropdown-user">
                        <a>
                            <img alt="" class="img-circle" width="30px" height="30px"
                                 src="{{ asset('storage/'.Auth::user()->photo) }}"/>
                            <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>

                        </a>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>
