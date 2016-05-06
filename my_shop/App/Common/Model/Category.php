<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * -----分类属性模型
 * 2015/11/26
 * 
 */

class Category extends Model{
 	//指定一个表名
	protected $table = "category";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		array('cname','required','类名不能为空',3,3),
        array('csort','required','排序不能为空',3,3),
	);
	
	//添加方法
	public function store(){
		//验证
		if(!$this->create()) return FALSE;
		$this->add();
		return TRUE;
	}
	
	
	//删除方法
	public function del($cid){
		if(!$this->where("cid={$cid}")->delete())	return FALSE;
		return TRUE;
	}
	
	
	//修改方法
	public function edit(){
		$cid = Q('post.cid');
		if(!$this->create()) return FALSE;
		$this->where("cid={$cid}")->save();
		return TRUE;
	}
	
	
	//添加子分类方法
	public function addSon(){
		//验证
		if(!$this->create()) return FALSE;
		$this->add();
		return TRUE;
	}
	
	//获得子类
	public function getSon($data,$cid){
		//定义静态变量，找到所有的子集会累加起来不丢失
		static $temp = array();
		foreach ($data as $v) {
			if($cid == $v['pid']){
				//把找到的子集的cid压入temp数组
				$temp[] = $v['cid'];
				//继续递归找子集
				$this->getSon($data,$v['cid']);
			}
		}
		return $temp;
	}
	
	public function getNoMine($cid){
		//1.获得自身和自身的所有子集的cid
		$cids = $this->getSon($this->get(),$cid);
		//压入自身的cid
		$cids[] = $cid;

		//2.排除它们
		$data = $this->where("cid NOT IN(".implode(',', $cids).")")->get();
		//打印所有的sql(调试的时候用)
		// sp($this->getQueryLog());
		//树状结构
		return Data::tree($data,'cname');
	}
}

?>