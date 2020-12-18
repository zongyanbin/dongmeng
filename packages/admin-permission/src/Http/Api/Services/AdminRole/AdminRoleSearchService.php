<?php
namespace Rbac\Permission\Http\Api\Services\AdminRole;

use Rbac\Permission\Http\Api\Base\AbstractSearchService;
use Rbac\Permission\Repository\Contract\AdminRoleRepository;
use Rbac\Permission\Repository\Criteria\AdminRoleSearchCriteria;
use Rbac\Permission\Requests\AdminRole\SearchAdminRoleRequest;
class AdminRoleSearchService extends AbstractSearchService
{
    protected $request;
    protected $repository;

    public function __construct(SearchAdminRoleRequest $request,AdminRoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }
    protected function getSearchCriteriaClassName(): string
    {
        return AdminRoleSearchCriteria::class;
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