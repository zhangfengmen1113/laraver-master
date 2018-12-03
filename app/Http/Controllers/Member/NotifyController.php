<?php

namespace App\Http\Controllers\Member;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotifyController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'only'=>['index']
        ]);
    }

    //显示所有通知
    public function index(User $user)
    {
        $this->authorize('isMine',$user);
        //dd(1);
        $notifications = $user->notifications()->paginate(10);
        //dd($notifications);
        return view('member.notify.index',compact('user','notifications'));
    }

    //点击消息去相应的评论位置DatabaseNotification
    public function show(DatabaseNotification $notify)
    {
        //dd(1);
        $notify->markAsRead();
        //dd($notify);
        //滚动到相应位置
        return redirect($notify['data']['link']);
    }
}
