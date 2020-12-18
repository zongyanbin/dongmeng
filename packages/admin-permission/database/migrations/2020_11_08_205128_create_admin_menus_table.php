<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //path路由的作用，对于某个菜单来说我们会根据patch来和前端的菜单进行合并
        //合并之后就把我们后端菜单跟角色的绑定关系映射到前端，从而是管理员展示能看到的页面
        //简单来说，总结下后端的菜单实际上可以把他理解成users他也是和角色进行绑定的
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('title',100)->comment('菜单标题');
            $table->string('path',100)->unique()->comment('路由');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_menus');
    }
}
