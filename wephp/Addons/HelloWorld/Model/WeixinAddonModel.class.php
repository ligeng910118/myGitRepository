<?php
        	
namespace Addons\HelloWorld\Model;
use Home\Model\WeixinModel;
        	
/**
 * HelloWorld的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	//var $config = array();
    
  function reply($dataArr,$keywordArr = array()){
    $config = getAddonConfig ( 'HelloWorld' );
  	$this->replyText('欢迎你来到港云金服');
  }
  
}
        	