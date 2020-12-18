<?php

//namespace App\Http\Controllers;
namespace Rbac\Permission\Http\Api\Controllers;
use Illuminate\Http\Request;
use Rbac\Permission\Http\Api\Base\Controller;
use Rbac\Permission\Http\Api\Services\AdminRole\AdminRoleDeleteService;
use Rbac\Permission\Http\Api\Services\AdminRole\AdminRoleSearchService;
use Rbac\Permission\Http\Api\Services\AdminRole\AdminRoleShowService;
use Rbac\Permission\Http\Api\Services\AdminRole\AdminRoleStoreService;
use Rbac\Permission\Http\Api\Services\AdminRole\AdminRoleUpdateService;
use Rbac\Permission\Transformers\AdminRoleTransformer;

class AdminRoleController extends Controller
{

    protected $transformer;

    public function __construct(AdminRoleTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminRoleSearchService $service)
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRoleStoreService $service)
    {

        return $this->response->item($service->save(),$this->transformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdminRoleShowService $service,$id)
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
     * @param  AdminRoleUpdateService $service
     * @param  int  $id
     * @return \dingo\api\Http\Response
     */
    public function update(AdminRoleUpdateService $service, $id)
    {
        return $this->response->item($service->update($id),$this->transformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminRoleDeleteService $service, $id)
    {
         $service->delete($id);
    }
}
