<?php
namespace Rbac\Permission\Transformers;

use League\Fractal\TransformerAbstract;
use Rbac\Permission\ArrayHelper;

class AdminMenuTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform($item)
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'icon' => $item->icon,
            'path' => $item->path,
            'parent_id' => $item->parent_id,
            'children' => $item->children->map(function ($item) {
                return array_merge($item->toArray(),[
                    'path' => $item->path,
                    'roles' => ArrayHelper::getColumnAsArray($item->roles()->get(), "id"),
                    'roleSlugs' => ArrayHelper::getColumnAsArray($item->roles()->get(), "slug"),
                ]) ;
            }),
            'hasChildren' => $item->child()->exists(),
            'roles' => ArrayHelper::getColumnAsArray($item->roles()->get(), "id"),
            'roleSlugs' => ArrayHelper::getColumnAsArray($item->roles()->get(), "slug"),
        ];
    }
}

?>