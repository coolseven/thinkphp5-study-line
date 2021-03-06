<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2017/7/12
 * Time: 16:59
 * Mail: Overcome.wan@Gmail.com
 */

namespace app\frontend\controller;


use think\Controller;

class Auth extends Controller
{
    public function github()
    {
        $github_url = "https://github.com/login/oauth/authorize";
        // 这个参数是必须的，这就是我们在第一步注册应用程序之后获取到的Client ID；
        $client_id = "5e70ee2d904f655b0c31";
        // 该参数可选，当我们从Github获取到code码之后跳转到我们自己网站的URL
        $redirect_uri = "http://www.tinywan.xyz:8086/frontend/index/redirect_uri";
        $url = $github_url . "?client_id=" . $client_id . "&redirect_uri=" . $redirect_uri;
        header('location:' . $url);
    }

    public function redirect_uri(Request $request)
    {
        //'code' => string '137b34c45d7282436d53'
        $code = $request->get('code');
        $client_id = "5e70ee2d904f655b0c31";
        $client_secret = "d190c915d36b5feff7ceeb017ce35ab92e7cb38c";
        $url1 = "https://github.com/login/oauth/access_token";
        //第一步:取全局access_token
        $postRes = $this->curl_request($url1, [
            "client_id" => $client_id,
            "client_secret" => $client_secret,
            "code" => $code,
        ]);
        //第三步:根据全局access_token和openid查询用户信息
        $jsonRes = json_decode($postRes,true);
        $access_token = $jsonRes["access_token"];
        $userUrl = "https://api.github.com/user?access_token=".$access_token;
        $userInfo = $this->curl_request($userUrl);
        $userJsonRes = json_decode($userInfo,true);
        //第五步，如何设置Wordpress中登录状态
        halt($userJsonRes);
    }
}