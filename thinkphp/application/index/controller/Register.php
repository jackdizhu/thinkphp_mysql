<?php
namespace app\index\controller;
class Register {
    public function index(){
        $User = M('User');
        // $this->show('index');
        $arr['userName']=I('post.userName');
        $w_arr['userName']=$arr['userName'];

        $arr['password']=I('post.password');
        $arr['password2']=I('post.password2');
        if($arr['userName'] && $arr['password'] && $arr['password2']){

            $oli_id = M('User')->where($w_arr)->find();
            if($oli_id){
                $arr['code'] = '2';
                $arr['err'] = '用户名已存在';
                $this->ajaxReturn($arr,'json');
            }

            $id = M('User')->add($arr);
            if($id){
                $arr['code'] = '1';
            }else{
                $arr['err'] = '增加数据失败';
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
