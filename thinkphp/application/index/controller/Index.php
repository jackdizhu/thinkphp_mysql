<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Cookie;
use think\Config;
use think\Db;

class Index extends Controller {
    public function __construct(){
        parent::__construct();
        $arr['err'] = '填写信息不全 . . ';
        $arr['code'] = '-1';
        // return $this->success('请求拦截 success');
        // return $this->error('请求拦截 error');
    }

    public function index(){
        return 'index';
    }

    public function page(){

        $User = Db::name('User');

        $pageSize = 1;
        $page = input('get.page') ? input('get.page') : 1;

        $w_arr['userName'] = 'userName';

        // $arr = $User->where($w_arr)->find();
        $arr = $User->where($w_arr)->paginate($pageSize, false, [
            'page'=>$page
        ]);
        $count = $User->where($w_arr)->count();

        return json($arr);
    }
}
