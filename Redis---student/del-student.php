<?php
	require 'redis.php';
	//获取学生的id
	$id = $_GET['id'];
	//删除哈希值
	$redis->del('student:'.$id);
	//从列表中删除
	$redis->lrem('stulist',$id,0);
	header('location:student-index.php');
?>