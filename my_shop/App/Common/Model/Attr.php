<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 类型属性模型
 * 2015/11/25
 * 
 */
class Attr extends Model{
	//指定一个表名
	protected $table = "type_attr";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		array('taname','required','属性名不能为空',3,3),
	);
	
	public function store($tid){
		//先执行判断
		if(!$this->create())	return FALSE;
		//把tid压入数据库中
		$this->data['type_tid'] = $tid;
		//添加到数据库
		$this->add();
		return TRUE;
	}
	
	public function edit($taid){
		//先执行验证
		if(!$this->create())	return FALSE;
		//执行修改
		$this->where("taid={$taid}")->save();
		//返回正确
		return TRUE;
	}
	public function del($taid){
		//执行删除
		$this->where("taid={$taid}")->delete();
		//返回正确
		return TRUE;
	}
}



?>