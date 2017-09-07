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
        $list = json_decode(json_encode($list),true);
       //var_dump($list);
        $this->assign('list',$list['template_list']);
        $this->display ();
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
        if($_GET['id']){
            $m = M('template');
            $this->assign('data',$m->find($_GET['id']));
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.get_access_token ();
        $list=json_decode($this->http_get($url));
        $list = json_decode(json_encode($list),true);
        //var_dump($list);
        $this->assign('list',$list['template_list']);
        $this->display ();
    }
    
    public function singleMessageAction()
    {
        $m = M('template');
        $m->add($_POST);
            
       $result = $this->sendAction($_POST['touser']);
       if($result->errcode == 0)
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
                'first' => array('value'=>$_POST['first'],'color'=>'#173177'),
                'keynote1' => array('value'=>$_POST['keynote1'],'color'=>'#173177'),
                'keynote2' => array('value'=>$_POST['keynote2'],'color'=>'#173177'),
                'keynote3' => array('value'=>$_POST['keynote3'],'color'=>'#173177'),
                'remark' => array('value'=>$_POST['remark'],'color'=>'#173177'),
            )
        );
        $arr = JSON($arr);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.get_access_token();
        return json_decode($this->http_post($url,$arr));
    }
    
    public function messageManage()
    {
        $m = M('template');
        $list = $m->select();
        //var_dump($list);
        $this->assign('list',$list);
        $this->display();
    }
    
    public function groupMessage()
    {
        $m = M('template');
        if(IS_POST){
            $userUrl = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.get_access_token();           
            $users =json_decode($this->http_get($userUrl));
            $_POST = $m->find($_POST['id']);
            //var_dump($users);
            foreach ($users as $v)
            {
                $this->sendAction($users->data->openid);
            }
            $this->success('发送成功');
        }else{
            
            $list = $m->select();
            $this->assign('list',$list);
            $this->display();
        }
    }
}
