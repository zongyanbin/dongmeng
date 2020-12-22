<?php
namespace Addons\Articles\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Category extends Model
{
    use HasFactory;
    
    /**
     * Associative table
     *
     * @var string
     */
    protected $table = "categories";
    /**
     * Batch assignment
     *
     * @var array
     */
    protected $fillable = ['title','name','description','pid'];

    public function child()
    {
        return $this->hasMany(Category::class, 'pid', 'id');
    }

    public function children()
    {
        return $this->child()->with('children');
    }
}
