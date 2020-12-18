<?php
namespace Rbac\Permission\Http\Api\Services\AdminPermission;

use Rbac\Permission\Repository\Contract\AdminPermissionRepository;
use Rbac\Permission\Requests\AdminPermission\UpdateAdminPermissionRequest;

class AdminPermissionUpdateService
{
    protected $request;
    protected $repository;
    
    public function __construct(UpdateAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }


    public function update($id)
    {
        $this->request->validated();
        return $this->repository->update($this->request->input(),$id);
    }
}

?>