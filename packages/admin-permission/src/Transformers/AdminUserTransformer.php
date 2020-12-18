<?php
namespace Rbac\Permission\Transformers;

use League\Fractal\TransformerAbstract;
use Rbac\Permission\ArrayHelper;
use Rbac\Permission\Models\AdminUser;

class AdminUserTransformer extends TransformerAbstract
{
    public function transform(AdminUser $item)
    {
        return [
            'id'=>$item->id,
            'username'=>$item->username,
            'name'=>$item->name,
            'mobile'=>$item->mobile,
            'remark'=>$item->remark,
            'avatar'=>$item->avatar,
            'roles'=>ArrayHelper::getColumnAsArray($item->roles()->get(),'slug'),
            'roleIds'=>ArrayHelper::getColumnAsArray($item->roles()->get(),'id')
        ];
    }


}
?>