<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $User = M('User');
        $this->show('index');
    }
}