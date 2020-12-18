<?php
namespace Addons\Articles\Http\Api\Services\Article;

use Addons\Articles\Repository\Contracts\ArticleRepository;
use Addons\Articles\Requests\Article\StoreArticleRequest;

class ArticleStoreService
{
  /**
   * @var StoreArticleRequest $request
   */
  protected $request;

  /**
   * @var ArticleRepository $repository
   */
  protected $repository;

  /**
   * 依赖注入
   *
   * @param StoreArticleRequest $request
   * @param ArticleRepository $repository
   */
  public function __construct(StoreArticleRequest $request, ArticleRepository $repository)
  {
    $this->request = $request;
    $this->repository = $repository;
  }

  public function save()
  {
    $this->request->validated();
    $result = $this->repository->create($this->request->input());
    return $result;
  }
}
?>