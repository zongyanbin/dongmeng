<?php
namespace Addons\Articles\Http\Api\Services\Article;

use Addons\Articles\Http\Api\Base\AbstractSearchService;
use Addons\Articles\Repository\Contracts\ArticleRepository;
use Addons\Articles\Repository\Criteria\ArticleSearchCriteria;
use Addons\Articles\Requests\Article\SearchArticleRequest;

class ArticleSearchService extends AbstractSearchService
{
  /**
   * @var SearchArticleRequest $request
   */
  protected $request;
  protected $repository;

  public function __construct(SearchArticleRequest $request, ArticleRepository $repository)
  {
    $this->request = $request;
    $this->repository = $repository;
  }

  protected function getSearchCriteriaClassName(): string
  {
    ArticleSearchCriteria::class;
  }

  public function getOrConditionFields(): array
  {
    return [
      'title'
    ];
  }

  protected function getAndConditionFields(): array
  {
    return [];
  }
}

?>