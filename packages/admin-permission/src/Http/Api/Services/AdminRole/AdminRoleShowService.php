<?php
namespace Rbac\Permission\Http\Api\Services\AdminRole;

use Rbac\Permission\Repository\Contract\AdminRoleRepository;
use Rbac\Permission\Requests\AdminRole\ShowAdminRoleRequest;

class AdminRoleShowService
{
    protected $reuqest;
    protected $repository;

    public function __construct(ShowAdminRoleRequest $reuqest, AdminRoleRepository $repository)
    {
        $this->request = $reuqest;
        $this->repository = $repository;
    }

    public function show($id)
    {
        $this->request->validated();
        return $this->repository->find($id);
    }
}

?>