<?php 
	//连接redis
	try {
 		$redis=new Redis;
		$redis->connect('127.0.0.1');
	} catch (RedisException $e) {
 		die('redis链接失败');
	} 
?>