<?php
        	
namespace Addons\Template\Model;
use Home\Model\WeixinModel;
        	
/**
 * Template的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'Template' ); // 获取后台插件的配置参数	
		//dump($config);

	}
}
        	