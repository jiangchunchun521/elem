<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        @auth
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/dist/img/user.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                </div>
            </div>
        @endauth
        @guest
            <div class="user-panel">
                <a href="{{route('user.login')}}" style="margin-left: 30px">登录</a>
            </div>
    @endguest
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" style="text-align: center"> 导 航 栏</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-user-o"></i> <span>商家管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('user.reg')}}"><i class="fa fa-circle-o"></i> 商家注册</a></li>
                    <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> 注册信息</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-hourglass-half"></i> <span>菜品分类</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('menu_category.index')}}"><i class="fa fa-circle-o"></i> 分类列表</a></li>
                    <li><a href="{{route('menu_category.add')}}"><i class="fa fa-circle-o"></i> 添加分类</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-heartbeat"></i> <span>菜品管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i> 菜品列表</a></li>
                    <li><a href="{{route('menu.add')}}"><i class="fa fa-circle-o"></i> 添加菜品</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-snowflake-o"></i> <span>订单管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('order.index')}}"><i class="fa fa-circle-o"></i> 订单列表</a></li>
                    <li class="active"><a href="{{route('order.all')}}"><i class="fa fa-circle-o"></i> 订单量统计</a></li>
                    <li class="active"><a href="{{route('order.menu')}}"><i class="fa fa-circle-o"></i> 菜品销量统计</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>活动管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('activity.index')}}"><i class="fa fa-circle-o"></i> 活动列表</a></li>
                    <li class="active"><a href="{{route('event.index')}}"><i class="fa fa-circle-o"></i> 抽奖活动列表</a></li>
                    <li class="active"><a href="{{route('eventUser.index')}}"><i class="fa fa-circle-o"></i> 报名抽奖活动</a></li>
                    <li class="active"><a href="{{route('prize.index')}}"><i class="fa fa-circle-o"></i> 查看抽奖结果</a></li>
                </ul>
            </li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>