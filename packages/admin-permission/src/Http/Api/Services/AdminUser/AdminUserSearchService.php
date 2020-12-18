<?php
namespace Rbac\Permission\Http\Api\Services\AdminUser;

use Rbac\Permission\Http\Api\Base\AbstractSearchService;
use Rbac\Permission\Repository\Contract\AdminUserRepository;
use Rbac\Permission\Repository\Criteria\AdminUserSearchCriteria;
use Rbac\Permission\Requests\AdminUser\SearchAdminUserRequest;

/**
 * AdminUserSearchService class
 */
class AdminUserSearchService extends AbstractSearchService
{
    /**
     *  SearchAdminUserRequest $request
     */
    protected $request;  // services 依赖这个request请求
    /**
     * AdminUserRepository $repository
     */
    protected $repository; //还依赖这个仓储repository  
    //为什么要一脸这个仓储repository 
    //因为我们这个服务他最终根据这个请求拿到这个数据,在仓储里repository 对这个数据进行保存save

    //我们通过类型提示和依赖注入我们需要的 $request  $repository
    public function __construct(SearchAdminUserRequest $request,AdminUserRepository $repository)
    {
        # 这样就实现了一个依赖的注意
        $this->request = $request;
        $this->repository = $repository;
    }

    protected function getSearchCriteriaClassName(): string
    {
         return AdminUserSearchCriteria::class;
    }

    protected function getOrConditionFields(): array
    {
        return [
            'username',
            'name'
        ];
    }

    protected function getAndConditionFields(): array
    {
        return [];
    }

}
?>