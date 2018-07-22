<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="font-family: 华文行楷;font-size: 30px"> E le m</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a>
                </li>
                <li><a href="{{route('admin.index')}}">管理员</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">商家管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shop_category.index')}}">店铺分类</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('shop.index')}}">商家信息</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('users.index')}}">注册信息</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @auth("admin")
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('admin.modify')}}">修改个人密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('admin.logout')}}">注销</a></li>
                        </ul>
                    </li>
                @endauth
                @guest("admin")
                    <li><a href="{{route('admin.login')}}">登录</a></li>
                @endguest
            </ul>
            <form class="navbar-form navbar-right" method="get">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{isset($_GET['keyword'])?$_GET['keyword']:''}}"
                           class="form-control" placeholder="搜索...">
                </div>
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>