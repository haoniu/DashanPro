<?php
namespace Common\Model;
use Think\Model;
/**
 * 标签模型
 */
class TagModel extends Model{

    // 自动验证
    protected $_validate=array(
        array('tname','require','请输入标签'), //默认情况下用正则进行验证
    );

    /**
     * 添加
     */
    public function addData($tnames){
        // 对data数据进行验证
        if(!$data=$this->create($data)){
            // 验证不通过返回错误
            return false;
        }else{
            // 验证通过
            $tnames = explode('|', $tnames);
            foreach ($tnames as $t) {
                $this->add(array('tname'=>$t));
            }
            return true;
        }
    }
    /**
     * 修改标签
     */
    public function editData($tid){
        if (!$this->create()) return false;
        $this->where(array('tid'=>$tid))->save();
        return true;
    }
    /**
     * 删除标签
     */
    public function deleteData($tid){
        
        $this->delete($tid);
    }

    /**
     * 获取所有数据
     * @return [array] [所有数据]
     */
    public function getAllData(){
        $data = $this->select();
        return $data;
    }
    /**
     * 根据tid获取数据
     */
    public function getDataBytid($tid){
        $data = $this
            ->where(array('tid'=>$tid))
            ->find();
        return $data;
    }
    

}