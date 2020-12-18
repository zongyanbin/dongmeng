<?php

//namespace App\Http\Controllers;
namespace Rbac\Permission\Http\Api\Controllers;
use Illuminate\Http\Request;
use Rbac\Permission\Http\Api\Base\Controller;
use Rbac\Permission\Http\Api\Services\AdminUser\AdminUserSearchService;
use Rbac\Permission\Http\Api\Services\AdminUser\AdminUserStoreService;
use Rbac\Permission\Transformers\AdminUserTransformer;
use Dingo\Api\Http\Response\Factory;
use Rbac\Permission\Http\Api\Services\AdminUser\AdminUserDeleteService;
use Rbac\Permission\Http\Api\Services\AdminUser\AdminUserShowService;
use Rbac\Permission\Http\Api\Services\AdminUser\AdminUserUpdateService;

class AdminUserController extends Controller
{
    protected $transformer;
    
    public function __construct(AdminUserTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminUserSearchService $service)
    {
       return $this->response->paginator($service->search(),$this->transformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 11111;
        //
    }

    /**
     * Store a newly created resource in storage.
     * 依赖注入 AdminUserStoreService $service 
     * @param  AdminUserStoreService  $service
     */
    public function store(AdminUserStoreService $service)
    {
        //调用service 里的save() 返回$user $user返回给前端;
    //   $user = $service->save();
    //   dd($user);
      return $this->response->item($service->save(),new AdminUserTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUserShowService $service, $id)
    {
      return $this->response->item($service->show($id),$this->transformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserUpdateService $service, $id)
    {
        return $this->response->item($service->update($id),$this->transformer);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUserDeleteService $service,$id)
    {
        $result = $service->delete($id);
        if($result == 1){
            $result =  array([
                'status_code'=>'200',
                'message'=>'删除成功',
            ]);
           return  json_encode($result);
        }
    }
}
