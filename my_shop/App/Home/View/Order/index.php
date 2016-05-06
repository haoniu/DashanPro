{{include file="VIEW_PATH/Common/header.php"}}	
<script src="{{__PUBLIC__}}/Home/js/area.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(function(){
		//初始化方法
		area.init('a');
		//修改的时候默认被选中效果
		area.selected('黑龙江','哈尔滨','道里区');
	})
</script>
<script type="text/javascript">
	$(function(){
		//收货地址的显示隐藏
		$('#orders-a').click(function(){
			$('#add-add').css('display','block');
		})
		$('#order-a').click(function(){
			$('#add-add').css('display','block');
		})
		$('#add-add .close').click(function(){
			$('#add-add').css('display','none');
		})
		$('#add-add .enter').click(function(){
			
		})
		
		//异步提交
		$('#sub-buy .buy').click(function(){
			//获取已选择的地址
			var oaid = $("input[name='q_add']:checked").val();
			//获取已选择的发票信息
			var invoice = $("input[name='invoice']:checked").val();
			//将获得的信息组成数组
			var order_info = {
				oaid:oaid,
				invoice:invoice
			}
			//发送异步
			$.ajax({
				//请求地址
				url : "{{U('Order/ajaxSubdata')}}",
				//发送的数据
				data: order_info,
				//请求类型
				type:'post',
				//返回的数据类型
				dataType:'json',
				//成功返回
				success:function(phpData){
					window.location.href="{{U('OrderPay/index')}}&oid="+phpData+"";
				}
				
			})
			
			
		})
		
		
	})
</script>
	<!--购物头部-->
	<div id="cart-head">
		<div class="logo">
			<img src="{{__PUBLIC__}}/Home/image/newLogo.png"/>
		</div>
		<div class="cart-count2"></div>
	</div>
	<div id="add-add">
		<div class="con">
			<form onsubmit="return hd_submit(this,'{{U("Order/add")}}','{{U("Order/index")}}')">
				<h4>添加地址</h4>
				<div class="ty">
					<p>收货人：</p><input type="text" name="consignee"/>
				</div>
				<br />
				<div class="ty">
					<p>收货地址:</p>
					<select name="add[]" id="a1"></select>
					<select name="add[]" id="a2"></select>
					<select name="add[]" id="a3"></select>
				</div>
				<div class="ty-1">
					<textarea name="add[]" rows="" cols=""></textarea>
				</div>
	
				<br />
				<div class="ty">
					<p>邮编：</p><input type="text" name="code"/>
				</div>
				<br />
				<div class="ty">
					<p>手机号码：</p><input type="text" name="mobile"/>
				</div>

				<input type="submit" value="确定" class="enter"/>
			</form>
			<button class="close">关闭</button>
		</div>
	</div>
	<!--购物车内容-->
	<div id="order-address">
		<h3>收货人信息<a href="javascript:;" id="order-a">[使用新地址]</a></h3>
		<div class="xian"></div>
		{{if value="$addData"}}
		{{foreach from="$addData" value="$v"}}
		<div class="o-add">
			<input type="radio" name="q_add" value="{{$v['oaid']}}" id="myadd{{$v['oaid']}}" class="add" checked=""/>
			<label for="myadd{{$v['oaid']}}" class="add-info"><span>{{$v['consignee']}}{{$v['add']}}</span></label>
		</div>
		{{endforeach}}
		{{else if}}
		<p>您还没有收货地址，马上<a href="javascript:;" id="orders-a">添加</a>吧!</p>
		{{endif}}
		<br />
		<h3>发票信息</h3>
		<ul>
			<li>
				<input type="radio" name="invoice" id="invoice-man" value="个人" checked=""/>
				<label for="invoice-man">个人</label>
			</li>
			<li class="cop">
				<input type="radio" name="invoice" id="invoice-cop" value="公司" />
				<label for="invoice-cop">公司</label>
			</li>
		</ul>
		<span>注意：如果商品由第三方卖家销售，发票内容由其卖家决定，发票由卖家开具并寄出</span>
	</div>
	<br />
	<div id="order-shop">
		<div class="title">
			<p>以下商品由  华为商城  选择合作快递配送</p>
		</div>
		<div class="order-info">
			<table>
				<tr class="o-name">
					<th class="pro">商品</th>
					<th class="price">单价（元）</th>
					<th class="num">数量</th>
					<th class="subtotal">小计（元）</th>
				</tr>
			</table>
			<table>
				{{foreach from="$cartData" value="$v"}}
				<tr class="o-shop">
					<th class="pro"><a href="">{{$v['name']}}</a></th>
					<th class="price">{{$v['price']}}</th>
					<th class="num">{{$v['num']}}</th>
					<th class="subtotal">{{$v['total']}}</th>
				</tr>
				{{endforeach}}
			</table>
		</div>
		<div class="order-cost">
			<br />
			<table>
				<tr>
					<th>商品总金额：</th>
					<td>&nbsp;&nbsp;¥  {{$cartData['allTotal']}}</td>
				</tr>
				<tr>
					<th>运费：</th>
					<td>&nbsp;&nbsp;¥  0.00</td>
				</tr>
				<tr>
					<th>使用优惠券：</th>
					<td>&nbsp;&nbsp;¥  0</td>
				</tr>
				<tr>
					<th>商品总数：	</th>
					<td>&nbsp;&nbsp;  {{$cartData['allNum']}}</td>
				</tr>
			</table>
			
			<p>应付金额：<span> ¥ {{$cartData['allTotal']}}</span></p>
		</div>
	</div>
	<div id="sub-buy">
		<a href="javascript:;" class="buy">提交订单</a>
	</div>
	<br>
	<!--底部开始-->
{{include file="VIEW_PATH/Common/footer.php"}}