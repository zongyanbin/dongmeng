<?php
namespace Addons\Articles\Http\Api\Services\Category;

use Addons\Articles\Http\Api\Base\AbstractSearchService;
use Addons\Articles\Repository\Contract\CategoryRepository;
use Addons\Articles\Repository\Criteria\CategorySearchCriteria;
use Addons\Articles\Requests\Category\SearchCategoryRequest;

class CategorySearchService extends AbstractSearchService
{
  /**
   * @var SearchCategoryRequest
   */
  protected $request;
  /**
   * @var CategoryRepository
   */
  protected $repository;

  public function __construct(SearchCategoryRequest $request, CategoryRepository $repository)
  {
    $this->request = $request;
    $this->repository = $repository;
  }

  protected function getSearchCriteriaClassName(): string
  {
    return CategorySearchCriteria::class;
  }
  
  public function getOrConditionFields(): array
  {
    return [
      'title', 
      'name'
    ];
  }

  protected function getAndConditionFields(): array
  {
    return [];
  }
}
?>