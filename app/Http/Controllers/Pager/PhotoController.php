<?php

namespace App\Http\Controllers\Pager;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    //图片展示页面
    public function index()
    {
        $photos = Photo::latest()->paginate(6);
        //dd($paths);
        return view('pager.photo.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    //添加图片
    public function store(Request $request,Photo $photo)
    {
        //dd($request->all());
        //Photo::create($request->all());
        $photo->path = $request->thumb;
        $photo->save();
        //dd($dd);
        return redirect()->route('pager.photo.index')->with('success','图片上传成功');
    }

    /**l
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //dd($photo);
        $photo->delete();
        return back()->with('success','图片删除成功');
    }
}
