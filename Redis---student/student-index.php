<?php
	require 'redis.php';
	
	//获取到所有的学生
	$sids = $redis->lrange('stulist',0,-1);
	$stuData = array();
	foreach($sids as $sid){
		$arr = $redis->hGetAll('student:'.$sid);
		$arr['sid'] = $sid;
		
		//找到学生对应的班级
		$cid = $arr['class'];
		$classData=$redis->hGetAll('class:'.$cid);
		$arr['cname'] = $classData['cname'];
		$stuData[] = $arr;
	}
	//print_r($sids);
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
			<h1>学生信息</h1>
		</div>
		<div class="am-g am-g-fixed">
			<table class="am-table am-table-hover">
			    <thead>
			        <tr>
			            <th style="width: 180px;">学生ID</th>
			            <th>学生名字</th>
			            <th>学生班级</th>
			            <th style="width: 380px;text-align: center;">操作</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php foreach($stuData as $v){?>
			        <tr>
			            <td><?php echo $v['sid']?></td>
			            <td><?php echo $v['sname']?></td>
			            <td><?php echo $v['cname']?></td>
			            <td style="text-align: center;">
			            	<a href="javascript:;" onclick="if(confirm('确定删除吗')) location.href='del-student.php?id=<?php echo $v['sid']?>'" class="am-btn am-btn-danger am-radius am-btn-sm"><i class="am-icon-user-times"></i> 删除</a>
			            </td>
			        </tr>
			        <?php }?>
			    </tbody>
			</table>
		</div>
		
		<div class="am-g-fixed am-center">
			<hr />
			<a href="index.php" class="am-btn am-btn-primary am-radius"><i class="am-icon-backward"></i> 返回班级</a>
		</div>
		
	</body>
</html>
