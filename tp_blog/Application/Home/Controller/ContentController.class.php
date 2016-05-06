<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 内容控制器
 */
class ContentController extends CommonController{
    /**
     * 显示内容页面
     */
    public function index(){
        $aid = I('get.aid',0,'intval');
        // 1.获取全部分类
        $cateData = $this->cateData;
        // 2.获取当前文章
        $arcData = D('Article')->getDataByaid($aid,true);

        $assign=array(
            'cateData'=>$cateData,
            'arcData'=>$arcData,
            );
        $this->assign($assign);
        $this->display();
    }

}