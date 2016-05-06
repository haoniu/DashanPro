<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;
use Common\Model\Goods;
use Common\Model\Category;
use Common\Model\Brand;
/**
 * 
 * ---------列表控制器
 * 2015/12/02
 * 2015/12/13 修改
 * 
 */
class ListController extends CommonController{

    //动作
    public function index(){
    	//实例化一个goods模型
    	$goodsModel = new Goods;
		$categoryModel = new Category;
		$brandModel = new Brand;
		//获取当前的cid
		$cid = Q('get.cid',0,'intval');
		
		//通过当前的cid来找到父级的cid
		$cids = $categoryModel->get();
		
		function getFatherCid($cids,$cid){
			static $list = array();
			foreach($cids as $k=>$v){
				if($v['cid'] == $cid){
					getFatherCid($cids,$v['pid']);
					$list[$k]['cname'] = $v['cname'];
					$list[$k]['cid'] = $v['cid'];
				}
			}
			return $list;
		}
		$fcids = getFatherCid($cids,$cid);
		
		//通过cid获得所有的gid
		$gids = $this->cidGetGid($cid);
		//根据所获得到的gid来找出相对应的商品-----------------------------------------------------
		if($gids){
			$goodsData = $goodsModel->where("gid in(". implode(',', $gids) .")")->get();
		}
		
		//在根据所获得到的gid来找到商品所对应的属性---------------------------------------------------
		$goodsAttr = $this->getGoodsAttr($gids);
		
		
		//筛选地址处理,先统计当前的属性有多少种--------------------------------------------------
		$num = count($goodsAttr);
		//判断是否存在当前属性
		if($num){
			$param = isset($_GET['param']) ? explode('_', $_GET['param']) : array_fill(0, $num, 0);
		}else{
			$param = array();
		}

		//通过地址栏里面的参数来筛选商品-------------------------------------------------
		$finalGids = $this->filterGid($param,$gids);
		if($finalGids){
			$goodsData = $goodsModel->where("gid in(". implode(',', $finalGids) .")")->get();
		}else{
			$goodsData = array();
		}	

		//获得所有的品牌
		$brandData = $brandModel->get();
		
		
		//获得当前的热销商品
		$hotShop = $goodsModel->orderby('click','desc')->limit(5)->get();
		
		
		//品牌信息
		View::with('brandData',$brandData);
		//商品信息
		View::with('goodsData',$goodsData);
		//商品属性信息
		View::with('goodsAttr',$goodsAttr);
		//参数信息
		View::with('param',$param);
		//热销产品
		View::with('hotShop',$hotShop);
		//父级的cids
		View::with('fcids',$fcids);
		
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
	
	
	
	//获得到自己的子分类--------------------------------------------------------------------------------------------------
	private function getSon($data,$cid){
		$temp = array();
        foreach ($data as $v) {
            //如果找到子集,进行赋值
	        if($v['pid'] == $cid){
	            $temp[] = $v['cid'];
	            $temp = array_merge($temp,$this->getSon($data,$v['cid']));
	        }
        }
        return $temp;
	}
	
	
	//通过gid来找商品的属性--------------------------------------------------------------------------------------------------
	private function getGoodsAttr($gids){
		//如果当前分类有商品就找到商品，否则返回一个空数组
		if($gids){
			//先简单的得到当前商品所拥有的属性,就是把相同类型的商品归结到一起
			$goodsAttr = Db::table('goods_attr')->where("gid in(". implode(',', $gids) .")")->groupby("gtvalue")->get();
			//然后把对应的属性id拿到，组成一个初始数组,目的是为了好查找到taid
			$temp1 = array();
			foreach ($goodsAttr as $v) {
				$temp1[$v['taid']][] = $v;
			}
			//然后组成新的数组把属性名字和值组出来
			$temp2 = array();
			foreach ($temp1 as $taid=>$value){
				//找到taid所对应的taname名字
				$name = Db::table('type_attr')->where("taid={$taid}")->pluck('taname');
				//组成新的数组
				$temp2[] = array(
					'name' => $name,
					'value' => $value
				);
			}
			return	$temp2;
			
		}else{
			return array();
		}
		
	}
	
	
	//通过地址栏的参数来找到对应的商品----------------------------------------------------------------------------------------
	private function filterGid($param,$cidGids){
        $gids = array();
        foreach ($param as $gtid) {
            //如果不是”不限“的时候
            if($gtid){
                //通过taid获得属性的名称
               $name = Db::table('goods_attr')->where("gtid={$gtid}")->pluck('gtvalue');
               //通过属性名称查找商品gid
               $gids[] = Db::table('goods_attr')->where("gtvalue='{$name}'")->lists('gid');
            }
        }
        //如果有点击任何一个筛选属性的时候
        if($gids){
            //把获得好的商品gid取交集
            $gidsOne = $gids[0];
            foreach ($gids as $v) {
                $gidsOne = array_intersect($v, $gidsOne);
            }
            //再和分类查找出来的$cidGids取交集
            $finalGids = array_intersect($gidsOne, $cidGids);
            return $finalGids;
        }else{//如果全部点击不限的时候
            return $cidGids;
        }
       
    }

	
}
