<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Cookie;
use think\Config;

class Index extends Controller {
    public function __construct(){
        parent::__construct();
        $arr['err'] = '填写信息不全 . . ';
        $arr['code'] = '-1';
        // return $this->success('请求拦截 success');
        // return $this->error('请求拦截 error');
    }

    public function index()
    {
        return 'index';
    }
}
