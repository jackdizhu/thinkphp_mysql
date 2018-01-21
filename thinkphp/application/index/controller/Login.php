<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Login {
    public function index(){
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
