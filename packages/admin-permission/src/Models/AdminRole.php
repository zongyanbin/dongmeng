<?php

//namespace App\Models;
namespace Rbac\Permission\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rbac\Permission\ArrayHelper;

class AdminRole extends Model
{
    use HasFactory;
    protected $table = "admin_roles"; //指定模型关联的表
    protected $fillable = ['name','slug','description'];// 对数据进行批量赋值需要定义fillable属性

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, "admin_role_permissions", "role_id", "permission_id")->withTimestamps();
    }
 
    //获取slug
    public function permissionSlugs()
    {
       return ArrayHelper::getColumnAsArray($this->permissions()->get(),'slug');
    }
}
