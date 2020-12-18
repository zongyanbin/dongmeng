<?php
namespace Rbac\Permission\Http\Api\Services\AdminRole;

use Rbac\Permission\Repository\Contract\AdminRoleRepository;
use Rbac\Permission\Requests\AdminRole\DeleteAdminRoleRequest;

class AdminRoleDeleteService
{
        protected $request;
        protected $repository;
        public function __construct(DeleteAdminRoleRequest $request, AdminRoleRepository $repository)
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