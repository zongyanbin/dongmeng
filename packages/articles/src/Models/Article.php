<?php
namespace Addons\Articles\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";
    protected $fillable = [
        'title','desc','content','img','classty',
        'channels','name','click','like','is_show'
    ];
}
