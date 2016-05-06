<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 文章控制器
 */
class ArticleController extends CommonController{
    /**
     * 显示页面
     */
    public function index(){

        // 获取全部数据
        $data = D('Article')->getAllData();
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);
        
        $this->display();
    }

    /**
     * 添加文章
     */
    public function add(){
        if (IS_POST) {

            if (D('Article')->addData()) {
                $this->success('添加成功',U('index'));
            }
            $this->error(D('Article')->getError());
        }
        // 1.获取全部分类
        $cateData = D('Category')->getAllData();
        $cateData = \Org\Bjy\Data::tree($cateData,'cname');
        // 2.获取全部标签
        $tagData = D('Tag')->getAllData();
        // 分配变量
        $assign=array(
            'cateData'=>$cateData,
            'tagData'=>$tagData,
            );
        $this->assign($assign);
        $this->display();
    }
    /**
     * 编辑页面
     */
    public function edit(){

        if (IS_POST) {
            if (!D('Article')->editData(I('post.aid',0,'intval'))) {
                $this->error(D('Article')->getError());
            }
            $this->success('修改成功',U('index'));
        }

        $aid = I('get.aid',0,'intval');
        // 1.获取当前
        $oldData = D('Article')->getDataByaid($aid);
        // 2.获取全部分类
        $cateData = \Org\Bjy\Data::tree(D('Category')->getAllData(),'cname');
        // 3.获取全部标签
        $tagData = M('Tag')->select();
        // 4.当前文章的标签
        $tids = M('Article_tag')->where(array('article_aid'=>$aid))->field('tag_tid')->select();
        $temp = array();
        foreach ($tids as $k => $v) {
            $temp[] = $v['tag_tid'];
        }

        // 分配变量
        $assign=array(
            'oldData'=>$oldData,
            'cateData'=>$cateData,
            'tagData'=>$tagData,
            'tids'=>$temp,
            );
        $this->assign($assign);

        $this->display();
    }
    /**
     *  回收
     */
    public function recycle(){
        D('Article')->recycleData(I('get.aid',0,'intval'));
        $this->redirect('index');
    }
    /**
     * 回收站页面
     */
    public function rubbish(){
        $redata = D('Article')->getRubbishData();
        $assign=array(
            'redata'=>$redata
            );
        $this->assign($assign);
        $this->display();
    }
    /**
     * 还原
     */
    public function recover(){
        D('Article')->recoverData(I('get.aid',0,'intval'));
        $this->redirect('rubbish');
    }
    /**
     * 删除
     */
    public function del(){
        D('Article')->deleteData(I('get.aid',0,'intval'));
        $this->redirect('rubbish');

    }


}