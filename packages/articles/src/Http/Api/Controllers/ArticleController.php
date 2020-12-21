<?php

namespace Addons\Articles\Http\Api\Controllers;

use Addons\Articles\Http\Api\Base\Controller;
use Addons\Articles\Http\Api\Services\Article\ArticleDeleteService;
use Addons\Articles\Http\Api\Services\Article\ArticleSearchService;
use Addons\Articles\Http\Api\Services\Article\ArticleShowService;
use Addons\Articles\Http\Api\Services\Article\ArticleStoreService;
use Addons\Articles\Http\Api\Services\Article\ArticleUpdateService;
use Addons\Articles\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $transformers;

    public function __construct(ArticleTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleSearchService $service)
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
    public function store(ArticleStoreService $service)
    {
        return $this->response->item($service->save(),$this->transformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleShowService $service, $id)
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
    public function update(ArticleUpdateService $service, $id)
    {
        return $this->response->item($service->update($id), $this->transformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleDeleteService $service,$id)
    {
        return $service->delete($id);
    }
}
