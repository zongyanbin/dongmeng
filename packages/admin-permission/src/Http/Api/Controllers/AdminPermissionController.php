<?php

//namespace App\Http\Controllers;
namespace Rbac\Permission\Http\Api\Controllers;
use Illuminate\Http\Request;
use Rbac\Permission\Http\Api\Base\Controller;
use Rbac\Permission\Http\Api\Services\AdminPermission\AdminPermissionDeleteService;
use Rbac\Permission\Http\Api\Services\AdminPermission\AdminPermissionStoreService;
use Rbac\Permission\Http\Api\Services\AdminPermission\AdminPermissionUpdateService;
use Rbac\Permission\Http\Api\Services\AdminPermission\AdminPermissionSearchService;
use Rbac\Permission\Http\Api\Services\AdminPermission\AdminPermissionShowService;
use Rbac\Permission\Requests\AdminPermission\StoreAdminPermissionRequest;
use Rbac\Permission\Transformers\AdminPermissionTransformer;

class AdminPermissionController extends Controller
{

     protected $transformer;
     public function __construct(AdminPermissionTransformer $transformer)
     {
         $this->transformer =$transformer;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminPermissionSearchService $service)
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
    public function store(AdminPermissionStoreService $services)
    {
        return $this->response->item($services->save(),$this->transformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdminPermissionShowService $service, $id)
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
    public function update(AdminPermissionUpdateService $service, $id)
    {
        return $this->response->item($service->update($id), $this->transformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminPermissionDeleteService $service, $id)
    {
        $service->delete($id);
    }
}
