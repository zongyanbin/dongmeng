<?php
namespace Addons\Articles\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
