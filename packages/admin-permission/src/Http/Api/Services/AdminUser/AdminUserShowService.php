<?php
namespace Rbac\Permission\Http\Api\Services\AdminUser;
use Rbac\Permission\Repository\Contract\AdminUserRepository;
use Rbac\Permission\Requests\AdminUser\ShowAdminUserRequest;

class AdminUserShowService
{
    /**
     *  ShowAdminUserRequest $request
     */
    protected $request;  // services 依赖这个request请求
    /**
     * AdminUserRepository $repository
     */
    protected $repository; //还依赖这个仓储repository  
    //为什么要一脸这个仓储repository 
    //因为我们这个服务他最终根据这个请求拿到这个数据,在仓储里repository 对这个数据进行保存save

    //我们通过类型提示和依赖注入我们需要的 $request  $repository
    public function __construct(ShowAdminUserRequest $request,AdminUserRepository $repository)
    {
        # 这样就实现了一个依赖的注意
        $this->request = $request;
        $this->repository = $repository;
    }

    //这个时候我们就可以去使用了
    //这个服务我们拿过来是怎样使用
    //主要用于保存 
    public function show($id)
    {
        #第一步，  数据进行检查
        //检测是否有问题
        $this->request->validated();
        //create里有需要保存的数据
        //roleIds保存到关系表里
       return  $user = $this->repository->find($id); 
    }
}
?>