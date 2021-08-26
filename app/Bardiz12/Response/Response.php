<?php
namespace App\Bardiz12\Response;

/**
 * Response
 * author   : @bardiz12
 * github   : https://github.com/bardiz12
 * web      : https://bardiz.digital
 * phone    : 085712503009
 * email    : dizba.seller@gmail.com
 * You can use this Library Freely, but dont delete the author's comments. :).
 */
class Response{
    public static function warning($data, $message = null, $code = null){
        return response()->json([
            "success" => false,
            "type" => "warning",
            "message" => $message,
            "data" => $data,
        ], $code ?? 200);
    }

    public static function success($data, $message = null, $code=null){
        return response()->json([
            "success"=>true,
            "type" => "success",
            "message" => $message,
            "data" => $data
        ], $code ?? 200);
    }


    public static function info($data, $message = null, $code=null){
        return response()->json([
            "success"=>true,
            "type" => "info",
            "message" => $message,
            "data" => $data
        ], $code ?? 200);
    }

    public static function error($data, $message, $code=null){
        return response()->json([
           "success" => false,
           "type" => "error",
           "message" => is_string($message) ? $message : implode("\n", $message->all()),
           "data" => $data
        ], $code ?? 200);
    }
}