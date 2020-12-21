<?php
namespace Addons\Articles\Http\Api\Services\Article;

use Addons\Articles\Repository\Contract\ArticleRepository;
use Addons\Articles\Requests\Article\SearchArticleRequest;

class ArticleShowService
{
  protected $request;
  protected $repository;
  
  public function __construct(SearchArticleRequest$request, ArticleRepository $repository)
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