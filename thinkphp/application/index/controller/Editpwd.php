<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Editpwd {
    public function index(){
        $User = Db::name('User');
        // $this->show('index');
        $arr['userName']=input('post.userName');
        $w_arr['userName']=$arr['userName'];
        $oldPassword=input('post.oldPassword');
        $w_arr['password']=$oldPassword;

        $arr['password']=input('post.password');
        $password2=input('post.password2');
        if($arr['userName'] && $oldPassword && $arr['password'] && $password2){

            $oli_id = $User->where($w_arr)->find();
            if(!$oli_id){
                $arr['code'] = '2';
                $arr['err'] = '用户名或密码错误';
            } else {
                $id = $User->where($w_arr)->update($arr);
                if($id){
                    $arr['code'] = '1';
                }else{
                    $arr['err'] = '修改数据失败';
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
