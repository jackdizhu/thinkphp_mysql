<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Upload extends Controller {
    public function index() {
        // $arr['err'] = '填写信息不全 . . ';
        $arr['code'] = '1';
        // Content-Disposition: form-data; name="file"; filename="test.png"
        $file = Request()->file('file'); // name=

        // 移动到框架应用根目录/public/uploads/ 目录下
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static');
            if($info){
                // 成功上传后 获取上传信息
                $arr['extension'] = $info->getExtension();
                $arr['saveName'] = $info->getSaveName();
                $arr['filename'] = $info->getFilename();
                return json($arr);
            }else{
                $arr['code'] = '2';
                // 上传失败获取错误信息
                $arr['err'] = $file->getError();
                return json($arr);
            }
            return json($arr);
        } else {
            $arr['code'] = '3';
            return json($arr);
        }
    }
}
