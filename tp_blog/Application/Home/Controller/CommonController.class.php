<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 公共控制器
 */
class CommonController extends Controller{
    protected $cateData;
    /**
     * 初始化
     */
    public function _initialize(){
        $this->cateData = D('Category')->getAllData();
    }

}