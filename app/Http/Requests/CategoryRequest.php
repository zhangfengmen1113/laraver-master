<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        dd($this->route('category'));
      $id = $this->route('category') ? $this->route('category')->id : null;
      //dd($id);
        return [
            'title'=>'required|unique:categories,title,'.$id,
            'author'=>'required|unique:categories,author,'.$id,
            'icon' => 'required',
            'content'=> 'required|min:10'
        ];
    }

    public function messages()
    {
        return [
          'title.required'=>'标题不能不写噢~',
          'title.unique'  =>'标题重啦~',
          'author.required'=>'作者名字呢~',
          'author.unique'=>'作者名字可不能重咯~',
          'icon.required'=>'个性图标弄上好看点~',
          'content.required'=>'文章内容都没有呀~',
          'content.min'=>'可不能少于10个字哦~',

        ];
    }
}
