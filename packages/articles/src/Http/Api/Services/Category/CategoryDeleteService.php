<?php
namespace Addons\Articles\Http\Api\Services\Category;
use Addons\Articles\Repository\Contract\CategoryRepository;
use Addons\Articles\Requests\Category\DeleteCategoryRequest;

class CategoryDeleteService
{
   protected $request;
   protected $repository;
   public function __construct(DeleteCategoryRequest $request, CategoryRepository $repository)
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