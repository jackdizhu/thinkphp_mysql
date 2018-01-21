<?php
namespace app\index\controller;
class Editpwd {
    public function index(){
        $User = M('User');
        // $this->show('index');
        $arr['userName']=I('post.userName');
        $w_arr['userName']=$arr['userName'];
        $arr['oldPassword']=I('post.oldPassword');
        $w_arr['password']=I('post.oldPassword');

        $arr['password']=I('post.password');
        $arr['password2']=I('post.password2');
        if($arr['userName'] && $arr['oldPassword'] && $arr['password'] && $arr['password2']){

            $oli_id = M('User')->where($w_arr)->find();
            if(!$oli_id){
                $arr['code'] = '2';
                $arr['err'] = '用户名或密码错误';
                $this->ajaxReturn($arr,'json');
            }

            $id = M('User')->where($w_arr)->save($arr);
            if($id){
                $arr['code'] = '1';
            }else{
                $arr['err'] = '修改数据失败';
                $arr['code'] = '3';
            }
            $this->ajaxReturn($arr,'json');
        }else{
            $arr['err'] = '填写信息不全 . . ';
            $arr['code'] = '3';
            $this->ajaxReturn($arr,'json');
        }
    }
}
