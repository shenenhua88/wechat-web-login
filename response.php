<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- 以上临时使用 -->

<?php
require_once(dirname(__FILE__).'/inc.php');
require_once(dirname(__FILE__).'/wechat.calss.php');

//参数初始化
$code = isset($code) ? $code : "0";

//微信类实例化
$wechat = new Wechat();

//获取用户信息
$user_data = $wechat ->  get_user_info($code);

//以下打印获取的参数信息
echo "<div style='line-height:2; padding:5%; font-size:16px;'>";
    echo "Code： ". $code ."<br>";
    echo "openid： " .$user_data["openid"] ."<br>";
    echo "昵称： ". $user_data["nickname"] ."<br>";
    $sex = ($user_data["sex"]>0 and $user_data["sex"]<2) ? ($user_data["sex"]==1 ? "男" : "女") : "未知";
    echo "性别： ". $sex ."<br>";
    echo "语言： ". $user_data["language"] ."<br>";
    echo "国家： ".$user_data["country"] ."<br>";
    echo "省份： ". $user_data["province"] ."<br>";
    echo "城市： ". $user_data["city"] ."<br>";
    echo "头像： <img src='".stripslashes($user_data["headimgurl"])."'/><br>";
    echo "privilege： "; var_dump($user_data["privilege"]);
echo "</div>";
