<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Cookie;

class Encryptiondecryption extends Controller {
    const rsa_en = 'http://127.0.0.1/thinkphp_mysql/thinkphp/public/index.php/index/Encryptiondecryption/rsa_en?data=';
    const rsa_de = 'http://127.0.0.1/thinkphp_mysql/thinkphp/public/index.php/index/Encryptiondecryption/rsa_de?data=';
    public function delcookie(){
            
            // 设置 Cookie 有效期为 3600秒
            Cookie::delete('data');

        return 'Cookie is del';
    }
    public function index(){
            
            $_data = input('get.data', 'test');
            // 设置 Session
            Session::set('data', $_data);
            // 设置 Cookie 有效期为 3600秒
            Cookie::set('data', $_data, 3600);

            // php 7.1
            $data = $_data;
            echo '原始内容: '.$data."<br/>";

            $en = '';
            $de = '';

            openssl_public_encrypt($data, $en, file_get_contents(dirname(__FILE__).'/rsa_public_key.pem'));
            $base64_en = base64_encode($en);
            echo '公钥加密: '.$base64_en."<br/>";
            
            $en2 = base64_decode($base64_en);
            openssl_private_decrypt($en2, $de, file_get_contents(dirname(__FILE__).'/rsa_private_key.pem'));
            echo '私钥解密: '.$de."<br/>";

        return '';
    }
    public function rsa_en(){
            // php 7.1
            $data = input('get.data', '');
            echo '原始内容: '.$data."<br/>";

            $en = '';
            $de = '';

            openssl_public_encrypt($data, $en, file_get_contents(dirname(__FILE__).'/rsa_public_key.pem'));
            $base64_en = base64_encode($en);
            echo '公钥加密: <a href="'.Encryptiondecryption::rsa_de.$base64_en.'">'.$base64_en.'</a><br/>';

        return '';
    }
    public function rsa_de(){
            // php 7.1  参数带有 特殊字符会 被过滤导致解密失败
            $data = input('get.data', '');
            echo '原始内容: '.$data."<br/>";

            $en = '';
            $de = '';

            $en = base64_decode($data);
            openssl_private_decrypt($en, $de, file_get_contents(dirname(__FILE__).'/rsa_private_key.pem'));
            echo '私钥解密: <a href="'.Encryptiondecryption::rsa_en.$de.'">'.$de.'</a><br/>';

        return '';
    }
}
