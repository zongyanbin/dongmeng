<?php

//namespace App\Models;
namespace Rbac\Permission\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    use HasFactory;
    protected $table = "admin_menus"; //指定模型关联的表
    protected $fillable = ['title','path','parent_id'];// 对数据进行批量赋值需要定义fillable属性

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, "admin_role_menus", "menu_id", "role_id")
            ->withTimestamps();
    }

    public function child()
    {
        return $this->hasMany(AdminMenu::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->child()->with('children');
    }
    
}
