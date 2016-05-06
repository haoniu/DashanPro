{{include file="VIEW_PATH/Common/header.php"}}	
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
				url : '{{U('ajaxUpdate')}}',
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
				url : '{{U('ajaxUpdate')}}',
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
				url : '{{U('cartDel')}}',
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
				url : '{{U('delAll')}}',
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
			
			{{if value="isset($_SESSION['uname'])"}}
			//获得要提交的数据
			if(vals){
				$.ajax({
					//请求地址
					url : '{{U('Cart/getSid')}}',
					//传送的数据
					data: {sid:vals},
					//请求类型
					type:'post',
					//成功返回
					success:function(){
						//window.location.herf = '';
						window.location.href="{{U('Order/index')}}";
					}
				})
			}else{
				alert('请选择要购买的商品')
			}
			{{else if}}
			alert('亲~登录后才可购买哟~');
			window.location.href="{{U('Login/index')}}";
			{{endif}}
			
		})
	})
</script>
<body>
	<!--头部开始-->
	
	<!--购物头部-->
	<div id="cart-head">
		<div class="logo">
			<img src="{{__PUBLIC__}}/Home/image/newLogo.png"/>
		</div>
		<div class="cart-count1"></div>
	</div>
	{{if value="$cartData['goods']"}}
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
		{{foreach from="$cartData['goods']" key="$key" value="$v"}}
		<div class="content">
			<table>	
				<tr>
					<th class="check"><input type="checkbox" name="" class="cart-sid" value="{{$key}}"/></th>
					<th class="pro">
						<div class="pic">
							<img src="" alt="" />
						</div>
						<a href=""class="shop-name">{{$v['name']}}</a>
						<div class="con">
							{{foreach from="$v['options']" key="$k" value="$vv"}}
							<p class="nature">{{$k}}：{{$vv}}</p>
							{{endforeach}}
						</div>
					</th>
					<th class="price">{{$v['price']}}</th>
					<th class="num">
						<a href="javascript:;" class="jian">-&nbsp;&nbsp;</a>
						<input type="text" value="{{$v['num']}}" class="shuliang" style="width: 28px;text-align: center;"/>
						<a href="javascript:;" class="jia">&nbsp;+</a>
					</th>
					<th class="subtotal">{{$v['total']}}</th>
					<th class="operate"><a href="javascript:;">X</a></th>
				</tr>	
			</table>
		</div>
		{{endforeach}}
		
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
					<td>{{$cartData['total']}}</td>
				</tr>
				<tr>
					<th>共节省：</th>
					<td>0</td>
				</tr>
				<tr class="a">
					<th>合计：</th>
					<td>￥{{$cartData['total']}}</td>
				</tr>
			</table>
		</div>
	</div>
	
	<!--提交-->
	
	<div id="sub-buy">
		<a href="javascript:;" class="buy">立即购买</a>
		<a href="javascript:;" class="goon">继续购物</a>
	</div>
	{{else if}}
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
	{{endif}}
	
	<!--底部开始-->
{{include file="VIEW_PATH/Common/footer.php"}}