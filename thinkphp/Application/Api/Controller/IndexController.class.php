<?php
namespace API\Controller;
use Think\Controller;
use Think\Page;
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
    public function page(){
        $User = M('User'); // 实例化User对象
        $pageSize = 1;
        $page = $_GET['page'] ? $_GET['page'] : 1;

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $User->page($page, $pageSize)->select();
        $count = $User->count();// 查询满足要求的总记录数

        // $Page       = new Page($count, $pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
        // $pageHtml       = $Page->show();// 分页显示输出

        $data['list'] = $list;
        // $data['pageHtml'] = $pageHtml;

        $this->ajaxReturn($data,'json');
    }
}
