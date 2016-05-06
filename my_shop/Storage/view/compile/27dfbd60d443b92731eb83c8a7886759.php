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

		
<script src="<?php echo __PUBLIC__?>/Home/js/area.js" type="text/javascript" charset="utf-8"></script>
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
				url : "<?php echo U('Order/ajaxSubdata')?>",
				//发送的数据
				data: order_info,
				//请求类型
				type:'post',
				//返回的数据类型
				dataType:'json',
				//成功返回
				success:function(phpData){
					window.location.href="<?php echo U('OrderPay/index')?>&oid="+phpData+"";
				}
				
			})
			
			
		})
		
		
	})
</script>
	<!--购物头部-->
	<div id="cart-head">
		<div class="logo">
			<img src="<?php echo __PUBLIC__?>/Home/image/newLogo.png"/>
		</div>
		<div class="cart-count2"></div>
	</div>
	<div id="add-add">
		<div class="con">
			<form onsubmit="return hd_submit(this,'<?php echo U("Order/add")?>','<?php echo U("Order/index")?>')">
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
		<?php if($addData){?>
                
		<?php foreach ($addData as $v){?>
		<div class="o-add">
			<input type="radio" name="q_add" value="<?php echo $v['oaid']?>" id="myadd<?php echo $v['oaid']?>" class="add" checked=""/>
			<label for="myadd<?php echo $v['oaid']?>" class="add-info"><span><?php echo $v['consignee']?><?php echo $v['add']?></span></label>
		</div>
		<?php }?>
		<?php }else{?>
		<p>您还没有收货地址，马上<a href="javascript:;" id="orders-a">添加</a>吧!</p>
		
               <?php }?>
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
				<?php foreach ($cartData as $v){?>
				<tr class="o-shop">
					<th class="pro"><a href=""><?php echo $v['name']?></a></th>
					<th class="price"><?php echo $v['price']?></th>
					<th class="num"><?php echo $v['num']?></th>
					<th class="subtotal"><?php echo $v['total']?></th>
				</tr>
				<?php }?>
			</table>
		</div>
		<div class="order-cost">
			<br />
			<table>
				<tr>
					<th>商品总金额：</th>
					<td>&nbsp;&nbsp;¥  <?php echo $cartData['allTotal']?></td>
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
					<td>&nbsp;&nbsp;  <?php echo $cartData['allNum']?></td>
				</tr>
			</table>
			
			<p>应付金额：<span> ¥ <?php echo $cartData['allTotal']?></span></p>
		</div>
	</div>
	<div id="sub-buy">
		<a href="javascript:;" class="buy">提交订单</a>
	</div>
	<br>
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