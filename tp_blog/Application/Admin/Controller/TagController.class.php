<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 标签控制器
 */
class TagController extends CommonController{
    /**
     * 显示标签
     */
    public function index(){
        $data = D('Tag')->getAllData();
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);

        $this->display();
    }
    /**
     * 添加标签
     */
    public function add(){
        if (IS_POST) {
            $tnames = I('post.tname');
            if (!D('Tag')->addData($tnames)) {
                $this->error(D('Tag')->getError());
            }
            $this->success('添加成功',U('index'));
        }
        $this->display();
    }
    /**
     * 编辑编辑标签   
     */
    public function edit(){
        // 2.提交
        if (IS_POST) {
            if (D('Tag')->editData(I('post.tid',0,'intval'))) {
                $this->success('修改成功',U('index'));
            }
            $this->error(D('Tag')->getError());
        }
        // 1.获取旧数据
        $oldData = D('Tag')->getDataBytid(I('get.tid',0,'intval'));

        $assign=array(
            'oldData'=>$oldData
            );
        $this->assign($assign);
        
        $this->display();
    }
    /**
     * 删除标签
     */
    public function del(){
        D('Tag')->deleteData(I('get.tid',0,'intval'));
        $this->redirect('index');

    }

}