<?php
namespace App\Http\Controllers\Api;

use App\Http\Middleware\TrimStrings;
use App\Trimstrings\ArticleTrimStrings;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends CommonController{

    //获取文章所有的数据
    public function articles()
    {
        $limit = request()->query('limit',10);
        if($cid = request()->query('cid')){
            $articles = Article::latest()->where('category_id',$cid)->paginate($limit);
        }else{
            $articles = Article::latest()->paginate($limit);
        }
        return $this->response->paginator($articles,new ArticleTrimStrings());
        //return Article::all();
        //return $this->response->array(Article::find(1));
        //return response()->json(['error' => 'Unauthorized'], 401);
        //return $this->response->error('This can you me.',404);
        //$limit = \request()->query('limit',10);
        //dd($limit);
        //return $this->response->array(Article::with('category')->get());

        //Dingo里面的TrimStrings
        //return $this->response->collection(Article::all(),new ArticleTrimStrings());
    }

    //制定获取一篇文章
    public function show($id)
    {
        return $this->response->item(Article::find($id),new ArticleTrimStrings());
    }

}
