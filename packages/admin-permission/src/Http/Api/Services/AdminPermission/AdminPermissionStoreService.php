<?php
namespace Rbac\Permission\Http\Api\Services\AdminPermission;

use Rbac\Permission\Repository\Contract\AdminPermissionRepository;
use Rbac\Permission\Requests\AdminPermission\StoreAdminPermissionRequest;

class AdminPermissionStoreService
{
    protected $request;
    protected $repository;
    public function __construct(StoreAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;    
    }

    public function save()
    {
        $this->request->validated();
        return $this->repository->create($this->request->input());
    }
}
?>