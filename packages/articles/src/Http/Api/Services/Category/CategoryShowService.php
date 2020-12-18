<?php
namespace Addons\Articles\Http\Api\Services\Category;

use Addons\Articles\Repository\Contract\CategoryRepository;
use Addons\Articles\Requests\Category\ShowCategoryRequest;
class CategoryShowService
{
  /**
   * Undocumented variable
   *
   * @var ShowCategoryRequest $request
   */
  protected $request;
  /**
   * Undocumented variable
   *
   * @var CategoryRepository $repository
   */
  protected $repository;

  public function __construct(ShowCategoryRequest $request, CategoryRepository $repository)
  {
    $this->request = $request;
    $this->repository = $repository;
  }

  public function show($id)
  {
    $this->request->validated();
    return $this->repository->find($id);
  }
}
?>