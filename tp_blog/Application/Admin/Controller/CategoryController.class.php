<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 分类控制器        
 */
class CategoryController extends CommonController{

    private $cate;
    /**
     * 初始化
     */
    public function _initialize(){
        parent::_initialize();
        $this->cate = D('Category');
    }
    /**
     * 显示分类主页
     */
    public function index(){
        // 获取表中所有数据
        $data = $this->cate->getAllData();
        // 统计该分类的文章数，通过判断有没有文章决定是否显示删除按钮
        foreach ($data as $k => $v) {
            $data[$k]['total'] = M('Article')->where("category_cid={$v['cid']}")->count();
        }
        // 树状结构
        $data= \Org\Bjy\Data::tree($data,'cname');

        // 如果没有数据提示先添加
        if (!$data) $this->success('请先添加分类',U('add'));
        // 分配到页面
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);

        $this->display();
    }
    /**
     * 添加分类
     */
    public function add(){
        if (IS_POST) {
            // 添加
            if (!$this->cate->addData()) {
                $this->error($this->cate->getError());
            }
            $this->success('添加成功',U('index'));
        }
        $this->display();
    }
    /**
     * 添加子类
     */
    public function addSon(){
        // 当有提交的时候
        if (IS_POST) {
            // 验证不通过就报错
            if (!$this->cate->addData()) {
                $this->error($this->cate->getError());
            }
            $this->success('添加成功',U('index'));
        }
        $cid = I('get.cid',0,'intval');
        // 获取父级分类的cid字段和cname字段
        $fatherCate=$this->cate->getDataByid($cid,'addSon');
        // 分配到页面
        $assign=array(
            'fatherCate'=>$fatherCate
            );
        $this->assign($assign);

        $this->display();

    }
    /**
     * 编辑分类
     */
    public function edit(){

        // 3.修改
        if (IS_POST) {
            // 接收隐藏域的cid
            if (!$this->cate->editData(I('post.cid'))) {
                $this->error($this->cate->getError());
            }
            $this->success('修改成功',U('index'));
        }

        $cid = I('get.cid',0,'intval');
        // 1.获取旧数据
        $oldData = $this->cate->getDataBycid($cid);
        // 2.获得“所属分类”的数据（调用模型自定义方法）
        $cateData = $this->cate->getNoMine($cid);

        // 分配到页面
        $assign=array(
            'oldData'=>$oldData,
            'cateData'=>$cateData
            );
        $this->assign($assign);

        $this->display();
    }
    /**
     * 删除分类
     */
    public function del(){
        // 删除
        $this->cate->deleteData(I('get.cid',0,'intval'));
        // 跳转
        $this->redirect('index');
    }


}