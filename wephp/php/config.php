<?php
//date_default_timezone_set(PRC);
//平台商户ID，需要更换成自己的商户ID
$UserId="1635";


//接口密钥，需要更换成你自己的密钥，要跟后台设置的一致
//登录API平台，接口配置-->支付通道接口下载，这里自己设置密钥
$SalfStr="0iUvmz8xXckxLD7NMFr9eXIBMvnYJNqo";


//网关地址，要更新成你所在的平台网关地址 https://ijuhepay.cn/GateWay/ReceiveOrder.aspx
$gateWary="https://ijuhepay.cn/GateWay/ReceiveOrder.aspx";


//充值结果后台通知地址
$result_url="http://".$_SERVER["HTTP_HOST"]."/php/result_url.php";


//充值结果用户在网站上的转向地址
$notify_url="http://".$_SERVER["HTTP_HOST"]."/php/notify_Url.php";
?>