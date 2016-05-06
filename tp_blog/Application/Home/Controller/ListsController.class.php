<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 列表控制器
 */
class ListsController extends CommonController{
    /**
     * 显示列表
     */
    public function index(){

        $cid = I('get.cid',0,'intval');
        $tid = I('get.tid',0,'intval');

        // 1.获取全部分类
        $cateData = $this->cateData;

        if ($tid) {
            // 2.获取当前头部
            $tag = D('Tag')->getDataBytid($tid);
            $headData = array(
                'type_name' =>$tag['tname'],
                'totalArc'  =>M('Article_tag')->where(array('tag_tid'=>$tid))->count(),
                'type'      =>'标签'
                );
            // 3.获取当前标签的文章
            $arcData = D('Article')->getDataBytid($tid);
        }

        if ($cid) {
            // 2.获取当前头部
            $cate = D('Category')->getDataBycid($cid);
            $headData = array(
                'type_name'=> $cate['cname'],
                'totalArc' => M('Article')->where(array('category_cid'=>$cid))->count(),
                'type'     => '分类'
                );
            // 3.获取当前分类的文章
            $arcData = D('Article')->getDataBycid($cid);
        }
        
        $assign=array(
            'cateData' => $cateData,
            'headData' => $headData,
            'arcData' => $arcData,
            );
        $this->assign($assign);
        $this->display();
    }

}