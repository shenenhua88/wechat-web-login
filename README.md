### 微信网页授权

在接入该功能之前，需要注册微信公账号服务号，然后进行认证，获取appid,app_secret及设置redirect_uri（授权之后跳转地址）

> **如何设置redirect_uri**
> 微信公众号首页 =》 接口权限 =》 网页授权 =》 网页授权获取用户基本信息
> 你也可以进入[网页授权](https://mp.weixin.qq.com/cgi-bin/settingpage?t=setting/function&action=function&token=1916547199&lang=zh_CN)登陆微信公众号

#### 获取 code

创建index.php

需要引入 wechat.calss.php 和 inc.php

```php
$wechat = new Wechat();
$url = $wechat -> get_authorize_url($state);

```

#### 获取access_token
需要创建一个授权之后跳转地址页面，这里我命名为response.php

```php
$code = isset($code) ? $code : "0";
$wechat = new Wechat();
$token_data = $wechat -> get_access_token($code);

```
这将会返回一个数组

|   参数       | 	描述  |
| :------------- |:-------------|
| access_token |	网页授权接口调用凭证,注意：此access_token与基础支持的access_token不同|
|  expires_in	 |access_token接口调用凭证超时时间，单位（秒）|
| refresh_token|	用户刷新access_token|
|   openid     |	用户唯一标识|
|    scope     |	用户授权的作用域，使用逗号（,）分隔|


#### 获取用户信息
```php
$code = isset($code) ? $code : "0";
$wechat = new Wechat();
$user_data = $wechat ->  get_user_info($code);

```
返回结果


|参数 |	描述|
| :------------- |:-------------|
|openid	| 用户的唯一标识|
|nickname|	用户昵称|
|sex |	用户的性别，值为1时是男性，值为2时是女性，值为0时是未知|
|province |	用户个人资料填写的省份|
|city |	普通用户个人资料填写的城市|
|country |	国家，如中国为CN|
|headimgurl |	用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640x640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。|
|privilege |	用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）|
|unionid |	只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。|

微信网页授权官方规范
[https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842](https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842)

如果你看到，给予你的帮助，麻烦给个赞
