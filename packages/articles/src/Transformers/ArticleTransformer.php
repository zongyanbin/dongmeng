<?php
namespace Addons\Articles\Transformers;

use Addons\Articles\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
  public function transform(Article $item)
  {
      return [
        'id'=> $item->id,
        'title' => $item->title,
        'desc' => $item->desc,
        'content' => $item->content,
        'img' => $item->img,
        'classty' => $item->classty,
        'channels' => $item->channels,
        'name' => $item->name,
        'click' => $item->click,
        'like' => $item->like,
        'is_show' => $item->is_show,
        'head_show' => $item->head_show,
        'share_show' => $item->share_show,
        'copyright_show' => $item->copyright_show,
        'message_show' => $item->message_show,
        'created_at' => $item->created_at,
        'updated_at' => $item->updated_at
      ];
  }
}
?>