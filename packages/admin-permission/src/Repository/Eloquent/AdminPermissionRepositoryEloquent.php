<?php

//namespace App\Repositories;
namespace Rbac\Permission\Repository\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Rbac\Permission\Repository\Contract\AdminPermissionRepository;
use Rbac\Permission\Models\AdminPermission;
use Illuminate\Support\Facades\Request;

/**
 * Class AdminPermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminPermissionRepositoryEloquent extends BaseRepository implements AdminPermissionRepository
{
    /**
     * Specify Model class name
     * 定义仓储数据层
     * @return string
     */
    public function model()
    {
        return AdminPermission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     * criteria 一个标准
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class)); //告诉仓储我们以怎样的方法和标准去进行数据的操作
    }

     /**
     * Retrieve all data of repository, paginated
     *
     * @param null|int $limit
     * @param array $columns
     * @param string $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $limit = Request::input('per_page'); //一次性显示多少个
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->model->{$method}($limit, $columns);
        $results->appends(app('request')->query());
        $this->resetModel();

        return $this->parserResult($results);
    }
    
}
