<?php
namespace Admin\Controller;
use Think\Controller;
class ProductOrderController extends BaseController {
	protected  $table = 'product_order';
	

    public function index()
    {    	
    	$this->selectDataAction();
    	$this->display();
    }
    
    public function add()
    {
    	if(IS_POST){
    		$this->postData = $_POST;
    		$this->getUploadAddress('firstData');
    		self::setPostData('status',1);
    		self::setPostData('createTime',date('Y-m-d H:i:s'));
    		self::setPostData('worker',$_SESSION['uid']);
    		$result=$this->insertDataAction();
	    	if($result&&self::sendQQEmail($_POST['manageEmail'],'商户创建','商户资料创建，请快速处理'))
	    		$this->success('success',__CONTROLLER__.'/index');
	    	else 
	    		$this->error('error');
    	}else{
    		$this->htmlInformation();
    		$this->display();
    	}
    }
    
    public function htmlInformation()
    {
    	$this->assign('controller',CONTROLLER_NAME);
    	$this->assign('action',ACTION_NAME);
    }
    
    public function update()
    {
    	$this->id = I('id');
    	if(IS_POST){
    		$this->postData = $_POST;
    		$this->getUploadAddress('firstData');
    		$result=$this->updateDataAction();
    		if($result&&self::sendQQEmail($_POST['manageEmail'],'商户资料更新','商户资料更新，请快速处理'))
	    		$this->success('success',__CONTROLLER__.'/index');
	    	else 
	    		$this->error('error');
    	}else{  		
	    	$this->findOneUser();
	    	$this->htmlInformation();
	    	$this->display('add');
    	}
    }
    
    public function secoudDataUpdate()
    {
    	$this->id = I('id');
    	$this->postData = $_POST;
    	self::setPostData('status', 1);
    	$this->getManyUploadAddress();
    	$result=$this->updateDataAction();
    	if($result&&self::sendQQEmail($_POST['manageEmail'],'商户更新','商户资料更新，请快速处理'))
    		$this->success('success',__CONTROLLER__.'/index');
    	else
    		$this->error('error');
    }
    
    public function delete()
    {
    	$this->id = I('id');
    	$this->postData = $_POST;
    	$result = $this->deleteDataAction();
    	if($result)
    		$this->success('success');
    	else
    		$this->error('error');
    }
   
}
