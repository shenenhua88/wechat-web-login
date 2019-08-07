<?php
/**
 * 微信授权相关接口
 */
class Wechat {

  //高级功能-》开发者模式-》获取
  private $app_id = 'wx18c350a011c646e2'; //公众号appid
  private $app_secret = 'b3c6d7ac678e8677d829f91c599765d7'; //公众号app_secret
  private $redirect_uri = 'http://www.fk-watch.com/wechat/response.php'; //授权之后跳转地址

  /**
   * 获取微信授权链接
   *
   * @param string $redirect_uri 跳转地址
   * @param mixed $state 参数
   */
  public function get_authorize_url()
  {
    $redirect_uri = urlencode($this->redirect_uri);
    $response_type = "code";
    $scope = "snsapi_userinfo";
    $state = "STATE";
    $connect_redirect = 1;
    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type={$response_type}}&scope={$scope}&state={$state}#wechat_redirect";
    header('Location: '.$url);
  }
  /**
   * 获取授权token
   *
   * @param string $code 通过get_authorize_url获取到的code
   */
  public function get_access_token($code)
  {
    $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
    $token_data = $this->httpGet($token_url);


    if($token_data["errcode"] != 40029)
    {
      return json_decode($token_data, TRUE);
    }

    return FALSE;
  }

  /**
   * 获取授权后的微信用户信息
   *
   * @param string $access_token
   * @param string $open_id
   */
  public function get_user_info($access_token,$open_id)
  {
    if($access_token && $open_id)
    {
      $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
      $info_data = $this->httpGet($info_url);

      if($info_data["errcode"] != 40003)
      {
        return json_decode($info_data, TRUE);
      }

      return FALSE;
    }

    return FALSE;
  }



  /**
   * curl 获取接口信息
   *
   * @param string $url
   */
  public function httpGet($url)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
  
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
  
    //这是根据http://curl.haxx.se/ca/cacert.pem 下载的证书，添加这句话之后就运行正常了
    curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__).'/cacert.pem');  
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);
  
    return $res;
  } 



}