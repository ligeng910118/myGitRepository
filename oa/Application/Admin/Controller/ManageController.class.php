<?php
namespace Admin\Controller;
use Think\Controller;
class ManageController extends BaseController {
	protected  $table = 'product_order';
	

    public function index()
    {    	
    	$this->selectDataAction();
    	$this->display();
    }
    
    
    public function htmlInformation()
    {
    	$this->assign('controller',CONTROLLER_NAME);
    	$this->assign('action',ACTION_NAME);
    }
    
    public function payCode()
    {
    	$this->id = I('id');
    	if(IS_POST){ 	
    		$this->postData = $_POST;
    		self::setPostData('status', 2);
    		$this->getUploadAddress('payCode');
    		$result=$this->updateDataAction();
    		$workEmail = self::getWorkEmail();
    		//var_dump($workEmail);die;
    		if($result&&self::sendQQEmail($workEmail,'商户二维码','商户二维码上传，请快速处理'))
	    		$this->success('success',__CONTROLLER__.'/index');
	    	else 
	    		$this->error('error');
    	}else{  		
	    	$this->findOneUser();
	    	$this->htmlInformation();
	    	$this->display('add');
    	}
    }
    
    public function getWorkEmail()
    {
    	$workId = getField($this->id, $this->table, 'worker');
    	return getField($workId, 'user', 'email');    	
    }
    
    public function approve()
    {
    	$this->id = I('id');
    	if(IS_POST){
    		$this->postData = $_POST;
    		self::setPostData('status', 3);
    		self::setPostData('productStart', time());
    		//var_dump($this->postData);die;
    		$result=$this->updateDataAction();  		
    		$workEmail = self::getWorkEmail();
    		//var_dump($workEmail);die;
    		if($result&&self::sendQQEmail($workEmail,'商户资料批准','商户资料批准，请快速处理'))
    			$this->success('success',__CONTROLLER__.'/index');
    		else
    			$this->error('error');
    	}else{
	    	$this->findOneUser();
	    	$this->htmlInformation();
	    	$this->display();
    	}
    }
    
    public function notApprove()
    {
    	$this->id = I('id');
    	self::setPostData('id', I('id'));
    	self::setPostData('status',4);
    	$result=$this->updateDataAction();
    	$workEmail = self::getWorkEmail();
    		if($result&&self::sendQQEmail($workEmail,'商户资料未批准','商户资料未批准，请快速处理'))
    			$this->success('success',__CONTROLLER__.'/index');
    		else
    			$this->error('error');
    }
    
    public function complete()
    {
    	$this->id = I('id');
    	if(IS_POST){
    		$this->postData = $_POST;
    		self::setPostData('status', 5);
    		self::setPostData('productEnd', time());
    		$result=$this->updateDataAction();
    		$workEmail = self::getWorkEmail();
    		if($result&&self::sendQQEmail($workEmail,'小程序已完成','小程序已完成，请三天后进行回访'))
    			$this->success('success',__CONTROLLER__.'/index');
    		else
    			$this->error('error');
    	}else{
    		$this->findOneUser();
    		$this->htmlInformation();
    		$this->display();
    	}
    }
    
    public function delete()
    {
    	$this->id = I('id');
    	$result = $this->deleteDataAction();
    	if($result)
    		$this->success('success');
    	else
    		$this->error('error');
    }
   
}
