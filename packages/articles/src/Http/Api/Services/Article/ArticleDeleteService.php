<?php
namespace Addons\Articles\Http\Api\Services\Article;

use Addons\Articles\Repository\Contract\ArticleRepository;
use Addons\Articles\Requests\Article\StoreArticleRequest;

class ArticleDeleteService
{
  /**
   * @var StoreArticleRequest $request
   */
  protected $request;

  /**
   * @var ArticleRepository $repository
   */
  protected $repository;

  public function __construct(StoreArticleRequest $request, ArticleRepository $repository)
  {
    $this->request = $request;
    $this->repository = $repository;  
  }

  public function delete($id)
  {
    $this->request->validated();
    return $this->repository->delete($id);
  }

}
?>