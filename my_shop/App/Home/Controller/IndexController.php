<?php namespace Home\Controller; 
use Common\Model\Category;
use Common\Model\Goods;
/**
 * 
 * 首页控制器
 * 2015/12/13
 * 2015/12/21修改
 * 
 */
class IndexController extends CommonController{

	
    //动作
    public function index(){
    	$goodsModel = new Goods;
		//新建一个模型
		$categotyModel = new Category;
		//先获得所有的顶级分类
		$categotyData = $categotyModel->get();
		//获得所有的分类
		$cateArr = Data::channelLevel($categotyData);
		
		
		
		$gids = array();
		$allData = array();
		//获得每个顶级分类下的商品
		foreach ($cateArr as $v) {
			$gids[] = $this->cidGetGid($v['cid']);
		}
		//循环找到商品
		foreach ($gids as $k => $v) {
			if(!empty($v)){
				$allData[$k+1] = $goodsModel->where("gid in(". implode(',', $v) .")")->get();
			}
		}
		
		
		
		//sp($allData);
		View::with('allData',$allData);
		View::with('cateArr',$cateArr);
    	View::make();
    }
	
	
	//通过cid找到对应的gid（商品的id）------------------------------------------------------------------------------------
    private function cidGetGid($cid){
    	//查找到所有的分类数据
    	$categoryData = Db::table('category')->get();
        //调取当前分类的所有子分类
        $cids = $this->getSon($categoryData,$cid);
		//把自己也传到这个数组中去
        $cids[] = $cid;
        //通过分类id获得商品id
        $gids = Db::table('goods')->where("cid in(" . implode(',', $cids) . ")")->lists('gid');
        return $gids;
    }
	
	
	//获得自己的子分类
	private function getSon($data,$cid){
		//定义一个空数组
		$temp = array();
		//遍历循环找子集
		foreach ($data as $v) {
			//如果找到子集,进行赋值
	        if($v['pid'] == $cid){
	            $temp[] = $v['cid'];
	            $temp = array_merge($temp,$this->getSon($data,$v['cid']));
	        }
		}
		return $temp;
	}
	
	
	
}
