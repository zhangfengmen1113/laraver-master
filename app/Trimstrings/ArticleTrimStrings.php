<?php

namespace App\Trimstrings;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\TransformerAbstract;

class ArticleTrimStrings extends TransformerAbstract
{
    //定义属性
    protected $availableIncludes = ['category','user'];

    #定义可以include 使用的字段
    public function transform(Article $article)
    {
        return [
          'id'=>$article['id'],
          'title'=>$article['title'],
          'content'=>$article['content'],
          'created_at'=>$article->created_at->format('Y-m-d'),
        ];
    }

    public function includeCategory(Article $article)
    {
        return $this->item($article->category, new CategoryTrimStrings());
    }

    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTrimStrings());
    }
}
