<?php
namespace Addons\Articles\Transformers;

use Addons\Articles\Models\Category;
use League\Fractal\TransformerAbstract;
class CategoryTransformer extends TransformerAbstract
{
  public function transform(Category $item)
  {
    return [
      'id'=>$item->id,
      'title'=>$item->title,
      'name'=>$item->name,
      'description'=>$item->description,
      'pid'=>$item->pid,
      'children'=> $item->children->map(function ($item){
        return array_merge($item->toArray(),[
          'path' => $item->path
        ]);
      }),
      'hasChildren' => $item->child()->exists(),
      'level'=>$item->level,
      'sort'=>$item->sort,
      'status'=>$item->status,
      'created_at'=>$item->created_at,
      'updated_at'=>$item->updated_at
    ];
  }
}
?>