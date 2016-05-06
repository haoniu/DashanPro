<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 商品类型模型
 * 2015/11/25----上午
 * 
 */
class Type extends Model{
	//指定一个表名
	protected $table = 'type';
	//定义验证的规则
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		array('tname','required','类型不能为空',3,3),
	);
	
	
	
	//添加
	public function store(){
		//先执行验证
		if(!$this->create())	return FALSE;
		//执行添加
		$this->add();
		//返回成功信息
		return TRUE;	
	}
	
	
	//修改
	public function edit($tid){
		//先执行验证
		if(!$this->create())	return FALSE;
		//执行修改
		$this->where("tid={$tid}")->save();
		//返回正确
		return TRUE;
	}
	
	
	//删除
	public function del($tid){
		//执行删除
		$this->where("tid={$tid}")->delete();
		//返回正确
		return TRUE;
	}
}

?>