<?php
function getField($id,$table,$field)
{
	$m=M($table);
	$getField = $m->where('id='.$id)->getField($field);
	return $getField;
}

function changeChina($key){
    $china = array(
        'title'=>'组名',
        'status'=>'状态',
        'rules'=>'规则',
        'uid'=>'用户id',
        'group_id'=>'用户组id',
        'name'=>'节点名称',
        'sellName'=>'商户名称',
        'sellPhone'=>'商户电话',
        'firstData'=>'商户证件',
        'manageEmail'=>'主管邮箱',
        'createTime'=>'创建时间',
        'worker'=>'业务员',
        'payCode'=>'收款二维码',
        'payImage'=>'支付凭证',
        'secoudData'=>'商户素材',
        'productStart'=>'初次审核时间',
        'productEnd'=>'审核成功时间',
        'type'=>'方式',
        'id'=>'id',
        'condition'=>'附加条件',
    );
    foreach ($china as $k=>$v)
    {
        if($k == $key)
            return $v;
    }
}