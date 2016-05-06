{{include file="VIEW_PATH/Common/header.php"}}	
{{include file="VIEW_PATH/Common/search.php"}}
	<!--进入条-->
	<div class="hr-10"></div>
	<div id="crumb">
		<p><a href="">首页  </a> \ <a href="">我的商城</a></p>
	</div>
	<div class="hr-20"></div>
	
	<!--个人中心侧栏-->
	<div id="my-shop">
		<div class="my-meu">
			<div class="title">
				<a href="">我的商城</a>
			</div>
			<div class="order">
				<ul>
					<li><h3>订单中心</h3></li>
					<li><a href="{{U('order')}}">我的定单</a></li>
					<!--<li><a href="">我的退换货</a></li>
					<li><a href="">我的回收单</a></li>-->
				</ul>				
			</div>
			<div class="mine">
				<ul>
					<!--<li><h3>个人中心</h3></li>
					<li><a href="">我的优惠券</a></li>
					<li><a href="">收货地址管理</a></li>
					<li><a href="">我的优惠券</a></li>-->
				</ul>
			</div>
			<div class="mine">
				<ul>
					<!--<li><h3>帐户中心</h3></li>
					<li><a href="">基本资料</a></li>
					<li><a href="">安全中心</a></li>-->
				</ul>
			</div>
		</div>
		
		<div class="welcome">
			<div class="tx">
				<img src="{{__PUBLIC__}}/Home/image/1222.jpg"/>
			</div>
			<div class="w-name">
				<h3><span>SamCrouse</span>欢迎您</h3>
			</div>
			<div class="w-info">
				<span>我的经验值：0</span><i></i>
				<span>优惠券：0 张</span><i></i>
				<span>站内信</span>
			</div>
			
			<div class="myhome-order">
				<div class="title">
					<p>待支付订单</p>
				</div>
				<div class="bot">
					<p>您还有未付款的订单~</p>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	
	
	
	<!--底部开始-->
{{include file="VIEW_PATH/Common/footer.php"}}	