<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Register extends Controller {
    public function index(){

        $User = Db::name('User');

        $arr['userName']=input('get.userName');
        $arr['password']=input('get.password');

        $w_arr['userName']=$arr['userName'];

        if($arr['userName'] && $arr['password']){

            $oli_id = Db::name('User')->where($w_arr)->find();
            if($oli_id){
                $arr['code'] = '2';
                $arr['err'] = '用户名已存在';
            }

            $id = Db::name('User')->insert($arr);
            if($id){
                $arr['code'] = '1';
            }else{
                $arr['err'] = '增加数据失败';
                $arr['code'] = '3';
            }
        }else{
            $arr['err'] = '填写信息不全 . . ';
            $arr['code'] = '3';
        }

        return json_encode($arr);
    }
}
