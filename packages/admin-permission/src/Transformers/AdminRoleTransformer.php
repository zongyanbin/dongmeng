<?php
namespace Rbac\Permission\Transformers;

use League\Fractal\TransformerAbstract;
use Rbac\Permission\ArrayHelper;
use Rbac\Permission\Models\AdminRole;

class AdminRoleTransformer extends TransformerAbstract
{
    public function transform(AdminRole $item)
    {
        return [
            'id'=>$item->id,
            'name'=>$item->name,
            'slug'=>$item->slug,
            'description'=>$item->description,
            'permissions'=>ArrayHelper::getColumnAsArray($item->permissions()->get(),"id")
        ];
    }
}
?>