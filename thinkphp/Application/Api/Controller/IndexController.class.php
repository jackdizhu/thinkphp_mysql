<?php
namespace API\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $User = M('User');
        // $this->show('index');
        $arr['userName']=I('post.userName');
        $arr['password']=I('post.password');
        $arr['password2']=I('post.password2');
        if($arr['userName'] && $arr['password'] && $arr['password2']){
            $id = M('User')->add($arr);
            if($id){
                $arr['code'] = '1';
            }else{
                $arr['err'] = '增加数据失败';
                $arr['code'] = '2';
            }
            $arr['code'] = '1';
            $this->ajaxReturn($arr,'json');
        }else{
            $arr['err'] = '填写信息不全 . . ';
            $arr['code'] = '3';
            $this->ajaxReturn($arr,'json');
        }
    }
}