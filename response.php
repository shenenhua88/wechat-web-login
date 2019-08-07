<?php
require_once(dirname(__FILE__).'/inc.php');
require_once(dirname(__FILE__).'/wechat.calss.php');

//参数初始化
$code = isset($code) ? $code : "0";

//echo($code);

$wechat = new Wechat();
$token_data = $wechat -> get_access_token($code);
//var_dump($token_data);
$access_token = $token_data["access_token"];
$openid = $token_data["openid"];

$user_data = $wechat ->  get_user_info($access_token, $openid);

echo "openid:".$user_data["openid"];
echo ("<br>");
echo "昵称:".$user_data["nickname"];
echo ("<br>");
echo "性别:".$user_data["sex"];
echo ("<br>");
echo "语言:".$user_data["language"];
echo ("<br>");
echo "省份:".$user_data["province"];
echo ("<br>");
echo "城市:".$user_data["city"];
echo ("<br>");
echo "国家:".$user_data["country"];
echo ("<br>");
echo "头像:<img src='".stripslashes($user_data["headimgurl"])."'/>";
echo ("<br>");
echo "privilege:".$user_data["privilege"];
echo ("<br>");