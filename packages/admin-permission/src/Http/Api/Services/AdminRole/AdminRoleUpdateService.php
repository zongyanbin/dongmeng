<?php
namespace Rbac\Permission\Http\Api\Services\AdminRole;

use Rbac\Permission\Repository\Contract\AdminRoleRepository;
use Rbac\Permission\Requests\AdminRole\UpdateAdminRoleRequest;

class AdminRoleUpdateService
{
    protected $request;
    protected $repository;
    
    public function __construct(UpdateAdminRoleRequest $request,AdminRoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function update($id)
    {
        $this->request->validated();
        $role = $this->repository->update($this->request->input(),$id);
        $permissions = $this->request->input('permissions');
        $role->permissions()->detach();//对原有权限进行解绑
        $role->permissions()->attach($permissions); //完成角色绑定， 角色和权限的绑定
        return $role;
    }
}
?>