<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
use Common\Model\Goods;
/**
 * 
 * -----商品控制器
 * 2015/11/27
 * 
 */

class GoodsController extends CommonController{
	private $model;
	public function __init(){
		parent::__init();
		$this->model = new Goods;
	}

	public function index(){
		
		//统计当前页面一共有多少个数据
		$count = $this->model->count();
		//分页，每页7条
		$page = Page::row(6)->make($count);
		//获得数据
		$data = $this->model->limit(Page::limit())->get();
		//分配总数给页面
		View::with('count',$count);
		//分配分页
		View::with('page',$page);
		//分配数据给页面
		View::with('data',$data);
		View::make();
	}
	
	
	//添加
	public function add(){
		if(IS_POST){
			if(!$this->model->store())	View::error($this->model->getError());
			View::success('添加成功',U('index'));
		}
	
		//获得所有的分类
		$cateData = Db::table('category')->get();
		$cateData = Data::tree($cateData,'cname');
		View::with('cateData',$cateData);
		//获得所有的品牌u
		$brands = Db::table('brand')->get();
		View::with('brands',$brands);
		View::make();
	}
	
	
	//异步获得属性
	public function ajaxGetAttr(){
		if(IS_AJAX){
			//通过类型id获得类型属性
			$tid = Q('post.tid',0,'intval');
			$data = Db::table('type_attr')->where("type_tid={$tid}")->get();
			//如果有类型属性
			foreach ((array)$data as $k => $v) {
				//把tavalue字符串变为数组
				$data[$k]['tavalue'] = explode('|', $v['tavalue']);
			}
			echo json_encode($data);
			exit;
		}	
	}
	
	//修改
	public function edit(){
		//获得当前的gid
		$gid = Q('get.gid',0,'intval');
		//修改新提交的数据
		if(IS_POST){
			//p(Q('post.'));exit;
			if(!$this->model->edit($gid))	View::error($this->model->getError());
			View::success('修改成功',U('index'));
		}
		
		//获得旧的数据
		$oldData = $this->model->where("gid={$gid}")->find();
		//分配到页面
		View::with('oldData',$oldData);
		
		
		//获取商品详情的内容
		$Detail = new \Common\Model\Detail;
		//获得旧数据
		$oldDetail = $Detail->where("gid={$gid}")->find();
		//将图册的字符串压成数组循环出来
		$oldDetail['photos'] = explode(',', $oldDetail['photo']);

		//sp($oldDetail);
		//分配到页面
		View::with('oldDetail',$oldDetail);
		
		
		//获得所有的分类
		$cateData = Db::table('category')->get();
		$cateData = Data::tree($cateData,'cname');
		View::with('cateData',$cateData);
		
		
		//获得所有的品牌
		$brands = Db::table('brand')->get();
		View::with('brands',$brands);
		
		
		//获得商品属性的内容
		$goodsAttr = new \Common\Model\GoodsAttr;
		//获得旧数据
		$oldAttr = $goodsAttr->join('type_attr','type_attr.taid','=','goods_attr.taid')->where("gid={$gid} AND class=0")->get();
		
		foreach ((array)$oldAttr as $k => $v) {
			//把tavalue字符串变为数组
			$oldAttr[$k]['tavalue'] = explode('|', $v['tavalue']);
		}
		//分配到页面
		View::with('oldAttr',$oldAttr);
		
		
		//获得商品规格的内容
		$oldSpec =  $goodsAttr->join('type_attr','type_attr.taid','=','goods_attr.taid')->where("gid={$gid} AND class=1")->get();
		foreach ((array)$oldSpec as $k => $v) {
			//把tavalue字符串变为数组
			$oldSpec[$k]['tavalue'] = explode('|', $v['tavalue']);
		}
		//分配到页面
		View::with('oldSpec',$oldSpec);

		
		View::make();
	}
	
	//删除
	public function del(){
		//接收要删除的gid
		$gid = Q('get.gid',0,'intval');
		//执行删除
		$this->model->del($gid);
		//返回成功提示
		View::success('删除成功');
	}
	
	public function upload(){
	    $file = Upload::path('Upload/Content/' . date('y/m'))->make();
	    if (empty($file)) {
	        $this->ajax(Upload::getError());
	    } else {
	        /** $file内部就是以下这个数组
	            $file = array(
	                0 => array(
	                'path' => 'Upload/Content/15/8/123981239172.jpg'    ,
	                'url' => 'http://localhost/cms_edu/Upload/Content/15/8/123981239172.jpg',
	                'image' => 1
	            ),
	        );**/
        //上传成功，把上传好的信息返给js
        $data = $file[0];
        echo json_encode($data);exit;
    }
}
	
}
?>