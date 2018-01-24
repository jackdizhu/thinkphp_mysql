<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use \extend\JWT\JWT;


class Login extends Controller {
    public function index(){
        $key = "example_key";
        $token = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, $key);
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        print_r($decoded);die(0);

        $User = Db::name('User');
        // $this->show('index');
        $arr['userName']=input('post.userName');
        $arr['password']=input('post.password');

        if($arr['userName'] && $arr['password']){
            // 查询 数据
            $id = $User->where($arr)->find();
            if(!$id){
                $arr['code'] = '2';
                $arr['err'] = '用户名或密码错误';
            }else{
                $arr['code'] = '1';
                session('userName',$arr['userName']);
            }
        }else{
            $arr['err'] = '填写信息不全 . . ';
            $arr['code'] = '3';
        }

        return json($arr);
    }
}
