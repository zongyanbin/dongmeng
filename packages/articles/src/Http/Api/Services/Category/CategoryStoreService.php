<?php
namespace Addons\Articles\Http\Api\Services\Category;

use Addons\Articles\Requests\Category\StoreCategoryRequest;
use Addons\Articles\Repository\Contract\CategoryRepository;

class CategoryStoreService
{
    /**
     * @var StoreCategoryRequest
     *
     * @var CategoryRepository
     */
    protected $request;
    protected $repository;

    /**
     * 依赖注入
     *
     * @param StoreCategoryRequest $request
     * @param CategoryRepository $repository
     */
    public function __construct(StoreCategoryRequest $request, CategoryRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function save()
    {
        $this->request->validated();
        $cate = $this->repository->create($this->request->input());
        return $cate;
    }
}
?>