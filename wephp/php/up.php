<?php
require_once("./config.php");
//$result_url="http://".$_SERVER["HTTP_HOST"]."/php/result_url.php";


//��ֵ����û�����վ�ϵ�ת���ַ
//$notify_url="http://".$_SERVER["HTTP_HOST"]."/php/notify_Url.php";
//$gateWary="https://ijuhepay.cn/GateWay/ReceiveOrder.aspx";
$P_UserId='1933';
$P_CardId='';
$P_CardPass='';
$P_FaceValue='1';
$P_FaceType='CNY';
$P_ChannelId='1000';
$P_Subject='';
$P_Price='1';
$P_Quantity='1';
$P_Description=$_REQUEST["description"];
$P_Notic=$_REQUEST["notic"];
$P_AppID='wx393d9b6e0b066d93';
$P_OpenID='o3_yRwTUdgMZrZL0yIEsB99taL70';
$P_subject=$_REQUEST["P_subject"];
$P_Result_url=$result_url;
$P_Notify_url=$notify_url;
$SalfStr='VWEhpmcms1nM3PEvrgCma7fA0uRT4A30';
$P_OrderId=date('YmdHis',time());
$preEncodeStr=$P_UserId."|".$P_OrderId."|".$P_CardId."|".$P_CardPass."|".$P_FaceValue."|".$P_FaceType."|".$P_ChannelId."|".$SalfStr;
//var_dump($preEncodeStr);die;
$P_PostKey=md5($preEncodeStr);

$params="P_UserId=".$P_UserId;
$params.="&P_OrderId=".$P_OrderId;
$params.="&P_CardId=".$P_CardId;
$params.="&P_CardPass=".$P_CardPass;
$params.="&P_FaceValue=".$P_FaceValue;
$params.="&P_FaceType=".$P_FaceType;
$params.="&P_ChannelId=".$P_ChannelId;
$params.="&P_Subject=".$P_Subject;
$params.="&P_Price=".$P_Price;
$params.="&P_Quantity=".$P_Quantity;
$params.="&P_Description=".$P_Description;
$params.="&P_Notic=".$P_Notic;
$params.="&P_AppID=".$P_AppID;
$params.="&P_OpenID=".$P_OpenID;
$params.="&P_subject=".$P_subject;
$params.="&P_Result_url=".$P_Result_url;
$params.="&P_Notify_url=".$P_Notify_url;
$params.="&P_PostKey=".$P_PostKey;

//�������Զ����������Ᵽ��


//�����������ύ��API
var_dump($gateWary);
header("location:$gateWary?$params");

function getOrderId()
{
	return rand(100000,999999)."".date("YmdHis");
}
?>

