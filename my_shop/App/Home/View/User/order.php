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
				<h3>我的订单</h3>
			</div>
			<div class="orders">
				<ul>
					<li><a href="">全部</a></li>
					<li><a href="">待支付</a></li>
					<li><a href="">待评价</a></li>
					<li><a href="">待收货</a></li>
					<li><a href="">已完成</a></li>
					<li><a href="">已取消</a></li>
				</ul>
			</div>
		</div>
		
		<!--我的订单详情-->
		{{foreach from="$orderData" value="$v"}}
		<div class="my-orders">
			<div class="title">
				&nbsp;&nbsp;&nbsp;<span>时间：{{date('Y-m-d H:i:s',$v['sendtime'])}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
				<span>订单号：{{$v['number']}}</span><span><a href="{{U('details',array('oid'=>$v['oid']))}}" style="float: right;">订单详情</a></span>
			</div>
			{{foreach from="$v['details']" value="$v"}}
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
						<p>金额：¥ {{$v['subtotal']}}</p>
					</li>
					<li class="info">

					</li>
				</ul>
			</div>
			{{endforeach}}
		</div>
		{{endforeach}}
	</div>
	<div class="clear"></div>
	
	<!--底部开始-->
{{include file="VIEW_PATH/Common/footer.php"}}	