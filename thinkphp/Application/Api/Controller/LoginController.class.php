<?php
namespace API\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $User = M('User');
        // $this->show('index');
        $arr['userName']=I('post.userName');
        $w_arr['userName']=$arr['userName'];
        $arr['password']=I('post.password');
        $w_arr['password']=$arr['password'];

        if($arr['userName'] && $arr['password']){

            $id = M('User')->where($w_arr)->find();
            if(!$id){
                $arr['code'] = '2';
                $arr['err'] = '用户名或密码错误';
            }else{
                $arr['code'] = '1';
                session('userName',$arr['userName']);
            }

            $this->ajaxReturn($arr,'json');
        }else{
            $arr['err'] = '填写信息不全 . . ';
            $arr['code'] = '3';
            $this->ajaxReturn($arr,'json');
        }
    }
}