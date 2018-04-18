<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Cookie;
use \jwt\JWT;

class Jsonwebtoken extends Controller {

    // http://127.0.0.1/thinkphp_mysql/thinkphp/public/index.php/index/Jsonwebtoken/index?userName=userName&password=password

    public static $key = "example_key";
    public function index(){
        $token = array(
            "user" => "jackdizhu",
            "date" => date("Y-m-d H:i:s", time() + 60),
            // 什么时候过期，这里是一个Unix时间戳，是否使用是可选的；秒数
            "exp" => time() + 60
        );
        // 加密
        try
        {
            $jwt = JWT::encode($token, $this::$key);
            // 解密
            $decoded = JWT::decode($jwt, $this::$key, array('HS256'));
        }
        //捕获异常
        catch(Exception $e)
        {
            $jwt = 'encryption exception';
            $decoded = 'token validation error';
        }

        $arr['userName']=input('get.userName');
        $arr['password']=input('get.password');

        // 测试
        $arr['token'] = $jwt;
        $arr['decoded'] = $decoded;

        // 设置 Cookie 有效期为 3600秒
        Cookie::set('token', $jwt, 3600);

        return json($arr);
    }
    public function jwtDe(){
        // $jwt = input('get.token');
        $jwt = Cookie::get('token');
        //在 "try" 代码块中触发异常
        try
        {
            // 解密
            $decoded = JWT::decode($jwt, $this::$key, array('HS256'));
        }
        //捕获异常
        catch(Exception $e)
        {
            $decoded = 'token validation error';
        }

        $arr['token'] = $jwt;
        $arr['decoded'] = $decoded;
        $arr['date'] = date("Y-m-d H:i:s", $decoded->exp);

        return json($arr);
    }
    public function jwtEn(){
        $token = array(
            "userName" => input('get.userName'),
            "password" => input('get.password'),
            "date" => date("Y-m-d H:i:s", time() + 60),
            // 什么时候过期，这里是一个Unix时间戳，是否使用是可选的；秒数
            "exp" => time() + 60
        );
        // 加密
        $jwt = JWT::encode($token, $this::$key);

        // 测试
        $arr['token'] = $jwt;
        $arr['data'] = $token;

        // 设置 Cookie 有效期为 3600秒
        Cookie::set('token', $jwt, 3600);

        return json($arr);
    }
}
