<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * -----货品模型
 *  2015/11/27
 * 
 */
class Goods extends Model{
	//指定一个表名
	protected $table = "goods";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		array('gname','required','商品名不能为空',3,3),
		array('unit','required','商品单位不能为空',3,3),
		array('marketprice','required','商品市场价格不能为空',3,3),
		array('shopprice','required','商城价格不能为空',3,3),
	);
	//自动完成(在页面表单无法处理的时候使用，通过create来触发)
	protected $auto=array(
        array('sendtime','time','function',3,1)
    );
	
	
	//添加方法
	public function store(){
		$Detail = new \Common\Model\Detail;		
		//验证模型
		if(!$this->create())	return FALSE;
		//接收详细信息数据验证
		if(!$Detail->create()){
			$this->error = $Detail->getError();
			return FALSE;
		}
		
		//返回一个自增的gid
		$gid = $this->add();
				
		//先新建一个商品类型的模型
		$GoodsAttr = new \Common\Model\GoodsAttr;
		
		//接收attr数据
		foreach (Q('post.attr',array()) as $taid => $value){
			if(!empty($value)){
				$data = array(
					'gtvalue' => $value,
					'taid' => $taid,
					'gid' => $gid
				);
				$GoodsAttr->add($data);
			}				
		}
		//接收spec数据
		foreach (Q('post.spec',array()) as $taid => $array){
			foreach($array['value'] as $k => $v){
				if(!empty($v)){
					$data = array(
						'taid' => $taid,
						'gid' => $gid,
						'gtvalue' => $v,
						'added' => $array['price'][$k]
					);
					$GoodsAttr->add($data);
				}	
			}
		}
		
		//压入当前的gid
		$Detail->data['gid'] = $gid;
		//接收传入的图册
		$photos = Q('post.photo',array());
		//将数组转成字符串
		$photos = implode ("," , $photos);
		//压入
		$Detail->data['photo'] = $photos;
		$Detail->add();
		
		return TRUE;	
	}
	
	
	public function del($gid){
		//1.删除商品
		$this->delete($gid);
		//2.删除商品属性表
		(new \Common\Model\GoodsAttr)->where("gid={$gid}")->delete();
		//3.删除商品信息表
		(new \Common\Model\Detail)->where("gid={$gid}")->delete();
		//4.删除对应的货品列表
		(new \Common\Model\GoodsList)->where("gid={$gid}")->delete();
	}
	
	public function edit($gid){
		$Detail = new \Common\Model\Detail;		
		//验证模型
		if(!$this->create())	return FALSE;
		//接收详细信息数据验证
		if(!$Detail->create()){
			$this->error = $Detail->getError();
			return FALSE;
		}
		$this->where("gid={$gid}")->save();
		
		
		//先新建一个商品类型的模型
		$GoodsAttr = new \Common\Model\GoodsAttr;
		//先删除attr数据然后添加
		$GoodsAttr->where("gid={$gid}")->delete();
		//接收attr数据
		foreach (Q('post.attr',array()) as $taid => $value){
			if($value){
				$data = array(
					'gtvalue' => $value,
					'taid' => $taid,
					'gid' => $gid
				);
				$GoodsAttr->add($data);
			}				
		}
		//接收spec数据
		foreach (Q('post.spec',array()) as $taid => $array){
			if($array){
				foreach($array['value'] as $k => $v){
					$data = array(
						'taid' => $taid,
						'gid' => $gid,
						'gtvalue' => $v,
						'added' => $array['price'][$k]
					);
					$GoodsAttr->add($data);
				}
			}
		}
		
		
		
		//先删除原来detail的数据
		$Detail->where("gid={$gid}")->delete();
		//压入当前的gid
		$Detail->data['gid'] = $gid;
		//接收传入的图册
		$photos = Q('post.photo',array());
		//将数组转成字符串
		$photos = implode ("," , $photos);
		//压入
		$Detail->data['photo'] = $photos;
		$Detail->add();
		
		return TRUE;	
		
		
	}
}
?>