<?php

//namespace App\Providers;
namespace Rbac\Permission;
use Illuminate\Support\ServiceProvider;
use Rbac\Permission\Http\Api\Middleware\RbacAuthenticate;
use Rbac\Permission\Repository\Contract\AdminMenuRepository;
use Rbac\Permission\Repository\Contract\AdminPermissionRepository;
use Rbac\Permission\Repository\Contract\AdminRoleRepository;
use Rbac\Permission\Repository\Eloquent\AdminRoleRepositoryEloquent;
use Rbac\Permission\Repository\Contract\AdminUserRepository;
use Rbac\Permission\Repository\Eloquent\AdminMenuRepositoryEloquent;
use Rbac\Permission\Repository\Eloquent\AdminPermissionRepositoryEloquent;
use Rbac\Permission\Repository\Eloquent\AdminUserRepositoryEloquent;

class PermissionServiceProvider extends ServiceProvider
{
    //定义中间件
    protected $middlewareAliases=[
        'rbac.auth' => RbacAuthenticate::class
    ];

    //注册中间件
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';

        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }

    public $bindings = [
      //服务容器抽象到具体
      AdminUserRepository::class=>AdminUserRepositoryEloquent::class,
      AdminRoleRepository::class=>AdminRoleRepositoryEloquent::class,
      AdminPermissionRepository::class=>AdminPermissionRepositoryEloquent::class,
      AdminMenuRepository::class=>AdminMenuRepositoryEloquent::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //数据迁移 
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //加载路由
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->aliasMiddleware();
    }
}
