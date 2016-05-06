<?php 
	require 'redis.php';
	//获取班级id
	$id=$_GET['id'];
	//删除哈希值
	$redis->del('class:'.$id);
	//从列表中删除
	$redis->lrem('dsClass',$id,0);
	header('location:index.php');
?>