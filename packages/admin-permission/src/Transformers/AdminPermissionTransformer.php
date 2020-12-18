<?php
namespace Rbac\Permission\Transformers;

use League\Fractal\TransformerAbstract;
use Rbac\Permission\ArrayHelper;
use Rbac\Permission\Models\AdminPermission;
class AdminPermissionTransformer extends TransformerAbstract
{
    public function transform(AdminPermission $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'slug' => $item->slug,
            'description' => $item->description,
            'roles' => ArrayHelper::getColumnAsArray($item->roles()->get(), "id"),
        ];
    }
}
?>