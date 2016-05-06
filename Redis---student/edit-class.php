<?php 
	require 'redis.php';
	$id = $_GET['id'];
	if(!empty($_POST)){
		$redis->hmset('class:'.$id,$_POST);
		header('location:index.php');
	}
	//根据id组合哈希，获取哈希对应的留言信息
	$oldData=$redis->hGetAll('class:'.$id);
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
			<h1>学生管理系统--修改班级</h1>
		</div>
		<div class="am-g am-g-fixed">
			<hr />
			<form action="" method="post">
				<label for="doc-ipt-text-1">班级名称：</label>
	      		<input type="text" class="" id="doc-ipt-text-1" placeholder="请输入输入班级名称" name="cname" value="<?php echo $oldData['cname']?>">
	      		<br /><br />
				<input type="submit" value="提交修改" class="am-btn am-btn-primary am-radius"/>
				<a href="index.php" class="am-btn am-btn-primary am-radius"><i class="am-icon-gear am-icon-backward"></i> 返回主页</a>
			</form>
	      	
		</div>
		
	</body>
</html>
