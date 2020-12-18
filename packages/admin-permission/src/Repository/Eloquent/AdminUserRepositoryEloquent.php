<?php

//namespace App\Repositories;
namespace Rbac\Permission\Repository\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
//use App\Repositories\AdminUserRepository;
use Rbac\Permission\Repository\Contract\AdminUserRepository;
//use App\Entities\AdminUser;
use Rbac\Permission\Models\AdminUser;
/**
 * Class AdminUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminUserRepositoryEloquent extends BaseRepository implements AdminUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUser::class;
    }

    

    // /**
    //  * Boot up the repository, pushing criteria
    //  */
    // public function boot()
    // {
    //     $this->pushCriteria(app(RequestCriteria::class));
    // }
    
}
