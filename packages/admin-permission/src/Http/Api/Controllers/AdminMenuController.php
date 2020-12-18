<?php
namespace Rbac\Permission\Http\Api\Controllers;
use Illuminate\Http\Request;
use Rbac\Permission\ArrayHelper;
use Rbac\Permission\Http\Api\Base\Controller;
use Rbac\Permission\Http\Api\Services\AdminMenu\AdminMenuDeleteService;
use Rbac\Permission\Http\Api\Services\AdminMenu\AdminMenuSearchService;
use Rbac\Permission\Http\Api\Services\AdminMenu\AdminMenuShowService;
use Rbac\Permission\Http\Api\Services\AdminMenu\AdminMenuStoreService;
use Rbac\Permission\Http\Api\Services\AdminMenu\AdminMenuUpateService;
use Rbac\Permission\Repository\Contract\AdminMenuRepository;
use Rbac\Permission\Transformers\AdminMenuTransformer;

class AdminMenuController extends Controller
{
    protected $transformer;

    public function __construct(AdminMenuTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminMenuSearchService $service)
    {       
        return $this->response->paginator($service->search(), $this->transformer);
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
    public function store(AdminMenuStoreService $service)
    {
        return $this->response->item($service->save(), $this->transformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdminMenuShowService $service, $id)
    {
        return $this->response->item($service->show($id), $this->transformer);
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
    public function update(AdminMenuUpateService $service, $id)
    {
        return $this->response->item($service->update($id),$this->transformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminMenuDeleteService $service,$id)
    {
        return $service->delete($id);
    }

    public function nodes(AdminMenuRepository $repository)
    {
        $result = [];
        $menus = $repository->all()->toArray();
        ArrayHelper::traverseMenu($menus, $result);
        return response()->json($result);
    }

    
}
