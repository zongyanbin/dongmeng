<?php
namespace Rbac\Permission\Traits;
/**
 * 
 */
trait Rbac
{
       /**
        * 是否具备那个角色
        *
        * @param [type] $role
        * @return boolean
        */ 
       public function hasRole($role)
       {
            //判断用户是否有权限
            $roles = $this->roleSlugs();

            $roleArr = explode('|',$role);
            //用户的角色，和传参过来的角色 进行取交集是true 具备这个权限
            return !empty(array_intersect($roleArr,$roles));
       } 

       /**
        * 是否拥有那个权限
        *
        * @param [type] $permission
        * @return boolean
        */
       public function canDo($permission)
       {
        
           $roles = $this->roles()->get();
           
           $permissions = [];
           //找出用户角色，根据角色把权限找出来，最后通过权限和传参operation权限进行取交集
           foreach($roles as $role){
               $permissions = array_merge($permissions,$role->permissionSlugs());
           }

           //拿到用户所有具备权限
           $permissions = array_unique($permissions);//去重

           $permissionArr = explode('|',$permission);
            
           //str1 传过来参数，str2拿到的参数
           return !empty(array_intersect($permissionArr,$permissions));
       }
}

?>