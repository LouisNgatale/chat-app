<?php


namespace App\Helpers;


class ApiHelper
{
    public static function apiResponse($is_error, $code, $message, $data = null) {
        $result = [];

        if ($is_error){
            $result['success'] = false;
            $result['code'] = $code;
            $result['message'] = $message;
        }else{
            $result['success'] = true;
            $result['code'] = $code;
            if($data == null ){
                $result['message'] = $message;
            }else{
                $result['data'] = $data;
            }
        }

        return $result;
    }
}
