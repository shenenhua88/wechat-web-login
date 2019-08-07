<?php
require_once(dirname(__FILE__).'/inc.php');
require_once(dirname(__FILE__).'/wechat.calss.php');

$wechat = new Wechat();
$url = $wechat -> get_authorize_url($state);


// echo $url;
// echo "<br>";
// echo $redirect_uri2;
// echo "<br>";
// echo urlencode($redirect_uri);