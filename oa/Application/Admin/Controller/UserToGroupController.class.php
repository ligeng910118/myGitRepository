<?php
namespace Admin\Controller;
use Think\Controller;
class UserToGroupController extends BaseController {
	protected  $table = 'auth_group_access';
	

    public function index(){  
    	$this->selectDataAction();
    	$this->display();
    }
    
    public function add()
    {
    	if(IS_POST){
	    	$this->postData= $_POST;
	    	$result=$this->insertDataAction();
	    	if($result)
	    		$this->success('success',__CONTROLLER__.'/index');
	    	else 
	    		$this->error('error');
    	}else{
    		$this->htmlInformation();
    		$this->display('common');
    	}
    }
    
    public function htmlInformation()
    {
    	$this->assign('controller',CONTROLLER_NAME);
    	$this->assign('action',ACTION_NAME);
    	$this->assign('username',M('user')->select());
    	$this->assign('group',M('auth_group')->select());
    	$this->getTableField();
    }
    
    public function update()
    {
    	$this->id = I('id');
    	if(IS_POST){
    		$this->postData = $_POST;
    		$result=$this->updateDataAction();
    		if($result)
	    		$this->success('success',__CONTROLLER__.'/index');
	    	else 
	    		$this->error('error');
    	}else{  		
	    	$this->findOneUser();
	    	$this->htmlInformation();
	    	$this->display('common');
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
