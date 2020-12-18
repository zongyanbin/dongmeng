<?php
namespace Rbac\Permission;

use Illuminate\Support\Collection;

class ArrayHelper
{
    /**
     * Undocumented function
     *
     * @param Collection $collection  集合对象
     * @param [type] $column 获取字段名称
     * @return void
     */
    public static function getColumnAsArray(Collection $collection,$column)
    {
         //array_reduce 循环遍历某一个数组的每一项 最终返回一个单一的值 
         //第一个参数 ：$collection->toArray() 给一个数组 
         //第二个参数 ： 然后定义一个function 第一个参数就是单一的值$carry,每次执行完就会带到下一次
         //iten 需要遍历项
         //第三个参数 ：[]空数组，初始数据
        return array_reduce($collection->toArray(),function($carry,$item) use($column){
            $carry[] = $item[$column];  //给$carry赋值
            return $carry;
        },[]);
    }

    public static function traverseMenu(array $menus, array &$result, $pid = 0)
    {
        foreach ($menus as $child_menu) {
            if ($child_menu['parent_id'] == $pid) {
                $item = ['value' => $child_menu['id'], 'label' => $child_menu['title'], 'children' => []];
                self::traverseMenu($menus, $item['children'], $child_menu['id']);
                $result[] = $item;
            } else {
                continue;
            }
        }
    }
}
?>