<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN""http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{__PUBLIC__}}/Home/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="{{__PUBLIC__}}/Home/css/index.css" />
	<link rel="stylesheet" type="text/css" href="{{__PUBLIC__}}/Home/css/hdjs.css"/>
	<script src="{{__PUBLIC__}}/Home/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="{{__PUBLIC__}}/Home/js/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="{{__PUBLIC__}}/Home/js/pic.js" type="text/javascript" charset="utf-8"></script>	
</head>

<body>
	<!--头部开始-->
	<div id="top">
		<div class="header">
			<ul class="left">
				<li><a href="{{U('Index/index')}}">首页</a></li><span></span>
				<li><a href="">企业采购</a></li>
			</ul>
			<ul class="right">
				<div class="r">
					{{if value="isset($_SESSION['uname'])"}}
					<li><a href="">欢迎您&nbsp;&nbsp;{{$_SESSION['uname']}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
					<li><a href="{{U('Login/out')}}">退出</a></li><span></span>
					{{else}}
					<li><a href="{{U('Regist/index')}}">注册</a></li><span></span>
					<li><a href="{{U('Login/index')}}">登录</a></li><span></span>
					{{endif}}
					<li><a href="{{U('User/index')}}">我的订单</a></li><span></span>
					<li><a href="{{U('Cart/index')}}">购物车</a></li>
				</div>			
			</ul>
		</div>
	</div>

	