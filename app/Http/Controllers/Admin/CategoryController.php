<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //这是加载后台首页的方法
    public function index()
    {
        //加载后台首页
        return view('admin.category.index');
    }
    //这是加载文章列表页面的方法
    public function home()
    {
        //paginate这个方法是做分页功能的
        //$categories = Category::all();
        //我们在文章列表页面上引用了laraver自带的方法links()
        //把Category模型类里面的所有数据存储到变量categories里面
        $categories = Category::paginate(8);
        //加载文章列表页面，并且再把变量传送给页面上需要数据的
        return view('admin.category.home', compact('categories'));
    }
    //这是加载写入添加的页面的方法
    public function create()
    {
        //加载添加页面
        return view('admin.category.create');
    }
    //这是实现写入添加的上传功能的方法
    public function store(CategoryRequest $request)
    {
        //dd($request->all());
        Category::create($request->all());
        //跳转弹窗
        return redirect()->route('admin.category.home')->with('success', '写入成功');
    }
    //这是加载更新修改的页面的方法
    public function edit(Category $category)
    {
        //dd($category);
        //加载更新页面，并且再把变量传送给页面上需要数据的
        return view('admin.category.edit', compact('category'));
    }
    //这是实现更新修改的上传功能的方法
    public function update(CategoryRequest $request, Category $category)
    {
        //dd($category);
        $category->update($request->all());
        //dd($category);die();
        //跳转弹窗
        return redirect()->route('admin.category.home')->with('success', '修改成功');
    }
    //这是实现删除功能的方法
    public function destroy(Category $category)
    {
         $category->delete();
         //跳转弹窗
         return redirect()->route('admin.category.home')->with('success', '删除成功');
    }
}
