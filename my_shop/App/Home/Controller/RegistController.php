<?php namespace Home\Controller;
use Hdphp\Controller\Controller;

class RegistController extends Controller{
	
	function index(){
		//实例化一个注册的对象
		$model = new \Common\Model\Regist;
		if(IS_POST){
			if(!$model->reg())	View::error($model->getError());
			View::success('注册成功',U('Index/index'));
		}
		
		View::make();
	}
}



?>