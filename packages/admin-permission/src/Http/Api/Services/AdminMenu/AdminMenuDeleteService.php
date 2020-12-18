<?php
namespace Rbac\Permission\Http\Api\Services\AdminMenu;

use Rbac\Permission\Repository\Contract\AdminMenuRepository;
use Rbac\Permission\Requests\AdminMenu\DeleteAdminMenuRequest;

class AdminMenuDeleteService
{
    protected $request;
    protected $repository;
    public function __construct(DeleteAdminMenuRequest $request , AdminMenuRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $this->request->validated();
        $this->repository->delete($id);
    }
}
?>