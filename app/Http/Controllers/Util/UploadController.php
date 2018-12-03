<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    //处理上传
    public function uploader(Request $request){
        //dd(1);
        //$path = $request->file('avatar')->store('avatars');
        //dd($path);
        //dd($_FILES);
        //storage/app/avatars是上传图片保存的默认地址(config目录的filesystems.php的disks里面)
        //现在我们在filesystems.php的disks里面新创个attachment目录，把上传图片的地址改换到
        //attachment目录里面，如果没有这个目录会自动生成
        //$file = $request->file('file')->store('attachment','attachment');
        //dd($file);
        $file = $request->file('file');
        //对上传类型大小进行拦截
        $this->checkSize($file);
        $this->checkType($file);

        if ($file){
            $path = $file->store('attachment','attachment');
            //把数据上传到数据库上去
            //创建迁移文件，把创建的表关联起来
            auth()->user()->attachment()->create([
                'name'=>$file->getClientOriginalName(),
                'path'=>url($path),
            ]);

        }
        //dd($path);
        //http://laravel-kj.edu/attachment/V0iQJ4hYTZDPg2dvJUSm2hj3B6CITLRI00L3rey8.jpeg"
        //dd(url($path));
        return ['file'=>url($path),'code'=> 0];
        //return $path;
    }

    //处理图片大小
    private function checkSize($file){
        //$file->getSize();
        if ($file->getSize() > hd_config('upload.size')){
            //dd(hd_config('upload.size'));
           //return  ['message' =>'图片大小不符合', 'code' => 403]
           //我们使用异常类处理上传异常
           //创建异常类:exception
           throw new UploadException('图片太大啦~');
        }
    }

    //处理图片类型
    private function checkType($file){
        //dd(hd_config('upload.type'));
        //dd(explode('/',hd_config('upload.type')));
        if(!in_array(strtolower($file->getClientOriginalExtension()),explode('/',hd_config('upload.type')))){
            //return  ['message' =>'类型不允许', 'code' => 403]
            //dd(hd_config('upload.type'));
            throw new UploadException('图片类型不对呀~');
        }
    }

    //获取图片列表
    public function filesLists(){
         $files = auth()->user()->attachment()->paginate(1);
         $data = [];
         foreach ($files as $file){
             $data[] = [
                 'url'=>$file['path'],
                 'path'=>$file['path'],
             ];
         }
         //dd($data);
        return [
            'data'=>$data,
            //分页后面一定要连接个空字符串。不然就只有两个花括号出现，没有具体分页
            'page'=>$files->links().'',
            'code'=> 0,
        ];
    }
}
