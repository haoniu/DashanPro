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

		
<!--搜索区域开始-->
<script type="text/javascript">
	$(function(){
		//分别抓取页面的搜索按钮和搜索框
		var search = $("#search .searchBar .sch-btn");
		var sch_con = $("#search .searchBar .sch-so");
		
		
		$('#small_cart').click(function(){
			var sid = $('#small_cart .hi').val();
			$.ajax({
				//请求地址
				url : '<?php echo U('Cart/cartDel')?>',
				//发送的数据
				data: {sid:sid},
				//请求类型
				type:'post',
				//返回的数据类型
				dataType:'json',
				//成功返回
				success:function(phpData){
					location.reload();
				}
			});
		})
		
	})
</script>
	<div id="search">
		<div class="logo">
			<a href="<?php echo U('Index/index')?>">
				<img src="<?php echo __PUBLIC__?>/Home/image/newLogo.png"/>
			</a>
		</div>
		<div class="searchBar">
			<input type="text" class="sch-so" placeholder="Search">
			<a href="javascript:;" class="sch-btn"><img src="<?php echo __PUBLIC__?>/Home/image/search.png"/></a>
		</div>
		<div class="toolBar">
			
			<div class="shop">
				<a href="">&nbsp;&nbsp;我的购物车&nbsp;&nbsp;&nbsp; ></a>
				<div id="gw-yc">
					<div class="title">
						<p>最新加入的商品</p>
					</div>
					<?php foreach ($cartData['goods'] as $k=>$v){?>
					<div class="new-shop">
						<img src="<?php echo $v['pic']['pic']?>"/>
						<p><?php echo $v['name']?></p>
						<strong>￥<?php echo $v['price']?></strong>
						<a href="javascript:;" id="small_cart"><input type="hidden" value="<?php echo $k?>" class="hi"/>删除</a>
					</div>
					<?php }?>
					<div class="shop-cont">
						<p>共<span><?php echo $cartData['total_rows']?></span>件商品</p>
						<p>共计 <span><?php echo $cartData['total']?></span> 元</p>
						<a href="<?php echo U('Cart/index')?>">去购物车</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!--轮播菜单开始-->
	<div id="s-menu">
		<div class="s-menu">
			<div class="left">
				<a href="">全部商品</a>
			</div>
			<div class="right">
				<ul>
					<li><a href="<?php echo U('Index/index')?>">首页</a></li>					
					<?php foreach ($cateData as $v){?>
					<li><a href="<?php echo U('List/index',array('cid'=>$v['cid']))?>"><?php echo $v['cname']?></a></li>
					<?php }?>					
				</ul>
			</div>
		</div>
	</div>
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
					<li><a href="<?php echo U('order')?>">我的定单</a></li>
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
				<img src="<?php echo __PUBLIC__?>/Home/image/1222.jpg"/>
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