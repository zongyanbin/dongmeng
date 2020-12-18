<?php

//namespace App\Repositories;
namespace Rbac\Permission\Repository\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Rbac\Permission\Repository\Contract\AdminRoleRepository;
use Rbac\Permission\Models\AdminRole;


/**
 * Class AdminRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminRoleRepositoryEloquent extends BaseRepository implements AdminRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRole::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
