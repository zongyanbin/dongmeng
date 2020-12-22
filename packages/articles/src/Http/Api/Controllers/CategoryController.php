<?php
namespace Addons\Articles\Http\Api\Controllers;
use Illuminate\Http\Request;
use Addons\Articles\Http\Api\Base\Controller;
use Addons\Articles\Http\Api\Services\Category\CategoryDeleteService;
use Addons\Articles\Http\Api\Services\Category\CategorySearchService;
use Addons\Articles\Http\Api\Services\Category\CategoryShowService;
use Addons\Articles\Http\Api\Services\Category\CategoryStoreService;
use Addons\Articles\Http\Api\Services\Category\CategoryUpdateService;
use Addons\Articles\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    protected $transformer;
 
    
    public function __construct( CategoryTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategorySearchService $service)
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
    public function store(CategoryStoreService $service)
    {
        return $this->response->item($service->save(),$this->transformer);      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryShowService $service, $id)
    {
        return $this->response->item($service->show($id), $this->transformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  CategoryUpdateService  $service
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateService $service, $id)
    {
        return $this->response->item($service->update($id),$this->transformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CategoryDeleteService $service
     * @param  int  $id
     * @return \dingo\api\Http\Response
     */
    public function destroy(CategoryDeleteService $service, $id)
    {
        $service->delete($id);
    }
}
