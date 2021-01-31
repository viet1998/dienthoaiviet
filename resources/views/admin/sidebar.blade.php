<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a class="logo" href="{{route('trangchu')}}"><img src="/image/logo/LOGO.png" alt="" width="150px" height="auto" /></a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> -->
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username">{{Auth::user()->full_name}} - 
                    @switch(Auth::user()->level)
                        @case(0) Khách Hàng @break
                        @case(1) Nhân Viên @break
                        @case(2) Quản Lý @break
                    @endswitch
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{route('dangxuat')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a @if(Route::currentRouteName()=='admin_dashboard') class="active" @endif href="{{route('admin_dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a @if(Route::currentRouteName()=='product.edit' || 
                    Route::currentRouteName()=='product.createvariant' || 
                    Route::currentRouteName()=='product.editvariant') class="active" @endif href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <ul class="sub">
                        
                        <li><a @if(Route::currentRouteName()=='product.index') class="active" @endif href="{{route('product.index')}}">Danh sách sản phẩm</a></li>
                        <li><a @if(Route::currentRouteName()=='productvariants') class="active" @endif href="{{route('productvariants')}}">Danh sách biến thể của sản phẩm</a></li>
                        <li><a @if(Route::currentRouteName()=='product.create') class="active" @endif href="{{route('product.create')}}">Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-pencil"></i>
                        <span>Quản lý bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="responsive_table.html">Danh Sách Tin Tức</a></li>
                        <li><a href="basic_table.html">Danh Sách Slide</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a @if(Route::currentRouteName()=='bill.edit') class="active" @endif href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a @if(Route::currentRouteName()=='bill.index') class="active" @endif href="{{route('bill.index')}}">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a @if(Route::currentRouteName()=='customer.edit') class="active" @endif href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý khách hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a @if(Route::currentRouteName()=='customer.index') class="active" @endif href="{{route('customer.index')}}">Danh sách khách hàng</a></li>
                        <!-- <li><a href="{{route('customer.create')}}">Thêm khách hàng</a></li> -->
                    </ul>
                </li>
                @if(Auth::user()->level==2)
                <li class="sub-menu">
                    <a @if(Route::currentRouteName()=='user.edit') class="active" @endif href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý tài khoản</span>
                    </a>
                    <ul class="sub">
                        <li><a @if(Route::currentRouteName()=='user.index') class="active" @endif href="{{route('user.index')}}">Danh sách tài khoản</a></li>
                        <li><a @if(Route::currentRouteName()=='user.create') class="active" @endif href="{{route('user.create')}}">Thêm tài khoản</a></li>
                    </ul>
                </li>
                @endif
                <li>
                    <a href="{{route('dangxuat')}}">
                        <i class="fa fa-user"></i>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->