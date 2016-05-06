<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN""http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/Home/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/Home/css/index.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/Home/css/hdjs.css"/>
	<script src="<?php echo __PUBLIC__?>/Home/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo __PUBLIC__?>/Home/js/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo __PUBLIC__?>/Home/js/pic.js" type="text/javascript" charset="utf-8"></script>	
</head>

<body>
	<!--头部开始-->
	<div id="top">
		<div class="header">
			<ul class="left">
				<li><a href="<?php echo U('Index/index')?>">首页</a></li><span></span>
				<li><a href="">企业采购</a></li>
			</ul>
			<ul class="right">
				<div class="r">
					<?php if(isset($_SESSION['uname'])){?>
                
					<li><a href="">欢迎您&nbsp;&nbsp;<?php echo $_SESSION['uname']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
					<li><a href="<?php echo U('Login/out')?>">退出</a></li><span></span>
					<?php }else{?>
					<li><a href="<?php echo U('Regist/index')?>">注册</a></li><span></span>
					<li><a href="<?php echo U('Login/index')?>">登录</a></li><span></span>
					
               <?php }?>
					<li><a href="<?php echo U('User/index')?>">我的订单</a></li><span></span>
					<li><a href="<?php echo U('Cart/index')?>">购物车</a></li>
				</div>			
			</ul>
		</div>
	</div>

		

	<!--购物头部-->
	<div id="cart-head">
		<div class="logo">
			<img src="<?php echo __PUBLIC__?>/Home/image/newLogo.png"/>
		</div>
		<div class="cart-count3"></div>
	</div>
	
	<!--订单成功消息-->
	<div id="order-success">
		<i></i>
		<h3>订单提交成功，请您尽快付款！</h3>
		<p>订单号：&nbsp;&nbsp;<?php echo $odata['number']?>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;付款金额：<?php echo $odata['total']?>（元）  </p>
		<p>请您完成支付，否则订单将自动取消。</p>
	</div>
	
	<!--订单支付-->
	<div id="order-sell">
		<p class="title">选择支付方式</p>
		<div class="pay">
			<form action="" method="post">
				<input type="submit" value="立即支付" class="hd-btn hd-btn-danger"/>
			</form>
		</div>
	</div>
	
	
	<br />
	<!--底部开始-->
	<!--底部开始-->
	<div id="footer">
		<div class="footer">
			<div class="logo">
				<img src="<?php echo __PUBLIC__?>/Home/image/2142.png"/>
			</div>
			<dl>
				<dt><a href="">购物指南</a></dt>
				<dd><a href="">购物流程</a></dd>
				<dd><a href="">配送时效说明</a></dd>
				<dd><a href="">配送区域及费用</a></dd>
				<dd><a href="">购买生鲜须知</a></dd>
				<dd><a href="">发票流程</a></dd>
			</dl>
			<dl>
				<dt><a href="">售后服务</a></dt>
				<dd><a href="">退货规则</a></dd>
				<dd><a href="">退货指南</a></dd>
				<dd><a href="">保质期说明</a></dd>
				<dd><a href="">客服：4006308910</a></dd>
				<dd><a href="">在线客服</a></dd>
			</dl>
			<dl>
				<dt><a href="">自助服务</a></dt>
				<dd><a href="">订单物流查询</a></dd>
				<dd><a href="">我的购物车</a></dd>
				<dd><a href="">我的现金券</a></dd>
				<dd><a href="">购物常见问题</a></dd>
				<dd><a href="">建议反馈</a></dd>
			</dl>
			<dl>
				<dt><a href="">商家服务</a></dt>
				<dd><a href="">关于超市</a></dd>
				<dd><a href="">入驻超市</a></dd>
				<dd><a href="">商家常见问题</a></dd>
			</dl>
			<dl>
				<dt>二维码</dt>
				<dd></dd>
			</dl>
		</div>
	</div>
</body>
</html>