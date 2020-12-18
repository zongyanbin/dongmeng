<?php
namespace Rbac\Permission\Http\Api\Services\AdminMenu;

use Rbac\Permission\Repository\Contract\AdminMenuRepository;
use Rbac\Permission\Requests\AdminMenu\StoreAdminMenuRequest;

class AdminMenuStoreService
{
    protected $request;
    protected $repository;
    public function __construct(StoreAdminMenuRequest $request, AdminMenuRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function save()
    {
        $this->request->validated();
        $menu = $this->repository->create($this->request->except('roles'));
        $menu->roles()->attach($this->request->input('roles'));
        return $menu;
    }
}
?>