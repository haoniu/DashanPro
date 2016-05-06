<?php
namespace Common\Model;
use Think\Model;
/**
 * 分类模型
 */
class CategoryModel extends Model{

    // 验证规则
    protected $_validate = array(
        array('cname','require','分类名称不能为空'),
        array('ctitle','require','分类标题不能为空'),
        );

    /**
     * 添加数据
     * @return     boolean         
     */
    public function addData(){
        // 触发自动验证
        if (!$this->create()) return false;
        return $this->add();
    }
    
    /**
     * 修改数据
     * @param    array    $cid    where语句数组形式 
     * @return    boolean            操作是否成功
     */
    public function editData($cid){
        // 触发自动验证
        if(!$this->create()) return false;
        $this
            ->where(array('cid'=>$cid))
            ->save();
        return true;
    } 
    /**
     * 删除数据
     * @param           $cid    where语句数组形式
     * @return    boolean            操作是否成功
     */
    public function deleteData($cid){
        $this->where("cid=$cid")->delete();
        return true;
    }

    /**
     * 获取所有数据
     * @return    array        所有数据
     */
    public function getAllData(){
        $data = $this
            ->order('csort')
            ->select();
            
        return $data;
    }
    /**
     * 根据cid获取数据
     * @param        $cid   
     * @param        $m     方法名   
     * @return boolean 操作是否成功
     */
    public function getDataBycid($cid,$m='edit'){
        $data = $this->where(array('cid'=>$cid))->find();
        if ($m=='addSon') {
            $data = $this
                ->where(array('cid'=>$cid))
                ->field('cname,cid')
                ->find();
        }
        return $data;

    }
    /**
     * 获取除自己和子级以外的其他分类
     */
    public function getNoMine($cid){
        // 1.获得自身和自身的所有子集的cid
        $cids=$this->getSon($this->select(),$cid);
        // 压入自身的cid
        $cids[]=$cid;
        // 2.排除它们(获取除它们以外的分类)
        $data=$this->where("cid NOT IN(" . implode(',',$cids) . ")")->select();
        // 树状结构
        $data = \Org\Bjy\Data::tree($data,'cname');
        return $data;
    }
    /**
     * 获取所有子级cid
     * @param  [array] $data [所有数据]
     * @param  [num]   $cid  [当前分类cid]
     * @return [array] $temp  [当前分类下的所有子分类]
     */
    public function getSon($data,$cid){
        //定义静态变量
        static $temp = array();
        // 遍历所有数据
        foreach ($data as $v) {
            // 如果pid等于当前分类cid,就压入数组
            if($v['pid'] == $cid){
                //把找到的子集的cid压入数组
                $temp[] = $v['cid'];
                //递归
                $this->getSon($data,$v['cid']);
            }
        }
        return $temp;
    }

}