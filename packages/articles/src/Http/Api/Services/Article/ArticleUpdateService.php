<?php
namespace Addons\Articles\Http\Api\Services\Article;

use Addons\Articles\Repository\Contract\ArticleRepository;
use Addons\Articles\Requests\Article\UpdateArticleRequest;

class ArticleUpdateService
{
  /**
   *
   * @var UpdateArticleRequest $request
   */
  protected $request;

  /**
   *
   * @var ArticleRepository $repository
   */
  protected $repository;

  public function __construct(UpdateArticleRequest $request, ArticleRepository $repository)
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