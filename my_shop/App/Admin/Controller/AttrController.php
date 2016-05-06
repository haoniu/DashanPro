<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
use Common\Model\Attr;
/**
 * 
 * 属性控制器
 * 2015/11/25
 * 2015/12/23---修复修改页面跳转错误，属性没被选中情况
 * 
 */

class AttrController extends CommonController{
	private $model;
	public function __init(){
		parent::init();
		$this->model = new Attr;
	}
	
	public function index(){
		//接收tid
		$tid = Q('get.tid',0,'intval');
		//获得数据
		$data = $this->model->where("type_tid='{$tid}'")->get();
		//分配数据到页面
		View::with('tid',$tid);
		//分配数据
		View::with('data',$data);
		View::make();
	}
	
	//添加
	public function add(){
		$tid = Q('get.tid',0,'intval');
		if(IS_POST){
			if(!$this->model->store($tid))	View::error($this->model->getError());
			View::success('添加成功',U('index',array('tid'=>$tid)));
		}
		View::make();
	}
	
	//修改
	public function edit(){
		//分别获取tid和taid
		$tid = Q('get.tid',0,'intval');
		$taid = Q('get.taid',0,'intval');
		if(IS_POST){
			if(!$this->model->edit($taid))	View::error($this->model->getError());
			View::success('修改成功！',U('index',array('tid'=>$tid)));
		}
		
		//先获取旧数据
		$oldData = $this->model->where("taid={$taid}")->find();
		//将旧数据分配到页面
		View::with('oldData',$oldData);
		View::make();
	}
	
	//删除
	public function del(){
		//先获得要删除的id
		$taid = Q('get.taid',0,'intval');
		//执行删除
		if(!$this->model->del($taid))	View::error($this->model->getError());
		
		View::success('删除成功',U('index'));
	}
}
 
 
 
?>