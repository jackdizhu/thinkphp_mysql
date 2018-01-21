<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Register extends Controller {
    public function index(){

        $User = Db::name('User');

        $arr['userName']=input('post.userName');
        $arr['password']=input('post.password');
        $password2=input('post.password2');

        $w_arr['userName']=$arr['userName'];

        if($arr['userName'] && $arr['password'] && ($password2 === $arr['password'])){

            $oli_id = $User->where($w_arr)->find();
            if($oli_id){
                $arr['code'] = '2';
                $arr['err'] = '用户名已存在';
            } else {
                // 插入数据 
                $id = $User->insert($arr);
                if($id){
                    $arr['code'] = '1';
                }else{
                    $arr['err'] = '增加数据失败';
                    $arr['code'] = '3';
                }
            } 
        }else{
            $arr['err'] = '填写信息不全 . . ';
            $arr['code'] = '3';
        }

        return json($arr);
    }
}
