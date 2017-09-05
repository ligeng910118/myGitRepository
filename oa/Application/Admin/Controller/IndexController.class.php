<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	public $table = 'user';
	public $postData;
    public function index(){ 
    	if(!$_SESSION['uid'])
    		$this->redirect('Index/login', array(), 2, '请先登录，页面跳转中...');
    		$this->display();
    }
    
    public function login()
    {
    	$this->display();
    }

    public function md5Action($str='password')
    {
    	foreach($this->postData as $k=>&$v)
    	{
    		if($k == $str)
    			$v = md5($v);
    	}
    }
    
    
    public function loginAction()
    {
    	$this->postData = $_POST;
    	self::md5Action();
    	$m = M($this->table);
    	$result = $m->where($this->postData)->find();
    	if($result){
    		session('uid',$result['id']);
    		session('username',$result['username']);
    		$this->success('success','index');
    	}else{ 
    		$this->error('error');
    	}
    }
    
    public function test()
    {
    	
    	//var_dump($sender);
    	
    	
    	//return $sender->sendEmail();
    }
}