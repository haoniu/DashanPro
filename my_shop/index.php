<?php
function sp($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}
// .-----------------------------------------------------------------------------------
// |  Software: [HDPHP framework]
// |      Site: www.hdphp.com
// |-----------------------------------------------------------------------------------
// |    Author: 向军 <2300071698@qq.com>
// | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
// |-----------------------------------------------------------------------------------
// |  PHP实战培训: www.houdunwang.com
// '-----------------------------------------------------------------------------------
//调试模式
define('DEBUG',true);
define('APP_PATH','App');
//引入框架11
require 'Hdphp/Hdphp.php';