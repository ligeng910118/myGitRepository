<?php

namespace Addons\Template\Controller;
use Think\ManageBaseController;

class TemplateController extends ManageBaseController{
    public function lists() {
        // $config=get_addon_config('Wecome');
        // dump($config);
        /*  $this->assign ( 'normal_tips', '温馨提示：图片大小不超过2M,    格式: bmp, png, jpeg, jpg, gif' ); */
        //$map ['is_use'] = 1;
        // $map ['manager_id'] = $this->mid;
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.get_access_token ();
        $list=json_decode($this->http_get($url));
       // var_dump($list);
        $list = json_decode(json_encode($list),true);
       //var_dump($list);
        $this->assign('list',$list['template_list']);
        $this->assign('address',$this->subStrAction());
        $this->display ();
    }
    
    public function subStrAction()
    {
    	$str = $_SERVER["QUERY_STRING"];
    	return substr($str, 3,3);
    }
    
    protected function http_get($url){
         $oCurl = curl_init();
         if(stripos($url,"https://")!==FALSE){
         curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
         curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
         }
         curl_setopt($oCurl, CURLOPT_URL, $url);
         curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
         $sContent = curl_exec($oCurl);
         $aStatus = curl_getinfo($oCurl);
         curl_close($oCurl);
         if(intval($aStatus["http_code"])==200){
         return $sContent;
         }else{
         return false;
         }
    }
    
    protected function http_post($url, $param) {
        $oCurl = curl_init ();
        if (stripos ( $url, "https://" ) !== FALSE) {
            curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYPEER, FALSE );
            curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYHOST, false );
        }
        if (is_string ( $param )) {
            $strPOST = $param;
        } else {
            $aPOST = array ();
            foreach ( $param as $key => $val ) {
                $aPOST [] = $key . "=" . urlencode ( $val );
            }
            $strPOST = join ( "&", $aPOST );
        }
        curl_setopt ( $oCurl, CURLOPT_URL, $url );
        curl_setopt ( $oCurl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $oCurl, CURLOPT_POST, true );
        curl_setopt ( $oCurl, CURLOPT_POSTFIELDS, $strPOST );
        $sContent = curl_exec ( $oCurl );
        $aStatus = curl_getinfo ( $oCurl );
        curl_close ( $oCurl );
        if (intval ( $aStatus ["http_code"] ) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }
    
    public function singleMessage()    
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.get_access_token ();
        $list=json_decode($this->http_get($url));
        $list = json_decode(json_encode($list),true);
        $this->assign('list',$list['template_list']);
        $this->assign('address',$this->subStrAction());
        $this->display ();
    }
    
    public function singleMessageTemplate()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.get_access_token ();
        $list=json_decode($this->http_get($url));
        $list = json_decode(json_encode($list),true);
        foreach ($list['template_list'] as $vo)
        {
            if($vo['template_id'] == $_POST['template_id'])
                $template = $vo;
        }
        $this->ajaxReturn(self::getString($template['content']));
    }
    
    public function insertData($keydArray,$table)
    {
        $m = M($table);
        $keyString = $valueString = '';
        foreach($keydArray as $key => $value)
        {
        	$keyString .="$key,";
        	$valueString .= "'$value',";
        }
        $keyString = substr($keyString,0,strlen($str)-1);
        $valueString = substr($valueString,0,strlen($str)-1);
        $sqlAction = "INSERT INTO `__PREFIX__$table` ($keyString) VALUES ($valueString)";
        return $m->execute($sqlAction);
    }
    
    public function message()
    {
        $m = M('template');
        if(IS_POST){
            $openid = $_POST['openid'];
            $_POST= $m->find($_POST['id']);
            $result=$this->sendAction($openid);
            //var_dump($result);die;
            if($result->errcode==0)
                $this->success('发送完毕');
            else 
                $this->error('发送失败');
        }else{
             $project = $this->subStrAction();
            $sqlAction = "SELECT * FROM `__PREFIX__template` WHERE `project` = '$project' ";
            $list = $m->query($sqlAction);
            $this->assign('list',$list);
            $this->assign('address',$this->subStrAction());
            $this->display();
        }
    }
    
    public function getString($string)
    {
        $string= str_replace('}}','}},',$string);
        $string = substr($string,14,strlen($string)-32);
        $stringArray = explode(',',$string);
        foreach ($stringArray as $k=>&$vo)
        {
            if($vo == '')
                unset($stringArray[$k]);
            $vo = explode('：',$vo);
            $vo[1] = substr($vo[1],2,8);
        }
        return $stringArray;
    }
    
    public function deleteData()
    {
        $m = M('template');
        $result=$m->delete(I('id'));
        if($result)
            $this->success('success');
        else 
            $this->error('error');
    }
    
    public function singleMessageAction()
    {
       $query = $this->insertData($_POST,'template');
       if($query)
           $this->success('操作成功');
       else 
           $this->error('操作失败');
    }
    
    
    
    public function sendAction($touser)
    {

        $arr = array(
            'touser' => $touser,
            'template_id' => $_POST['template_id'],
            'url' => $_POST['url'],
            'data' => array(
                'first' => array('value'=>$_POST['first'],'color'=>'#FF0000'),
                'remark' => array('value'=>$_POST['remark'],'color'=>'#002AFD'),
            )
        );
        for($i=1;$i<=count($_POST)-5;$i++){
            $arr['data']["keyword$i"]['value']= $_POST["keyword$i"];
            $arr['data']["keyword$i"]['color']= '#173177';
        }
        $arr = json_encode($arr);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.get_access_token();
        return json_decode($this->http_post($url,$arr));
    }
    
    public function messageManage()
    {
        $m = M('template');
        $project = $this->subStrAction();
        $sqlAction = "SELECT * FROM `__PREFIX__template` WHERE `project` = '$project' ";
        $list = $m->query($sqlAction);
        $this->assign('list',$list);
        $this->assign('address',$this->subStrAction());
        $this->display();
    }
    
    public function groupMessage()
    {
        $m = M('template');
        if(IS_POST){
            $userUrl = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.get_access_token();           
            $users =json_decode($this->http_get($userUrl),true);
            $_POST = $m->find($_POST['id']);
            //var_dump($users);die;
            foreach ($users['data']['openid'] as $k=>$v)
            {
                if($k%100==0)
                    sleep(70);
                $res[]=$this->sendAction($v);
            }
           //var_dump($res);die;
            $this->success('发送完毕');
        }else{           
            $project = $this->subStrAction();
            $sqlAction = "SELECT * FROM `__PREFIX__template` WHERE `project` = '$project' ";
            $list = $m->query($sqlAction);
            $this->assign('list',$list);
            $this->assign('address',$this->subStrAction());
            $this->display();
        }
    }
}
