<?php
namespace Rbac\Permission\Http\Api\Services\AdminPermission;

use Rbac\Permission\Repository\Contract\AdminPermissionRepository;
use Rbac\Permission\Requests\AdminPermission\ShowAdminPermissionRequest;

class AdminPermissionShowService
{
    protected $request;
    protected $repository;
    public function __construct(ShowAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function show($id)
    {
        $this->request->validated();
        return $this->repository->find($id);
    }

}
?>