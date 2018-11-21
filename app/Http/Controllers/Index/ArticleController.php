<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //拦截
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=> ['create','store','edit','update','destroy'],
        ]);
    }

    //这是加载文章首页的模板的方法
    public function index(Request $request)
    {
      //接受category参数
      $category = $request->query('category');
      //dd($category);
      $articles =  Article::latest();
      if ($category){
          $articles = $articles->where('category_id',$category);
      }
        $articles = $articles->paginate(10);
      //获取所有栏目
      $categorise = Category::all();
      //dd($articles);
      return view('index.article.index',compact('articles','categorise'));
    }

    //这是加载文章添加的模板的方法
    public function create()
    {
      $categories = Category::all();
      return view('index.article.create',compact('categories'));
    }

    //这是加载文章添加上传功能的方法
    public function store(ArticleRequest $request , Article $article)
    {
       $article->title = $request->title;
       $article->category_id = $request->category_id;
       $article->user_id = auth()->id();
       $article->content = $request['content'];
       //dd($article->user);
       $article->save();
       return redirect()->route('index.article.index')->with('success','文章发表成功');
    }

    //这是实现显示，展现的模板的页面
    public function show(Article $article)
    {
        return view('index.article.show',compact('article'));
    }

    //这是实现更新编辑的模板的方法
    public function edit(Article $article)
    {
        $this->authorize('update',$article);
        $categories = Category::all();
        return view('index.article.edit',compact('categories','article'));
    }

    //这是实现更新修改文章的方法
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update',$article);
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->user_id = auth()->id();
        $article->content = $request['content'];
        //dd($article->user);
        $article->save();
        return redirect()->route('index.article.index')->with('success','文章编辑成功');
    }

    //这是删除文章功能的方法
    public function destroy(Article $article)
    {
        $this->authorize('delete',$article);
        $article->delete();
        return redirect()->route('index.article.index')->with('success','文章删除成功');
    }
}
