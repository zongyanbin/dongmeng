<?php
namespace Addons\Articles\Http\Api\Services\Category;

use Addons\Articles\Repository\Contract\CategoryRepository;
use Addons\Articles\Requests\Category\UpdateCategoryRequest;

class CategoryUpdateService
{
  protected $request;
  protected $repository;

  public function __construct(UpdateCategoryRequest $request, CategoryRepository $repository)
  {
    $this->request = $request;
    $this->repository = $repository;
  }

  public function update($id)
  {
    $this->request->validated();
    return $this->repository->update($this->request->input(),$id);
  }
}
?>