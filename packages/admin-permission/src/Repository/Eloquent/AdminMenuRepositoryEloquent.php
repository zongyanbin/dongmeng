<?php
namespace Rbac\Permission\Repository\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Validators\AdminMenuValidator;
use Rbac\Permission\Repository\Contract\AdminMenuRepository;
use Rbac\Permission\Models\AdminMenu;


/**
 * Class AdminMenuRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminMenuRepositoryEloquent extends BaseRepository implements AdminMenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminMenu::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

