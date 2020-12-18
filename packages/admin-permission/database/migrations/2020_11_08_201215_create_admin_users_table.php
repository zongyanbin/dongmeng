<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     * 执行迁移文件 up
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',30)->comment('用户名');
            $table->string('password',60)->comment('密码');
            $table->string('name',30)->comment('姓名');
            $table->string('mobile',20)->comment('手机号码');
            $table->text('remark')->comment('备注')->nullable();
            $table->string('avatar')->comment('头像')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *回滚 执行down
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
