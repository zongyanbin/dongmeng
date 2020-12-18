<?php
namespace Rbac\Permission\Http\Api\Services\AdminMenu;

use Rbac\Permission\Repository\Contract\AdminMenuRepository;
use Rbac\Permission\Requests\AdminMenu\ShowAdminMenuRequest;

class AdminMenuShowService
{
    protected $request;
    protected $repository;


    public function __construct(ShowAdminMenuRequest $request, AdminMenuRepository $repository)
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