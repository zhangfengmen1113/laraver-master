<?php

namespace App\Http\Controllers\Index;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZanController extends Controller
{
    public function __construct(){
        //auth中间件对应的中间件在哪里,需要看注册中间件(app/Http/Kernal.php中$routeMiddleware)
        //article/show.blade.php模板中点赞增加 auth 判断用户是否登录
        $this->middleware('auth',[
            'only'=>['like']
        ]);
    }
    //点赞 取消点赞
    public function like(Request $request){
        //dd(1);
        //dd($request->all());
        //接受type和id的参数
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

        //判断如果数据库有这篇文章的点赞数据，再点击时候就执行取消点赞
        if ($zan = $model->zan->where('user_id',auth()->id())->first()){
            //执行取消
            //dd(1);
            $zan->delete();
        }else{
            //dd($model->zan()->create());
            $model->zan()->create(['user_id'=>auth()->id()]);
        }

        //异步请求
        if($request->ajax()){
            //这个需要重新获取对应模型,这句话结合异步请求
            $newModel = $class::find($id);
            return ['code'=>1,'message'=>'','num'=>$newModel->zan->count()];
        }
        return back();
    }
}
