<?php

namespace App\Http\Controllers\Api;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends CommonController
{
    public function photos()
    {
        $limit = \request()->query('limit',10);
        //dd($limit);//10
        return $this->response->array(Photo::limit($limit)->get());
    }
}
