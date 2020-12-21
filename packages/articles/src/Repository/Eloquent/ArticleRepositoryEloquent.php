<?php
namespace Addons\Articles\Repository\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Addons\Articles\models\Article;
use Addons\Articles\Repository\Contract\ArticleRepository;

/**
 * Class ArticleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
