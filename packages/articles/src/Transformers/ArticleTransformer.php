<?php
namespace Addons\Articles\Transformers;

use Addons\Articles\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
  public function transform(Article $item)
  {
      return [
        
      ];
  }
}
?>