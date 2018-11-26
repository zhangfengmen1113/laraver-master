<?php

namespace App\Http\Controllers\Index;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //获取指定文章的所有评论数据
    public function index(Request $request,Comment $comment){
        //dd($request->toArray());
        //dd($comment);
        //dd($comment->with('user'));
        //$comments = Comment::where('article_id',$request->article_id)->get();
        //这样关联,可以保证Comment模型中有关联user的方法
        $comments = $comment->with(['user','zan'])->where('article_id',$request->article)->get();
        //dd($request->article_id);
        //dd($comments->toArray());
        return ['code'=>1,'message'=>'','comments'=>$comments];
    }
     //添加评论
     public function store(Request $request,Comment $comment)
     {
         //dd($comment);
         //执行评论表添加
         $comment->user_id = auth()->id();
         $comment->article_id = $request->article_id;
         $comment->content = $request['content'];
         $comment->save();
         //dd($comment->with('user')->get()->toArray());
         //关联user
         $comment = $comment->with('user')->find($comment->id);
         //dd($comment->toArray());
         return ['code'=>1,'message'=>'','comment'=>$comment];

     }
}
