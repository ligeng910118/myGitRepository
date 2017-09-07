<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class BaseController extends Controller {
	public $order = 'id';
	public $num = 10;
	public $id;
	protected $table;
	protected  $where = array();
	protected  $postData = array();

	
	public function __construct()
	{
		parent::__construct();
		self::checkLogin();
		self::checkAuth();
	}
	
	
	
	public function sendQQEmail($receive,$body,$subject)
	{
		vendor('phpmailer.test');
		$sender = new \email();
		$sender->body = $body;
		$sender->receive = $receive;
		$sender->subject = $subject;
		return $sender->sendEmail();
	}
	
	public function md5Action($str='password')
	{
		foreach($this->postData as $k=>&$v)
		{
			if($k == $str)
				$v = md5($v);
		}
	}
	
    public function insertDataAction()
    {
    	self::md5Action();
    	$m = M($this->table);
    	return $m->add($this->postData);
    }
    
    public function selectDataAction()
    {
    	$this->selectData();
    	$this->selectPage();
    }
    
    public function selectData()
    {
    	$m = M($this->table);
    	$count      = $m->where($this->where)->count();
    	$Page       = new \Think\Page($count,$this->num);
    	$list = $m->where($this->where)->order($this->order)->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('list',$list);
    }
    
    public function selectPage()
    {
    	$m = M($this->table);
    	$count      = $m->where($this->where)->count();
    	$Page       = new \Think\Page($count,$this->num);
    	$show       = $Page->show();
    	$this->assign('page',$show);
    }
    
    public function updateDataAction()
    {
    	self::md5Action();
    	$m = M($this->table);
    	return $m->save($this->postData);
    }
    
    public function findOneUser()
    {
    	$m=M($this->table);
    	$data = $m->find($this->id);
    	$this->assign('data',$data);
    }
    
    public function deleteDataAction()
    {
    	$m=M($this->table);
    	return $m->delete($this->id);
    }
    
    public function getTableField()
    {
    	$m = M($this->table);
		$fields = $m->getDbFields();
		//var_dump($fields);
    	$this->assign('fields',$fields);
    }
    
    public function checkLogin()
    {
    	if(!$_SESSION['uid'])
    		$this->redirect('Index/login', array(), 2, '请先登录，页面跳转中...');
    }
    
    public function getUploadAddress($uploadName)
    {
    	$files = $this->uploadAction();  
    	self::setPostData("$uploadName",'Uploads/'.$files["$uploadName"]['savepath'].$files["$uploadName"]['savename']);
    }
    
    public function getManyUploadAddress()
    {
    	$files = $this->uploadAction();
    	foreach($files as $k=>$v)
    		self::setPostData("$k",'Uploads/'.$v['savepath'].$v['savename']);
    	
    }
    
    public function setPostData($key,$value)
    {
    	$this->postData[$key] = $value;
    }
    
    public function uploadAction(){
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     3145728 ;// 设置附件上传大小
    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','rar','zip');// 设置附件上传类型
    	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    	$upload->savePath  =     ''; // 设置附件上传（子）目录
    	// 上传文件
    	$info   =   $upload->upload();
    	if(!$info) {// 上传错误提示错误信息
    		$this->error($upload->getError());
    	}else{// 上传成功
    		return $info;
    	}
    }
    

    
    public function checkAuth()
    {
        $auth=new Auth();  
        //var_dump(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);die;
        $result=$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$_SESSION['uid']);
        if(!$result)
            $this->error('您没有权限，请联系管理员');
    }
}