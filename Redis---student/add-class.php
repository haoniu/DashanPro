<?php 
	require 'redis.php';
	if(!empty($_POST)){
		//生成cid
		$redis->incr('cid');
		//获取cid
		$cid = $redis->get('cid');
		//往这个列表dsClass中压入一个自增的id
		$redis->rpush('dsClass',$cid);
		//然后组合，一次性设置多个指
		$redis->hmset('class:'.$cid,$_POST);
		
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>学生管理系统---By：大山</title>
		<link rel="stylesheet" type="text/css" href="assets/css/amazeui.min.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/index.css"/>
		<script src="assets/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/amazeui.min.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div class="am-g am-g-fixed ds-header">
			<h1>学生管理系统--添加班级</h1>
		</div>
		<div class="am-g am-g-fixed">
			<hr />
			<form action="" method="post">
				<label for="doc-ipt-text-1">班级名称：</label>
	      		<input type="text" class="" id="doc-ipt-text-1" placeholder="请输入输入班级名称" name="cname">
	      		<br /><br />
				<input type="submit" value="提交" class="am-btn am-btn-primary am-radius"/>
				<a href="index.php" class="am-btn am-btn-primary am-radius"><i class="am-icon-gear am-icon-backward"></i> 返回主页</a>
			</form>
	      	
		</div>
		
	</body>
</html>
