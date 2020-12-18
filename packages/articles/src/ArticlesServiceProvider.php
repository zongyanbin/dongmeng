<?php
namespace Addons\Articles;
use Illuminate\Support\ServiceProvider;
use Addons\Articles\Repository\Contract\CategoryRepository;
use Addons\Articles\Repository\Eloquent\CategoryRepositoryEloquent;


class ArticlesServiceProvider extends ServiceProvider
{
    /**
     * 服务容器抽象到具体
     *
     */
     public $bindings = [
       CategoryRepository::class => CategoryRepositoryEloquent::class
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
     * 初始化
     * @return void
     */
    public function boot()
    {
           //数据迁移 
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
