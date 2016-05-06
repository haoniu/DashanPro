<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 货品列表属性模型
 * 2015/12/01
 * 
 */
class GoodsList extends Model{
	//指定一个表名
	protected $table = "goods_list";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		
	);
	
	public function store(){
		//先验证
		if(!$this->create()) return false;
		//将提交的数据转成字符串
		$array = Q('post.combine');
		$combine = implode ("," , $array);
		//替换提交的数据
		if (Db::table('goods_list')->where('combine', '=', $combine)->first()) {
			$this->error = '组合属性存在';
			return false;
		}
		//商品的规格属性
		$this->data['combine'] = $combine;
		//执行添加
		$this->add();
		
		//接收到要添加的gid
		$gid = Q('post.gid');
		//查找出所有的商品数据
		$nData = $this->where("gid={$gid}")->get();
		//初始化总数量为0
		$allNum = 0;
		//执行把所有的商品数量加起来放到数据库
		foreach ($nData as $k => $v) {
			$allNum += $v['inventory'];
		}
		//将加起来的数据存入总的库存中
		$goodsModel = new \Common\Model\Goods;
		$goodsModel->where("gid={$gid}")->save(array('gnumber'=>$allNum));
		
		
		return TRUE;
	}
	
	
	public function del($glid){
		//获得到这条glid的数据
		$data = $this->where("glid={$glid}")->find();
		//获得到对应的gid
		$gid = $data['gid'];
		//获得到对应的库存数量
		$num = $data['inventory'];
		//获得到对应商品的总库存
		$goodsModel = new \Common\Model\Goods;
		$oldNum = $goodsModel->where("gid={$gid}")->field("gnumber")->find();
		//得到新的库存
		$newNum = $oldNum['gnumber'] - $num;
		//将新的库存存入
		$goodsModel->where("gid={$gid}")->save(array('gnumber'=>$newNum));
		
		if(!$this->where("glid={$glid}")->delete())	return FALSE;
		return TRUE;
	}
	
	public function edit($glid){
		//先验证
		if(!$this->create()) return FALSE;
		//将提交的数据转成字符串
		$array = Q('post.combine',0,'intval');
		$combine = implode ("," , $array);
		//替换提交的数据
		$this->data['combine'] = $combine;
		//执行修改
		$this->where("glid={$glid}")->save();
		return TRUE;
	}
}
?>	