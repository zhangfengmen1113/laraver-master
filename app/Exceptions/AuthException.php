<?php

namespace App\Exceptions;

use Exception;

class AuthException extends Exception
{
    public function render(){

        //return response()->json(hdjs要求返回,http状态码),注:http状态码必须200正常的，如果其他的就会报错;
        return redirect()->back()->with($this->getMessage());
    }
}
