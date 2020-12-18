<?php
namespace Rbac\Permission\Http\Api\Services\AdminRole;
use Rbac\Permission\Requests\AdminRole\StoreAdminRoleRequest;
use Rbac\Permission\Repository\Contract\AdminRoleRepository;
class AdminRoleStoreService
{
     /*
     * @var StoreAdminRoleRequest
     */
    protected $request;
    /**
     * @var AdminRoleRepository
     */
    protected $repository;


    public function __construct(StoreAdminRoleRequest $request, AdminRoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function save()
    {

        $this->request->validated();
        $role = $this->repository->create($this->request->except('permissions'));//移除权限
        $role->permissions()->attach($this->request->input('permissions')); ////完成角色绑定， 角色和权限的绑定
        return $role;

    }
}
?>