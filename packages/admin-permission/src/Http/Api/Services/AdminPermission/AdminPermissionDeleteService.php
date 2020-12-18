<?php
namespace Rbac\Permission\Http\Api\Services\AdminPermission;

use Rbac\Permission\Repository\Contract\AdminPermissionRepository;
use Rbac\Permission\Requests\AdminPermission\DeleteAdminPermissionRequest;

class AdminPermissionDeleteService
{
    protected $request;
    protected $repository;
    public function __construct(DeleteAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $this->request->validated();
        return $this->repository->delete($id);
    }
}
?>