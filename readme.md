
# 关于elem点餐平台
## Day1
### 需求
#### 平台端
- 商家分类管理 
- 商家管理 
- 商家审核
#### 商户端
- 商家注册
#### 要求
- 商家注册时，同步填写商家信息，商家账号和密码 
- 商家注册后，需要平台审核通过，账号才能使用 
- 平台可以直接添加商家信息和账户，默认已审核通过
### 设计要点
- composer create-project --prefer-dist laravel/laravel ele "5.5.*" -vvv
- 创建表 php artisan make:model Models/ShopCategory -m
- 创建 控制器 php artisan make:controller Admin/ShopCategoryController
- 路由需要分组
```php
//平台
Route::domain('admin.ele.com')->namespace('Admin')->group(function () {
    //店铺分类
    Route::get('shop_category/index',"ShopCategoryController@index");
});
//商户
Route::domain('shop.ele.com')->namespace('Shop')->group(function () {
    Route::get('user/reg',"UserController@reg");
    Route::get('user/index',"UserController@index");
});
```
- 店铺分类表shop_categories
- 商家信息表shops
- 商户注册表users
#### 上传github
- 第一次需要初始化
- 以后每次需要先提交到本地
- 再推送到github
### 要点难点及解决方案
- 问题已解决
## Day2
### 任务
- 完善day1的功能，使用事务保证商家信息和账号同时注册成功
- 平台：平台管理员账号管理
- 平台：管理员登录和注销功能，修改个人密码(参考微信修改密码功能)
- 平台：商户账号管理，重置商户密码
- 商户端：商户登录和注销功能，修改个人密码
- 修改个人密码需要用到验证密码功能，[参考文档](https://laravel-china.org/docs/laravel/5.5/hashing)
- 商户登录正常登录，登录之后判断店铺状态是否为1，不为1不能做任何操作
### 设计要点
- 设置认证失败后回跳地址 在Exceptions/Handler.php后面添加
```php
/**
* 重写实现未认证用户跳转至相应登陆页
* @param \Illuminate\Http\Request $request
* @param AuthenticationException $exception
* @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
*/
protected function unauthenticated($request, AuthenticationException $exception)
{
//  return $request->expectsJson()
//      ? response()->json(['message' => $exception->getMessage()], 401)
//      : redirect()->guest(route('login'));
    if ($request->expectsJson()) {
        return response()->json(['message' => $exception->getMessage()], 401);
    } else {
        return in_array('admin', $exception->guards()) ? redirect()->guest('/admin/login') : redirect()->guest(route('user.login'));
    }
}
```
- 平台管理员表admins
### 要点难点及解决方案
- 问题已解决
## Day3
### 需求
#### 商户端 
- 菜品分类管理 
- 菜品管理 
#### 要求 
- 一个商户只能有且仅有一个默认菜品分类 
- 只能删除空菜品分类 
- 必须登录才能管理商户后台（使用中间件实现） 
- 可以按菜品分类显示该分类下的菜品列表 
- 可以根据条件（按菜品名称和价格区间）搜索菜品
### 设计要点
- 菜品分类表menu_categories
- 菜品表menus
### 要点难点及解决方案
- 菜品分类搜索显示菜品列表有点小问题，已解决 
## Day4
### 任务
#### 优化
- 将网站图片上传到阿里云OSS对象存储服务，以减轻服务器压力(https://github.com/jacobcyl/Aliyun-oss-storage) 
- 使用webuploder图片上传插件，提升用户上传图片体验
#### 平台端
- 平台活动管理（活动列表可按条件筛选 未开始/进行中/已结束 的活动） 
- 活动内容使用ueditor内容编辑器(https://github.com/overtrue/laravel-ueditor)
#### 商户端
- 查看平台活动（活动列表和活动详情） 
- 活动列表不显示已结束的活动
### 设计要点
- 活动表activities
### 要点难点及解决方案
- 编辑器回显，已解决
## Day5
### 开发任务
#### 接口开发 
- 商家列表接口(支持商家搜索) 
- 获取指定商家接口
### 设计要点
- 设置了两个接口：/api/shop/list 和 /api/shop/index
- 接口连接，显示各个店铺的信息
### 要点难点及解决方案
- 小问题，已解决
## Day6
### 开发任务
#### 接口开发 
- 用户注册 
- 用户登录 
- 发送短信
- 密码修改和重置密码接口 
#### 要求 
- 创建会员表 
- 短信验证码发送成功后，保存到redis，并设置有效期5分钟 
- 用户注册时，从redis取出验证码进行验证
### 设计要点
- 会员表members
### 要点难点及解决方案
- 验证码和重置密码有点小问题，已解决
## Day7
### 开发任务
#### 接口开发 
- 用户地址管理相关接口 
- 购物车相关接口
### 设计要点
- 用户地址表addresses
- 购物车表carts
### 要点难点及解决方案
- 购物车列表显示，已解决
## Day8
### 开发任务
#### 接口开发 
- 订单接口(使用事务保证订单和订单商品表同时写入成功) 
- 密码修改和重置密码接口
### 设计要点
- 订单表orders
- 订单商品表order_goods
### 要点难点及解决方案
- 订单列表显示不出来，已解决
## Day9
### 开发任务
#### 商户端 
- 订单管理[订单列表,查看订单,取消订单,发货] 
- 订单量统计[按日统计,按月统计,累计]（每日、每月、总计） 
- 菜品销量统计[按日统计,按月统计,累计]（每日、每月、总计） 
#### 平台 
- 订单量统计[按商家分别统计和整体统计]（每日、每月、总计） 
- 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计） 
- 会员管理[会员列表,查询会员,查看会员信息,禁用会员账号]
### 设计要点
- 所有开发任务都是用sql语句查询出来的
### 要点难点及解决方案
- 菜品销量统计[按商家分类统计]搜索显示有问题，已解决
## Day10
### 开发任务
#### 平台
- 权限管理 
- 角色管理[添加角色时,给角色关联权限] 
- 管理员管理[添加和修改管理员时,修改管理员的角色]
### 设计要点
##### RABC实现
- 安装 composer require spatie/laravel-permission -vvv
- 创建数据迁移 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
- 执行数据迁移 php artisan migrate
- 生成配置文件 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
- 在Admin模型中 use HasRoles
```php
//引入
use HasRoles;
protected $guard_name = 'admin';
//添加一个权限   权限名称必需是路由的名称  后面做权限判断
$per=Permission::create(['name'=>'shop.index','guard_name'=>'admin']);
//给角色添加权限
$role->syncPermissions($request->post('per'));
//判断当前角色有没有当前权限
$role->hasPermissionTo('权限名称');
//给用户对象添加角色 同步角色
$admin->syncRoles($request->post('role'));
//取出当前角色所拥有的所有权限
$role->permissions();
//判断当前用户有没有当前角色
$admin->hasRole('角色名称');
//取出当前用户所拥有的角色 要用json_encode
$admin->getRoleNames();
```
```html
{{--例如：视图页面显示--}}
{{str_replace(',',' | ',str_replace(['[',']','"'],'',json_encode($admin->getRoleNames(),JSON_UNESCAPED_UNICODE)))}}
```
- 判断权限 在E:\web\ele\app\Http\Controllers\Admin\BaseController.php 添加如下代码：
```php
//在这里判断用户有没有权限
$this->middleware(function ($request, Closure $next) {
    $admin = Auth::guard('admin')->user();
    //判断当前路由在不在这个数组里，不在的话才验证权限，在的话不验证，还可以根据排除用户ID为1
    if (!in_array(Route::currentRouteName(), ['admin.login', 'admin.logout']) && $admin->id !== 1) {
        //判断当前用户有没有权限访问 路由名称就是权限名称
        if ($admin->can(Route::currentRouteName()) === false) {
            /* echo view('admin.fuck');
            exit;*/
            //显示视图 不能用return 只能exit
            exit(view('admin.fuck'));
        }
    }
    return $next($request);
});
```
### 要点难点及解决方案
- 相对应用户的角色显示有问题，已解决