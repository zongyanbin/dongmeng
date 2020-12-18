<?php

//namespace App\Models;
namespace Rbac\Permission\Models;
use Illuminate\Database\Eloquent\Model;
use Rbac\Permission\ArrayHelper;

class AdminUser extends Model
{
    protected $table = "admin_users"; //指定模型关联的表
    protected $fillable = ['username','password','name','mobile','remark'];// 对数据进行批量赋值需要定义fillable属性
    
    /**
     * 用户和角色就是多对多的关心
     * 用于对角色，就是多对多感念
    *某个用户会有多个角色
    *某个角色可能被多个用户所拥有的

    * 角色：        AdminRole::class
    * table关系表： admin_role_users
    * 用户表：      user_id
    *角色表：       role_id
     */
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'admin_role_users','user_id','role_id')
        ->withTimestamps();
         
    }
    //获取slug
    public function roleSlugs()
    {
       return ArrayHelper::getColumnAsArray($this->roles()->get(),'slug');
    }
}
