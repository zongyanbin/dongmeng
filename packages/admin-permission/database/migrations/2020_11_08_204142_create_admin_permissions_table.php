<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name',60)->unique()->comment('权限名称'); //unique 权限名称是唯一不能重复
            $table->string('slug',100)->unique()->comment('权限标识');//unique 唯一
            $table->text('description');
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
        Schema::dropIfExists('admin_permissions');
    }
}
