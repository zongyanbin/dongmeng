<?php
namespace Addons\Articles\Http\Api\Base;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

abstract class AbstractCriteria implements CriteriaInterface
{
  protected $orConditions;
  protected $andConditions;
  protected $orders;
  //数据填充
  public function __construct($orConditions = [], $andConditions = [], $orders)
  {
    $this->orConditions = $orConditions;
    $this->andConditions = $andConditions;
    $this->orders = $orders;
  }
  // 告诉 repository  怎么进行数据查找
  public function apply($model, RepositoryInterface $repository)
  {
    //这里可以加表关联查询
    $tableName = $model->getTable();
    foreach($this->andConditions as $field=>$condition){
      $model = $model->where($tableName . "." . $field, $condition);
    }
    $model = $model->where(function ($query) use ($tableName){
      foreach($this->orConditions as $field=>$condition){
        $query->orWhere($tableName.".".$field,'like' ,"%$condition%");
        
      }
    });
    $model = $this->order($model, $tableName);
    return $model;
  }

  protected function order($model, $tableName)
  {
    foreach($this->orders as $field => $order){
      $model = $model->orderBy($tableName . '.' . $field, $order);
    }
    return $model;
  }
}
?>