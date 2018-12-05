<?php

namespace App\Http\Controllers\Index;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use App\Models\Article;

class IndexController extends Controller
{
    //首页
    public function index(Photo $photo){
        //获取所有动态
        $actives = Activity::latest()->paginate(5);
        //dd($actives);
        $photos = $photo->all();
        //dd($actives);
        //dd($photos);
//        foreach($actives as $active){
//           	dump($active->causer);
//        }

        //加载模板
        return view('index.index',compact('actives','photos'));
    }
    //搜索功能
    public function search(Request $request)
    {
        //dd(1);
        //接受所有搜索的关键词
        $wd = $request->query('wd');
        //dd($wd);
        $articles = Article::search($wd)->paginate(10);
        //dd($articles);
        return view('index.search',compact('articles'));
    }
}
