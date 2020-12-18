<?php
namespace Rbac\Permission\Http\Api\Services\AdminPermission;
use Rbac\Permission\Http\Api\Base\AbstractSearchService;
use Rbac\Permission\Repository\Contract\AdminPermissionRepository;
use Rbac\Permission\Repository\Criteria\AdminPermissionSearchCriteria;
use Rbac\Permission\Requests\AdminPermission\SearchAdminPermissionRequest;

class AdminPermissionSearchService extends AbstractSearchService
{
    protected $request;
    protected $repository;
    public function __construct(SearchAdminPermissionRequest $request, AdminPermissionRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    protected function getSearchCriteriaClassName(): string
    {
        return AdminPermissionSearchCriteria::class;
    }

    protected function getOrConditionFields(): array
    {
        return [
            'name'
        ];
    }

    protected function getAndConditionFields(): array
    {
        return [];
    }
}
?>