<?php
namespace Rbac\Permission\Http\Api\Services\AdminMenu;

use Rbac\Permission\Repository\Contract\AdminMenuRepository;
use Rbac\Permission\Requests\AdminMenu\UpdateAdminMenuRequest;

class AdminMenuUpateService
{
    protected $request;
    protected $repository;
    public function __construct(UpdateAdminMenuRequest $request, AdminMenuRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function update($id)
    {
        $this->request->validated();
        $menu = $this->repository->update($this->request->input(),$id);
        $menu->roles()->detach();
        $menu->roles()->attach($this->request->input('roles'));
        return $menu;
    }
}
?>