<?php namespace Common\Tag;
use Hdphp\View\TagBase;

class Common extends TagBase{
	/**
	 * 标签声明
	 */
    public $tags = array(
        //block说明 1：块标签  0：行标签
        'category' => array('block' => 1, 'level' => 4),

    );
	
	
	
	/**
     * 分类标签
     * @param $attr 属性
     * @param $content 内容
     * @param $hd HdView模型引擎对象
     */
    public function _category($attr, $content, &$hd){
		//分类的pid
		$pid = isset($attr['pid']) ? (int)$attr['pid'] : NULL;
		//where条件
		$where = '';
		//如果$attr['pid']不为空
		if(!is_null($pid)){
			$where = "->where('pid={$pid}')";
		}
    		$str = <<<stt
<?php
	//分类模型
	\$model = new \Common\Model\Category;
	\$cateData = \$model{$where}->get();
	foreach (\$cateData as \$field):
	//列表页地址
	\$field['url'] = U('List/index',array('cid'=>\$field['cid']));
?>
$content
<?php
	endforeach;
?>
stt;
		return $str;
    }
		
}

 




