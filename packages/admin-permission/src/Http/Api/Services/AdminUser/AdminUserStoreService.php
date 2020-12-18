<?php
namespace Rbac\Permission\Http\Api\Services\AdminUser;

use Rbac\Permission\Repository\Contract\AdminUserRepository;
use Rbac\Permission\Requests\AdminUser\StoreAdminUserRequest;

class AdminUserStoreService
{
    /**
     *  StoreAdminUserRequest $request
     */
    protected $request;  // services 依赖这个request请求
    /**
     * AdminUserRepository $repository
     */
    protected $repository; //还依赖这个仓储repository  
    //为什么要一脸这个仓储repository 
    //因为我们这个服务他最终根据这个请求拿到这个数据,在仓储里repository 对这个数据进行保存save

    //我们通过类型提示和依赖注入我们需要的 $request  $repository
    public function __construct(StoreAdminUserRequest $request,AdminUserRepository $repository)
    {
        # 这样就实现了一个依赖的注意
        $this->request = $request;
        $this->repository = $repository;
    }

    //这个时候我们就可以去使用了
    //这个服务我们拿过来是怎样使用
    //主要用于保存 
    public function save()
    {
        #第一步，  数据进行检查
        //检测是否有问题
        $this->request->validated();
        //create里有需要保存的数据
        //roleIds保存到关系表里
        $user = $this->repository->create($this->request->except('roleIds')); //except releIds 排除在外
        $user->roles()->attach($this->request->input('roleIds')); //完成用户绑定， 用户和角色的绑定
        return $user; 
        // 控制器最终调用这个save方法我们需要知道保存用户是什么样子的最终把用户交给Transformer
        //去返回响应字段给前端，想要那些字段在transformer里定义
    }
}
?>