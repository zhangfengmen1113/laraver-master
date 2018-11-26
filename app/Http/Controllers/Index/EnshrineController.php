<?php

namespace App\Http\Controllers\Index;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnshrineController extends Controller
{
    //收藏 取消收藏
    public function ens(Request $request){
        //dd(1);
        $type = $request->query('type');
        //dd($type);//article
        $id = $request->query('id');
        //dd($id);//51
        //根据get参数和type类型组合模型类的class名
        $class = 'App\Models\\' . ucfirst($type);
        //dd($class);//App\Models\Article
        //$model = Article::find($id);
        //$model = Comment::find($id);
        $model = $class::find($id);
        //dd($model->toArray());
        //dd($model->zan);
        //dd($model->zan->where('user_id',auth()->id())->first());

        //判断如果数据库有这篇文章的收藏数据，再点击时候就执行取消收藏
        if ($enshrine = $model->enshrine->where('user_id',auth()->id())->first()){
            //执行取消
            //dd($enshrine);
            $enshrine->delete();
        }else{
            //dd($model->zan()->create());
            $model->enshrine()->create(['user_id'=>auth()->id()]);
        }

        return back();
    }
}
