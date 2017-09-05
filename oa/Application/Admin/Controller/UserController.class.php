<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends BaseController {
	protected  $table = 'user';
	
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
    		$this->display();
    	}

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
