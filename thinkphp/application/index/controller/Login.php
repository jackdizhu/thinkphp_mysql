<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use \jwt\JWT;

class Login extends Controller {
    public static $key = "example_key";
    public function index(){
        $token = array(
            "user" => "jackdizhu",
            // 什么时候过期，这里是一个Unix时间戳，是否使用是可选的；
            "exp" => strtotime('+1 day')
        );
        // 加密
        $jwt = JWT::encode($token, $this::$key);
        // 解密
        $decoded = JWT::decode($jwt, $this::$key, array('HS256'));

        $User = Db::name('User');
        // $this->show('index');
        $arr['userName']=input('get.userName');
        $arr['password']=input('get.password');

        if($arr['userName'] && $arr['password']){
            // 查询 数据
            $id = $User->where($arr)->find();
            if(!$id){
                $arr['code'] = '2';
                $arr['err'] = '用户名或密码错误';
            }else{
                $arr['code'] = '1';
                $arr['password'] = '********';
                session('userName',$arr['userName']);
            }
        }else{
            $arr['err'] = '填写信息不全 . . ';
            $arr['code'] = '3';
        }
        // 测试
        $arr['token'] = $jwt;
        $arr['decoded'] = $decoded;

        return json($arr);
    }
}
