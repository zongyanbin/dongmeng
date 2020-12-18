<?php

//namespace App\Models;
namespace Rbac\Permission\Models;
use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = "admin_permissions"; //指定模型关联的表
    protected $fillable = ['name','slug','description'];// 对数据进行批量赋值需要定义fillable属性

    public function roles()
    {
        //角色可以有多种权限
        return $this->belongsToMany(AdminRole::class, "admin_role_permissions", "permission_id", "role_id")->withTimestamps();
    }
  
}
