<?php
namespace Rbac\Permission\Http\Api\Base;
use Dingo\Api\Http\FormRequest;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * 抽象搜索层 ：
 * 定义我们的抽象类 服务层
 */ 
abstract class AbstractSearchService
{
    //这个抽象类同样依赖 $request $repository 
    //具体实现时候在进行定义
    /**
     * @var request extends FormRequest
     *
     */
    protected $request;
    /**
     * @var BaseRepos repository extends BaseRepository
     */
    protected $repository;
    /**
     * 服务层里既可以使用repository提供得customCriteria也可以使用我们自己的
     * 开发要作上一个操作
     * customCriteria  默认 使用我们自己的设置为true  /false不使用自己
     */
    protected $customCriteria = true;

    //定义抽象方法 子类去实现的抽象方法
    //每个场景下都有自己的criteria
    abstract protected function getSearchCriteriaClassName():string;
    //OR AND 都需要去具体实现层，去实现
    abstract protected function getOrConditionFields():array;

    abstract protected function getAndConditionFields():array;

    //getSearchKeywordName不定义成抽象方法，如果定义成抽象方法就去具体的实现层去重写这个方法
    protected function getSearchKeywordName()
    {
        return 'keyword';
    }

    //守卫验证 通过当前requeset 进行信息的验证validated
    protected function guard()
    {
        //验证方法validated 
        $this->request->validated();
    }

    /**
     *定义我们自己的主体方法 
     */
    public function search()
    {
        //第一步：【验证请求】通过当前requeset 进行信息的验证validated
        $this->guard();
        //第二部：【把我们的自定义criteria传进去】通过我们的repository pushCriteria
        $this->repository->pushCriteria($this->getSearchCriteria());
        //第三部：【paginate分页】返回进行分页
        return $this->repository->paginate();
    }

    /**
     * pushCriteria 里的参数方法 getSearchCriteria 通过另一个方法返回回来的
     * 
     */
    protected function getSearchCriteria()
    {
        //每个场景都有自己的Criteria customCriteria 是否开启 true
        if($this->customCriteria){
            //第一步：把className获取一下，通过this在去调用一个方法
            $className = $this->getSearchCriteriaClassName();
            /**
             * getOrconditions  参数方法
             * getAndconditions 参数方法
             * getOrders 参数方法
             * return 返回数据
             */
            return new $className($this->getOrconditions(),$this->getAndconditions(),$this->getOrders());
        }
        //false this->customCriteria
        return app(RequestCriteria::class);  //原来的搜索
    }

    /**
     * getOrconditions 传递给 Criteria
     * 组装成数组
     * getOrConditionFields 数据的填充
     * @return void
     */
    protected function getOrconditions()
    {
        //比如 return ['name'=>'add','mobile'=>'add']
        //具体字段不能在抽象层定义，只能去实现层处理

        //filled 判断前端是或否提交这个字段
        //array_fill_keys 把我们指定的key进行数据填充
        //$this->getOrConditionFields  字段
        return $this->request->filled($this->getSearchKeywordName())
            ?array_fill_keys($this->getOrConditionFields(),$this->request->input($this->getSearchKeywordName()))
            :[];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function getAndconditions()
    {  
        /*已有字段:   $key = ['a'=>'','b'=>'','c'=>''];  
          前端提交的值: a='xiaowang';b='xiali';c='xiaoqin'            
            通过原有数组，和提交的数字进行合并出现在所有其它参数数组中的键名的值。，  
        */
        //过滤前端空值array_filter
        $arr_filter_null = array_filter($this->request->input(),
                        function($val){
                            return !is_null($val);
                        });
                        
        //前端值和已经值进行合并 array_intersect_key
        //getAndConditionFields进行填充null我们自己组装的值
        $arr_fill_keys= array_fill_keys($this->getAndConditionFields(),'');
        return array_intersect_key($arr_filter_null,$arr_fill_keys); //获取交集
    }

    /**
     * 定义 多字段排序
     * name降序
     * age升序
     * 
     * 排序方式
     * @return void
     */
    protected function getOrders()
    {
        /**
         * 例如：
         * sort_column=name;age
         * sort_order=desc;asc
         * exeload 变成数字然后在找对应关系
         */
        $orders = [];
        //sort_order = desc asc
        if($this->request->filled('sort_order')){
            $order[$this->request->input('sort_column')] = $this->request->input('sort_order');
        }
        return $orders;
    }
}

?>
