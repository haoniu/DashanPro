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

<script type="text/javascript">
	$(function(){
		//获得隐藏域中的gid
		var gid = $("#gid").val();
		//获得到规格的个数
		var N = $('.shop-sku .spec-num').length;
		//循环规格数目
		$('.shop-sku .spec-num').each(function(){
			
			//找到a添加一个单击事件
			$(this).find('a').click(function(){	
				var a = $(this).attr('gtid');
				$(this).addClass('spec-one').siblings().removeClass('spec-one');
				//设置一个保存规格的数组
				var spec = {};
				//一次循环添加
				$.each($('.spec-one'),function(k,v){
					spec[k] = $(this).attr('gtid');
				})
				
				var gaid={
					gid:gid,
					spec:spec
				}
				//控制台显示数组console.log(spec)
				//console.log(gaid)	
				
				//获得当前选中的属性的个数是多少哥和总的属性来做对比	
				var po = $('.shop-sku .spec-num .spec-one').length;
				if(po == N){
					$.ajax({
						//请求地址
						url : '<?php echo U('Goods/ajaxGetAttr')?>',
						//发送的数据
						data: gaid,
						//请求类型
						type:'post',
						//返回的数据类型
						dataType:'json',
						//成功返回
						success:function(phpData){
							var inventory = '';
							var num = '';
							
							if(phpData){
								num += '商品 编码：<span>' + phpData.number + '</span>';
								if(phpData.inventory >= 1){
									inventory += '<span inventory="' +phpData.inventory+'">' + phpData.inventory + '</span>';
									$('.shop-sku .cart').css('display','block');
								}
							}else{
								inventory += '<span>0</span>';
								$('.shop-sku .cart').css('display','none');
							}
							
							$('#inventory').html(inventory);
							$('#shop-num').html(num);
						}
					})
				}
				
				
			})
		})
		
		
		//失去焦点输入数量小于1的时候
		$("#shuliang").blur(function(){
			if($(this).val()<1){
				$(this).val(1);
			}
			//获取库存
			var kucun = parseInt($("#inventory span").html());
			
			if(parseInt($(this).val()) > kucun){
				$(this).val(kucun);
			}else{
				parseInt($(this).val());
			}
		});
		
		
		$('.shop-sku .cart').click(function(){
			//获得购买的数量
			var num = $('#shuliang').val();
			//获得购买的规格,先设置一个空数组
			var spec = {};
			
			//预先定义一个判断spec是否存在的变量
			var is_spec = $('.spec-one');
			//循环获得到数组的内容
			if(is_spec.length>0){
				$.each($('.spec-one'),function(k,v){
					spec[k] = $(this).attr('gtid');
				})
			}
			
			var cart_data={
				gid:gid,
				num:num,
				spec:spec
			}
			
			$('#add-cart').css('display','block')
			//发送异步
			$.ajax({
				//请求地址
				url : '<?php echo U('Cart/ajaxGetCart')?>',
				//发送的数据
				data: cart_data,
				//请求类型
				type:'post',
				//返回的数据类型
				dataType:'json',
				//成功返回
				success:function(phpData){
					var num = '';
					var price = '';
					
					num += '<span>' + phpData['num'] + '</span>';
					price += '<span>' + phpData['price'] + '</span>';
					
					$('#cart-num').html(num);
					$('#cart-price').html(price);
				}
			})
		})
		
		
		
		$('#add-cart .buy').click(function(){
			$('#add-cart').css('display','none')
		})
		
		
	})
	
	
	//点击增加，减少
	$(function(){
		$('#jiahao').click(function(){
			//获取库存
			var kucun = $("#inventory span").attr("inventory");
			var sum = parseInt($('#shuliang').val());
			
			if(sum < kucun){
				sum += 1;
			}else{
				sum = kuncun;
			}
			$('#shuliang').val(sum);
		})
		$('#jianhao').click(function(){
			
			var sum = parseInt($('#shuliang').val());
			sum = Math.max(1,sum-1);
			$('#shuliang').val(sum);
		})
		
	})
</script>

	<!--内容-->
	<div class="hr-10"></div>
	<div id="crumb">
		<p><a href="<?php echo U('Index/index')?>">首页  </a>> 
			<?php foreach ($fcids as $v){?>
			<a href="<?php echo U('List/index',array('cid'=>$v['cid']))?>"><?php echo $v['cname']?>></a>
			<?php }?>
			<a href=""><?php echo $gdata['gname']?></a>
		</p>
	</div>
	<div class="hr-20"></div>
	<div id="shop-con">
		<div class="con-header">
			<div class="shop-pic">
				<div class="pic">
					<div class="ipic">
						<img src="<?php echo $gdata['pic']?>"/>
					</div>
				</div>
				<div class="s-pic">
					<a href="javascript:;" class="z"></a>
					<div class="pic-view">
						<ul>
							<?php foreach ($gdata['photo'] as $v){?>
							<li class="one"><a href="javascript:;"><img src="<?php echo $v?>"/></a></li>
							<?php }?>
						</ul>
					</div>
					<a href="javascript:;" class="y"></a>
				</div>
			</div>
			<div class="shop-name">
				<li value="<?php echo $gdata['gname']?>" id="shopName"><p class="n1"><?php echo $gdata['gname']?></p></li>
				<!--<p class="n2">金属机身，优雅弧屏，”薄“动心弦；1300万后置摄像头, 蓝宝石镜片，专业相机模式；智能指纹，指关节2.0，随心掌控；手机刷卡，芯片级安全；超强内核，智能生活，可圈可点！</p>-->
			</div>
			<div class="shop-price">
				<ul>
					<li class="price" value="<?php echo $gdata['shopprice']?>">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：<span>￥ <?php echo $gdata['shopprice']?></span></li>
					<li>市&nbsp;&nbsp;场&nbsp;&nbsp;价：<span style="text-decoration: line-through;"><?php echo $gdata['marketprice']?></span></li>
					<li><span id="shop-num"></span></li>
					<li>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：<span>32</span></li>
					<li>点击 次数：<span><?php echo $gdata['click']?></span></li>
				</ul>
			</div>
			<div class="shop-sku">
				<?php if($gdata['gnumber']){?>
                
				<ul>
					<?php if($spec){?>
                
						<?php foreach ($spec as $v){?>
						<li class="spec-num">
							<?php echo $v['taname']?>:
							<?php foreach ($v['gtvalue'] as $k=>$vv){?>
							<a href="javascript:;" gtid="<?php echo $v['gtid'][$k]?>"><?php echo $vv?></a>
							<?php }?>
						</li>
						<?php }?>
					
               <?php }?>
					<li>购买数量：<a href="javascript:;" id="jianhao">-&nbsp;</a><input type="text" value="1" id="shuliang"/><a href="javascript:;" id="jiahao">+</a> <span><?php echo $gdata['unit']?></span></li>
					<li>库存：<span id="inventory"><?php echo $gdata['gnumber']?></span></li>
					
				</ul>
				<input type="hidden" name="gid" id="gid" value="<?php echo $gdata['gid']?>" />				
				<a href="javascript:;" class="cart">加入购物车</a>
				<!--<a href="" class="buy">立即购买</a>-->
				<?php }else{?>
				<h2>此货品已下架~</h2>
				
               <?php }?>
				<div id="add-cart">
					<div class="left">
						<p></p>
					</div>
					<div class="right">
						<div class="con">
							<p class="s-name"><?php echo $gdata['gname']?></p>
							<p class="as">成功加入购物车!</p>
							<p class="s-num">购物车中共 <span id="cart-num"></span> 件商品，金额合计 ¥ <span id="cart-price"></span></p>
							<a href="<?php echo U('Cart/index',array('gid'=>$gdata['gid']))?>" class="cartgo">去结算</a>
							<a href="javascript:;" class="buy">继续逛逛</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="hot-con">
			<div class="hot-title">
				<p>热销榜单</p>
			</div>
			<ul>
				<?php foreach ($hotShop as $v){?>
				<li>
					<p class="pic"><a href="<?php echo U('Goods/index',array('gid'=>$v['gid']))?>"><img src="<?php echo __ROOT__?>/<?php echo $v['pic']?>"/></a></p>
					<p class="pname"><a href="<?php echo U('Goods/index',array('gid'=>$v['gid']))?>"><?php echo $v['gname']?></a></p>
					<p class="price"><a href="<?php echo U('Goods/index',array('gid'=>$v['gid']))?>">￥ <?php echo $v['shopprice']?></a><span></span></p>
				</li>
				<?php }?>
			</ul>
		</div>
		<div id="shop-feature">
			<div class="title">
				<ul>
					<li class="one"><a href="javascript:;">商品详情</a></li>
					<li><a href="javascript:;">规格参数</a></li>
					<li><a href="javascript:;">售后服务</a></li>
				</ul>
			</div>
			
			<div class="shop-content">
				<ul style="display: block;">
					<?php echo $gdata['intro']?>
				</ul>
				<ul>
					2
				</ul>
				<ul>
					<?php echo $gdata['service']?>
				</ul>
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