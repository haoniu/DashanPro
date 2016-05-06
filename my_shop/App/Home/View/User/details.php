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
					<li><a href="">我的定单</a></li>
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
		
		<!--我的订单-->
		<div class="my-order">
			<div class="title">
				<h3>订单详情</h3>
			</div>
		</div>
		
		<!--我的订单详情-->
		<div class="my-orders">
			<p>收货人姓名：{{$orderData['consignee']}}</p>
			<br />
			<p>送货地址：{{$orderData['add']}}</p>
			<br />
			<p>收货人电话：{{$orderData['mobile']}}</p>
			<br />
			<p>订单状态：<span style="color: red;">{{if value="$orderData['status'] eq 1"}}未付款{{endif}}
					{{if value="$orderData['status'] eq 2"}}已付款{{endif}}
					{{if value="$orderData['status'] eq 3"}}已发货{{endif}}
					{{if value="$orderData['status'] eq 4"}}已收货{{endif}}</span></p>
			<br />
			{{if value="$orderData['status'] eq 3"}}
			<form action="" method="post">
				<input type="submit" value="确认收货" class="hd-btn hd-btn-danger hd-btn-xm"/>
			</form>
			{{endif}}
		</div>
		<div class="my-orders">
			{{foreach from="$goodsData" value="$v"}}
			<div class="con">
				<ul>
					<div class="pic">
						<img src="{{__ROOT__}}/{{$v['pic']}}"/>
					</div>
					<li class="name">
						<a href="">{{$v['name']}}</a>
					</li>
					<li class="price">
						<p></p>
					</li>
					<li class="num">
						<p>总数量：{{$v['num']}}</p>
					</li>
					<li class="all-price">
						<p>¥ {{$v['subtotal']}}</p>
					</li>
				</ul>
			</div>
			{{endforeach}}
		</div>
	</div>
	<div class="clear"></div>
	
	<!--底部开始-->
{{include file="VIEW_PATH/Common/footer.php"}}	