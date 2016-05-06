<?php
namespace Common\Model;
use Think\Model;
/**
 * 文章模型
 */
class ArticleModel extends Model{

    // 自动验证
    protected $_validate=array(
        array('title','require','标题不能为空'), 
    );
    // 自动完成
    protected $_auto=array(
        array('sendtime','time',1,'function'),
        array('updatetime','time',2,'function'),
        array('user_uid','aid',1,'callback'),
        array('thumb','image',3,'callback')
    );
    /**
     * 自动压入缩略图
     */
    public function image(){
        //如果有旧图片地址，就直接返回
        if($oldImg = I('post.thumb')){
            return $oldImg;
        }
        // 配置信息
        $config = array(
        'maxSize' => 3145728,
        'savePath' => 'upload/',
        'saveName' => array('uniqid',''),
        'exts' => array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub' => true,
        'subName' => array('date','Ymd'),
        );
        // 上传
        $upload = new \Think\Upload($config);
        $info = $upload->upload();

        // 提示
        if($info){
            // 缩略
            $img = new \Think\Image();
            $img->open('./Uploads/' . $info['thumb']['savepath'].$info['thumb']['savename']);
            // 拼接缩略路径
            $path = 'Uploads/' . $info['thumb']['savepath'] . 'thumb_' . $info['thumb']['savename'];
            $img->thumb(200, 200,6)->save($path);

            return $path;
        }
        return '';

    }
    /**
     * 自动压入uid
     */
    public function aid(){
        return session('aid');
    }



    /**
     * 添加
     */
    public function addData(){

        if (!$this->create()) return false;
        if (!M('Article_data')->create()) return false;
        // 1.添加到文章表（返回aid）
        $aid = $this->add();

        // 2.添加到article_data
        M('Article_data')->data['article_aid'] = $aid;
        M('Article_data')->add();

        // 3.添加到article_tag
        foreach (I('post.tid',array()) as $tid) {
            // 把数据存入数组
            $data = array(
               'article_aid' => $aid,
               'tag_tid'     =>$tid
            );
            M('Article_tag')->add($data);
        }
       
        return true;
    }
    /**
     * 修改
     */
    public function editData($aid){
        // 自动验证
        if (!$this->create()) return false;
        if (!M('Article_data')->create()) return false;
        // 1.修改文章表
        $this->where(array('aid'=>$aid))->save();
        // 2.修改文章数据表
        M('Article_data')->where(array('article_aid'=>$aid))->save();
        // 3.修改文章标签表
        //(1)先删除
        M('Article_tag')->where(array('article_aid'=>$aid))->delete();
        //(2)再添加
        foreach (I('post.tid',array()) as $tid) {
            // 把数据存入数组
            $data = array(
               'article_aid' => $aid,
               'tag_tid'     =>$tid
            );
            M('Article_tag')->add($data);
        }

        return true;

    }
    /**
     * 回收
     */
    public function recycleData($aid){
        $data = array('is_recycle'=>0);
        $this->where(array('aid'=>$aid))->save($data);
        return true;
    }
    /**
     * 还原
     */
    public function recoverData($aid){
        $data = array('is_recycle'=>1);
        $this->where(array('aid'=>$aid))->save($data);
        return true;
    }
    /**
     * 删除
     */
    public function deleteData($aid){
        // 1.删除文章表
        $this->where(array('aid'=>$aid))->delete();
        // 2.删除文章数据表
        M('Article_data')->where(array('article_aid'=>$aid))->delete();
        // 3.删除文章标签表
        M('Article_tag')->where(array('article_aid'=>$aid))->delete();
    }

    /**
     * 获取全部数据
     */
    public function getAllData(){
        $data = $this
            ->order('sendtime')
            ->join('category ON article.category_cid = category.cid')
            ->where(array('is_recycle'=>1))
            ->select();
        return $data;
    }
    /**
     * 根据aid获取数据 [要关联文章数据表]
     */
    public function getDataByaid($aid,$getTag=false){

        $data = $this
            ->join('article_data ON article.aid = article_data.article_aid')
            ->where(array('aid'=>$aid))
            ->find();
        if ($getTag) {
            $data['tag'] =  M('Article_tag')
                            ->join('tag ON article_tag.tag_tid = tag.tid')
                            ->where(array('article_aid'=>$aid))
                            ->getField('tid,tname',true);
        }
        return $data;

    }
    /**
     * 获取回收站全部数据
     */
    public function getRubbishData(){
        $data = $this
            ->order('sendtime')
            ->join('category ON article.category_cid = category.cid')
            ->where(array('is_recycle'=>0))
            ->select();
        return $data;
    }

    /**
     * 前台首页获取数据[关联文章标签中间表]
     */
    public function getIndexData(){
        $data = $this
            ->order('sendtime')
            ->select();
        foreach ($data as $k => $v) {
            $data[$k]['tag'] = M('Article_tag')
                                ->join('tag ON tag.tid = article_tag.tag_tid')
                                ->where(array('article_aid'=>$v['aid']))
                                ->getField('tid,tname',true);
        }
        return $data;
    }
    /**
     * 根据cid获取数据
     */
    public function getDataBycid($cid){
        $data = $this
            ->where(array('category_cid'=>$cid))
            ->order('sendtime')
            ->select();
        foreach ($data as $k => $v) {
            $data[$k]['tag'] = M('Article_tag')
                                ->join('tag ON tag.tid = article_tag.tag_tid')
                                ->where(array('article_aid'=>$v['aid']))
                                ->getField('tid,tname',true);
        }
        return $data;
    }
    /**
     * 根据tid获取数据
     */
    public function getDataBytid($tid){
        $data = $this
            ->join('article_tag ON article.aid = article_tag.article_aid')
            ->where(array('tag_tid'=>$tid))
            ->select();
        foreach ($data as $k => $v) {
            $data[$k]['tag'] = M('Article_tag')
                                ->join('tag ON article_tag.tag_tid = tag.tid')
                                ->where(array('article_aid'=>$v['aid']))
                                ->getField('tid,tname',true);
        }
        return $data;
    }


    

}