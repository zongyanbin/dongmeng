<?php
namespace Addons\Articles\Http\Api\Services\Category;

use Addons\Articles\Models\Category;
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
     $hasChildren=$this->hasChildren($id);
     if($hasChildren['status_code']=='-1') return $hasChildren;
     return $this->repository->delete($id);
   }

   public function hasChildren($id)
   {
    $category = Category::with('children')->find($id);
    if($category){
      $res = $category->children->toArray();
       if(count($res)>=1){
          return [
            'status_code'=>-1,
            'message'=>'请先删除子栏目'
          ];
       }
    }
   }
}
?>