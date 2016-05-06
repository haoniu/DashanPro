<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 品牌模型
 * 2015/11/26
 * 
 */
class Brand extends Model{
	//指定一个表名
	protected $table = "brand";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		array('bname','required','品牌名不能为空',3,3),
        array('sort','required','排序不能为空',3,3),
	);
	//上传的图片需要执行自动完成
	protected $auto = array(
		//1.字段名，2.自定义方法名，3.以什么方式处理，4.处理条件 5.处理的时机
		array('logo','image','method',3,3)
	);
	//上传图片自动的完成方法
	public function image(){
		//如果有旧图片地址
		if($oldImg = Q('post.logo')){
			return $oldImg;
		}
		//定义好上传的目录
		$uploadDir = 'Upload/' . date('ymd') . '/logo_pic';
		//上传文件
		$file = Upload::type('jpg,png,gif')->path($uploadDir)->size(2000000)->make();
		//如果上传成功则把图片进行缩略
		if($file){
			//图片进行缩略-----1.上传图片的路径，2.缩略图的名字，3.width,4.height,5,缩略的方式
			$path = Image::thumb($file[0]['path'],$uploadDir . '/thumb_' . $file[0]['basename'],70,30,6);
			//返回一个图片地址给数据库
			return $path;
		}
		return '';
	}
	
	
	//添加的方法
	public function store(){
		//先验证
		if(!$this->create())	return FALSE;

		//如果有文件上传
		if(!empty($_FILES['logo'])){
			if($_FILES['logo']['error'] != 4){
				//如果上传有错误
				if($error = Upload::getError()){
					$this->error = $error;
					return false;
				}
			}
		}
		
		//执行添加
		$this->add();
		return TRUE;
	}
	
	
	//删除方法
	public function del($bid){
		//执行删除
		if($this->where("bid={$bid}")->delete())	return FALSE;
		//返回成功
		return TRUE;
	}
	
	
	//修改方法
	public function edit($bid){
		//先验证
		if(!$this->create())	return FALSE;
		
		//如果有文件上传
		if(!empty($_FILES['logo'])){
			if($_FILES['logo']['error'] != 4){
				//如果上传有错误
				if($error = Upload::getError()){
					$this->error = $error;
					return false;
				}
			}
		}
		//执行修改操作
		$this->where("bid={$bid}")->save();
		return TRUE;
	}
	
	
	
}	
?>