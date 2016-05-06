<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 首页控制器
 */
class IndexController extends CommonController {

    public function index(){

        // 1.获取全部分类
        $cateData = $this->cateData;
        // 2.获取全部文章[关联标签表]
        $arcData = D('Article')->getIndexData();
        $assign=array(
            'cateData'=>$cateData,
            'arcData'=>$arcData,
            );
        $this->assign($assign);

        $this->display();
    }
}