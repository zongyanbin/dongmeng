<?php
namespace Addons\Articles\Http\Api\Services\Article;

use Addons\Articles\Repository\Contract\CategoryRepository;
use Addons\Articles\Requests\Category\UpdateCategoryRequest;

class ArticleUpdateService
{
  /**
   *
   * @var UpdateCategoryRequest $request
   */
  protected $request;

  /**
   *
   * @var CategoryRepository
   */
  protected $repository;

  public function __construct(UpdateCategoryRequest $request, CategoryRepository $repository)
  {
    $this->request = $this->request;
    $this->repository = $this->repository;
  }

  public function update($id)
  {
    $this->request->validated();
    return $this->repository->update($this->request->input(),$id);
  }
}
?>