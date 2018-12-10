<?php

namespace App\Trimstrings;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\TransformerAbstract;

class CategoryTrimStrings extends TransformerAbstract
{
    #定义可以include 使用的字段
    public function transform(Category $category)
    {
        return [
            'id'=>$category['id'],
            'title'=>$category['title'],
        ];
    }
}
