<?php
namespace Addons\Articles\Http\Api\Base;

use Illuminate\Foundation\Http\FormRequest;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
abstract class AbstractSearchService
{
  /**
   *
   * @var FormRequest 
   */
  protected $request;

  /**
   *
   * @var BaseRepository
   */
  protected $repository;

  protected $customCriteria = true;
  
  abstract protected function getSearchCriteriaClassName(): string;

  abstract protected function getOrConditionFields(): array;

  abstract protected function getAndConditionFields(): array;

  protected function getSearchKeywordName()
  {
    return 'keyword';
  }

  public function guard()
  {
    $this->request->validated(); 
  }
  public function search()
  {
    $this->guard();//1.验证请求
    $this->repository->pushCriteria($this->getSearchCriteria()); //2.传参自定义$this->getSearchCriteria()
    return $this->repository->paginate();//3.返回数据分页
  }

  protected function getSearchCriteria()
  {
    if($this->customCriteria){
      $className = $this->getSearchCriteriaClassName();  //抽象层到实现层
      return new $className($this->getOrconditions(), $this->getAndConditions(), $this->getOrders());
    }
    return app(RequestCriteria::class); //默认搜索
  }

  protected function getOrconditions()
  {
    return $this->request->filled($this->getSearchKeywordName()) ?
      array_fill_keys($this->getOrConditionFields(), $this->request->input($this->getSearchKeywordName()))
      : [];
  }

  protected function getAndConditions()
  {
    $arr_filter_null=array_filter($this->request->input(),function ($val){
      return !is_null($val);
    }); //前端传参提交

    $arr_filter_keys = array_fill_keys($this->getAndConditionFields(), ''); //自己组装
    return array_intersect_key($arr_filter_null,  $arr_filter_keys);
  }

  protected function getOrders()
  {
    $orders = [];
    if($this->request->filled('sort_order')){
      $orders[$this->request->input('sort_column')] = $this->request->input('sort_order');
    }
    return $orders;
  }

}
?>