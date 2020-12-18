<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->comment('分类名称');
            $table->string('name', 100)->comment('分类标识');
            $table->string('description', 255)->nullable()->comment('分类描述');
            $table->integer('pid')->default(0)->comment('分类id');
            $table->integer('level')->default(1)->comment('分类层级');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('status')->default(1)->comment('状态：0-禁用，1-正常');
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
        Schema::dropIfExists('categories');
    }
}
