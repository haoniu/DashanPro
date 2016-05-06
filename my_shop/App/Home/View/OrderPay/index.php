{{include file="VIEW_PATH/Common/header.php"}}	

	<!--购物头部-->
	<div id="cart-head">
		<div class="logo">
			<img src="{{__PUBLIC__}}/Home/image/newLogo.png"/>
		</div>
		<div class="cart-count3"></div>
	</div>
	
	<!--订单成功消息-->
	<div id="order-success">
		<i></i>
		<h3>订单提交成功，请您尽快付款！</h3>
		<p>订单号：&nbsp;&nbsp;{{$odata['number']}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;付款金额：{{$odata['total']}}（元）  </p>
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
{{include file="VIEW_PATH/Common/footer.php"}}