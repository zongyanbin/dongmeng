<?php
namespace Rbac\Permission\Http\Api\Middleware;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class RbacAuthenticate
{

    use Helpers;
    /**
     * 
     */
    public const OPERATIONS=['is','isnt','can'];

    /**
     * handle function 确认是否放行
     *
     * @param Request $request
     * @param \Closure $next
     * @param [type] $level             验证等级  身份验证/权限验证
     * @param [type] $roleOrPermission  对应level的权限或者身份
     * @return void
     */
    public function handle(Request $request,\Closure $next,$level,$roleOrPermission)
    {
        $request->user(); //知道你是谁，就知道你的角色是怎样的
        //1.如果是按照角色来控制： leve 如果有这个样的角色就放行
        //2.对于某个接口权限来控制： 拿到user查看有哪些角色，这些角色下有哪些权限，是否包含这个权限，如果不包含这个权限也不能放行
        

        //如果level 不在数组里reurn 404
        if(!in_array($level,self::OPERATIONS))
        {
            $this->response->error('Invalid Rbac Level',404);
        }   
        if('is'==$level)
        {
            //判断用户是否有这样的角色，如果有$next($request)放行
            if($request->user()->hasRole($roleOrPermission))
            {
                return $next($request);
            }                
        }else if('isnt'==$level)
        {
            if(!$request->user()->hasRole($roleOrPermission)) 
            {
                return $next($request);
            }                
        }else{  //是否有这个权限：首先拿出这个用户的角色，在看角色对应的权限是什么有就放行

                if($request->user()->canDo($roleOrPermission))
                {
                    return $next($request);
                }                
             } 
             
        $this->response->error($this->getErrMessage($roleOrPermission),403);     
    }

    protected function getErrMessage($roleOrPermission)
    {
        return "该页面或者操作涉及权限：【slug：" . $roleOrPermission . "】，但是你未获得此权限，可能会造成部分功能无法使用或者操作被终止，请练习管理员解决。";
    }
}
?>