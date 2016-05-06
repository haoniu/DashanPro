<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
use Common\Model\Category;
use Common\Model\Type;
/**
 * 
 * -----分类控制器
 * 2015/11/26
 * 2015/12/23---修复子类不能编辑类型，有商品删除问题
 * 
 */
class CategoryController extends CommonController{
	protected $model;
	public function __init(){
		parent::__init();
		$this->model = new Category;
	}

	public function index(){
		//获取数据
		$data = $this->model->get();
		//将数据变成树状结构
		$data = Data::tree($data,'cname');
		//找到对应的分类下是否有商品
//		foreach($data as $k => $v){
//			$data[$k]['totle'] = Db::table('goods')->where("cid={$v['cid']}")->count();
//		}
		//将数据分配给页面
		View::with('data',$data);
		View::make();
	}
	
	
	//添加分类
	public function add(){
		if(IS_AJAX){
			//调用模型的保存操作
			if(!$this->model->store()){
				echo json_encode(array('status'=>false,'message'=>$this->model->getError()));
			}else{
				echo json_encode(array('status'=>true,'message'=>'添加成功'));
			}
			exit;
		}
		View::make();
	}
	
	//修改分类
	public function edit(){
		$cid = Q('get.cid',0,'intval');
		if(IS_AJAX){
			//调用模型的保存操作
			if(!$this->model->edit()){
				echo json_encode(array('status'=>false,'message'=>$this->model->getError()));
			}else{
				echo json_encode(array('status'=>true,'message'=>'修改成功'));
			}
			exit;
		}
		//获取旧内容
		$oldData = $this->model->where("cid={$cid}")->find();
		//将旧内容分配给页面
		View::with('cid',$cid);
		View::with('oldData',$oldData);
		
		//2.获得“所属分类”的数据（调用模型自定义方法）
		$cateData = $this->model->getNoMine($cid);
		View::with('cateData',$cateData);
		
		
		//3.获得分类的属性数据
		//找到当前分类的属性tid
		$type_tid = $this->model->where("cid={$cid}")->pluck('type_tid');
		//实例化一个category
		$typeModel = new Type;
		
		//获得到所有的属性类型
		$allType = $typeModel->get();
		
		//分配所有的类型和类型的id
		View::with('allType',$allType);
		View::with('type_tid',$type_tid);
		View::make();
	}
	
	
	//删除分类
	public function del(){
		//接收要删除的cid
		$cid = Q('get.cid',0,'intval');
		if(!$this->model->del($cid))	View::error($this->model->getError());
		View::success('删除成功！');
	}
	
	
	//添加子分类
	public function addSon(){

		if(IS_AJAX){
			//调用模型的保存操作
			if(!$this->model->addSon()){
				echo json_encode(array('status'=>false,'message'=>$this->model->getError()));
			}else{
				echo json_encode(array('status'=>true,'message'=>'添加成功'));
			}
			exit;
		}

		//获得当前的cid
		$cid = Q('get.cid',0,'intval');
		//获取父级的分类
		$fatherCate = $this->model->where("cid={$cid}")->field('cname,cid')->find();
		//将这个父级分类分配给页面
		View::with('fatherCate',$fatherCate);
		
		//获得类型分类，实例化一个type
		$typeModel = new Type;
		//获得所有的类型
		$allType = $typeModel->field('tid,tname')->get();
		//将这些类型传到页面
		View::with('allType',$allType);
		
		View::make();
	}
	
	
	
	
	
	
	
}



 ?>