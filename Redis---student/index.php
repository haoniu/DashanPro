<?php
	require 'redis.php';
	
	//获取到链表中所有的班级
	$cids = $redis->lrange('dsClass',0,-1);
	$classData = array();
	foreach($cids as $cid){
		$arr = $redis->hGetAll('class:'.$cid);
		$arr['id'] = $cid;
		$data[] = $arr;
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
			<h1>学生管理系统</h1>
		</div>
		<div class="am-g am-g-fixed">
			<table class="am-table am-table-hover">
			    <thead>
			        <tr>
			            <th style="width: 180px;">班级ID</th>
			            <th>班级名称</th>
			            <th style="width: 380px;text-align: center;">操作</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php foreach($data as $k=>$v){ ?>
			        <tr>
			            <td><?php echo $v['id']?></td>
			            <td><?php echo $v['cname']?></td>
			            <td style="text-align: center;">
			            	<a href="add-student.php?id=<?php echo $v['id']?>" class="am-btn am-btn-primary am-radius am-btn-sm"><i  class="am-icon-user-plus"></i> 添加学生</a>
			            	<a href="edit-class.php?id=<?php echo $v['id']?>" class="am-btn am-btn-success am-radius am-btn-sm"><i class="am-icon-edit"></i> 编辑</a>
			            	<a href="javascript:;" onclick="if(confirm('确定删除吗')) location.href='del-class.php?id=<?php echo $v['id']?>'" class="am-btn am-btn-danger am-radius am-btn-sm"><i class="am-icon-user-times"></i> 删除</a>
			            </td>
			        </tr>
			        <?php }?>
			    </tbody>
			</table>
		</div>
		
		<div class="am-g-fixed am-center">
			<hr />
			<a href="add-class.php" class="am-btn am-btn-primary am-radius"><i class="am-icon-gear am-icon-spin"></i> 添加班级</a>
			<a href="student-index.php" class="am-btn am-btn-primary am-radius"><i class="am-icon-users"></i> 查看所有学生</a>
		</div>
		
	</body>
</html>
