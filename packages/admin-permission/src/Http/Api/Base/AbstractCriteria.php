<?php
namespace Rbac\Permission\Http\Api\Base;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
/**
 * 定义abstractCriteria
 * AbstractCriteria抽象类去实现CriteriaInterface
 */
abstract class AbstractCriteria implements CriteriaInterface
{
    protected $orConditions;
    protected $andConditions;
    protected $orders;
    /**
     * 数据填充
     *
     * @param array $orConditions
     * @param array $andConditions
     * @param [type] $orders
     */
    public function __construct($orConditions = [], $andConditions = [], $orders = [])
    {
        $this->orConditions = $orConditions;
        $this->andConditions = $andConditions;
        $this->orders = $orders;
    }


    /**
     * 数据的查询
     *
     * @param [type] $model
     * @param RepositoryInterface $repository 怎么进行数据查找
     * @return void
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $tableName = $model->getTable(); //获取表名作为字段前缀
            /**
             * 关联查询 暂不实现
             */
            //and查询
            foreach ($this->andConditions as $field => $condition)
            {
                $model = $model->where($tableName . "." . $field, $condition);
            }
            //or查询
            $model = $model->where(function ($query) use ($tableName) {
                foreach ($this->orConditions as $field => $condition) {
                    $query->orWhere($tableName . "." . $field, 'like', "%$condition%");
                }
            });

            //排序
            $model = $this->order($model, $tableName);
            return $model;
    }

    /**
     * order排序方法
     *
     * @param [type] $model
     * @param [type] $tableName
     * @return void
     */
    protected function order($model, $tableName)
    {
        foreach ($this->orders as $field => $order) {
            $model = $model->orderBy($tableName . '.' . $field, $order);
        }
        return $model;
    }
}
?>