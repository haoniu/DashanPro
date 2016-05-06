<?php 
	require 'redis.php';
	$id = $_GET['id'];
	if(!empty($_POST)){
		//生成sid
		$redis->incr('sid');
		//获取到sid
		$sid = $redis->get('sid');
		//建立一个学生的自增链表
		$redis->rpush('stulist',$sid);
		$_POST['class'] = $id;
		//把用户提交的数据存入hash表中
		$redis->hmset('student:'.$sid,$_POST);
		
		header('location:index.php');
	}
	$classData=$redis->hGetAll('class:'.$id);
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
			<h1>学生管理系统--添加学生</h1>
		</div>
		<div class="am-g am-g-fixed">
			<hr />
			<form action="" method="post">
				<label for="doc-ipt-text-1">学生名字：</label>
	      		<input type="text" class="" id="doc-ipt-text-1" placeholder="请输入输入学生名字" name="sname">&nbsp;&nbsp;
      			<label for="doc-select-1">所属班级：</label>
			    <select id="doc-select-1">
			        <option value="<?php echo $id?>" name="class"><?php echo $classData['cname']?></option>
			    </select>
	      		<br /><br />
				<input type="submit" value="提交" class="am-btn am-btn-primary am-radius"/>
				<a href="index.php" class="am-btn am-btn-primary am-radius"><i class="am-icon-gear am-icon-backward"></i> 返回主页</a>
			</form>
	      	
		</div>
		
	</body>
</html>
