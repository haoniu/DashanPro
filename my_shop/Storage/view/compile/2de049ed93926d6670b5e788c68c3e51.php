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

		
<script type="text/javascript">
	$(function(){
		
		$('#cart-shop .content .num .jia').click(function(){
			var sum = parseInt($(this).prev().val());
			sum += 1;
			$(this).prev().val(sum);
			
			//获取当前的数量
			var num = $(this).prev().val();
			var sid = $(this).parent().siblings('.check').find('.cart-sid').val();
			
			var arr = {
				num:num,
				sid :sid
			};
			$.ajax({
				//请求地址
				url : '<?php echo U('ajaxUpdate')?>',
				//发送的数据
				data: arr,
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


//		$('#cart-shop .content .num .jia').click(function(){
//			var numsss = $(this).index();
//			alert(numsss);
//		})
		
		$('#cart-shop .content .num .jian').click(function(){
			var sum = parseInt($(this).next().val());
			sum = Math.max(1,sum-1);
			$(this).next().val(sum);
			
			//获取当前的数量
			var num = $(this).next().val();
			var sid = $(this).parent().siblings('.check').find('.cart-sid').val();
			
			var arr = {
				num:num,
				sid :sid
			};
			$.ajax({
				//请求地址
				url : '<?php echo U('ajaxUpdate')?>',
				//发送的数据
				data: arr,
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
//		
		
		$('#cart-shop .content .operate a').click(function(){
			var sid = $(this).parent().siblings('.check').find('.cart-sid').val();
			
			$.ajax({
				//请求地址
				url : '<?php echo U('cartDel')?>',
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
		
		//清空购物车
		$('#delAll').click(function(){
			$.ajax({
				//请求地址
				url : '<?php echo U('delAll')?>',
				success:function(){
					location.reload();
				}
			});
		})
		
		
		
		//提交订单
		$('#sub-buy .buy').click(function(){
			//获取选中的值，先创建一个空的数组
			var valArr = new Array;
			//依次查找每个的属性值
			$("#cart-shop :checkbox[checked]").each(function(i){
				valArr[i] = $(this).val();
			})
			//给传入的指用  ， 分开
			var vals = valArr.join(','); 
			
			<?php if(isset($_SESSION['uname'])){?>
                
			//获得要提交的数据
			if(vals){
				$.ajax({
					//请求地址
					url : '<?php echo U('Cart/getSid')?>',
					//传送的数据
					data: {sid:vals},
					//请求类型
					type:'post',
					//成功返回
					success:function(){
						//window.location.herf = '';
						window.location.href="<?php echo U('Order/index')?>";
					}
				})
			}else{
				alert('请选择要购买的商品')
			}
			<?php }else{?>
			alert('亲~登录后才可购买哟~');
			window.location.href="<?php echo U('Login/index')?>";
			
               <?php }?>
			
		})
	})
</script>
<body>
	<!--头部开始-->
	
	<!--购物头部-->
	<div id="cart-head">
		<div class="logo">
			<img src="<?php echo __PUBLIC__?>/Home/image/newLogo.png"/>
		</div>
		<div class="cart-count1"></div>
	</div>
	<?php if($cartData['goods']){?>
                
	<!--购物车内容-->
	<div id="cart-shop">                 
		<div class="title">
			<table>
				<thead>
					<tr>
						<th class="check"></th>
						<th class="pro">商品</th>
						<th class="price">价格</th>
						<th class="num">数量</th>
						<th class="subtotal">小计（元）</th>
						<th class="operate">操作</th>
					</tr>
				</thead>
			</table>
		</div>
		<?php foreach ($cartData['goods'] as $key=>$v){?>
		<div class="content">
			<table>	
				<tr>
					<th class="check"><input type="checkbox" name="" class="cart-sid" value="<?php echo $key?>"/></th>
					<th class="pro">
						<div class="pic">
							<img src="" alt="" />
						</div>
						<a href=""class="shop-name"><?php echo $v['name']?></a>
						<div class="con">
							<?php foreach ($v['options'] as $k=>$vv){?>
							<p class="nature"><?php echo $k?>：<?php echo $vv?></p>
							<?php }?>
						</div>
					</th>
					<th class="price"><?php echo $v['price']?></th>
					<th class="num">
						<a href="javascript:;" class="jian">-&nbsp;&nbsp;</a>
						<input type="text" value="<?php echo $v['num']?>" class="shuliang" style="width: 28px;text-align: center;"/>
						<a href="javascript:;" class="jia">&nbsp;+</a>
					</th>
					<th class="subtotal"><?php echo $v['total']?></th>
					<th class="operate"><a href="javascript:;">X</a></th>
				</tr>	
			</table>
		</div>
		<?php }?>
		
	</div>
	<script type="text/javascript">
	$(function(){
		//
		$("#check_all").click(function(){
			
			if($("#check_all").attr("checked")){    
		        $("#cart-shop :checkbox").attr("checked", true);   
		    }else{    
		        $("#cart-shop :checkbox").attr("checked", false); 
		    }

		})
		
		//点击全选全部选中
		$("#checkAll").click(function () { 
		   $("#cart-shop :checkbox,#check_all").attr("checked", true);   
		}); 
		
		
		
	})
		
	</script>
	<!--结算-->
	<div id="jiesuan">
		<div class="check-all">
			<input type="checkbox" name="" id="check_all" value=""/>
			<a href="javascript:;" id="checkAll">全选</a>
			<a href="javascript:;" id="delAll">清空</a>
		</div>
		<div class="all-price">
			<table>
				<tr>
					<th>总计金额：</th>
					<td><?php echo $cartData['total']?></td>
				</tr>
				<tr>
					<th>共节省：</th>
					<td>0</td>
				</tr>
				<tr class="a">
					<th>合计：</th>
					<td>￥<?php echo $cartData['total']?></td>
				</tr>
			</table>
		</div>
	</div>
	
	<!--提交-->
	
	<div id="sub-buy">
		<a href="javascript:;" class="buy">立即购买</a>
		<a href="javascript:;" class="goon">继续购物</a>
	</div>
	<?php }else{?>
	<div id="cart-shop">
		<div class="title">
			<table>
				<thead>
					<tr>
						<th class="check"><input type="checkbox" name="" id="" value="" /></th>
						<th class="pro">商品</th>
						<th class="price">价格</th>
						<th class="num">数量</th>
						<th class="subtotal">小计（元）</th>
						<th class="operate">操作</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="none-cart">
			<i></i>
			<p>亲，您购物车里还没有物品哦，快去逛逛吧！</p>
		</div>
	</div>
	
               <?php }?>
	
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