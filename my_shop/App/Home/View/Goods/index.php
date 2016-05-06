{{include file="VIEW_PATH/Common/header.php"}}	
{{include file="VIEW_PATH/Common/search.php"}}

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
						url : '{{U('Goods/ajaxGetAttr')}}',
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
				url : '{{U('Cart/ajaxGetCart')}}',
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
		<p><a href="{{U('Index/index')}}">首页  </a>> 
			{{foreach from="$fcids" value="$v"}}
			<a href="{{U('List/index',array('cid'=>$v['cid']))}}">{{$v['cname']}}></a>
			{{endforeach}}
			<a href="">{{$gdata['gname']}}</a>
		</p>
	</div>
	<div class="hr-20"></div>
	<div id="shop-con">
		<div class="con-header">
			<div class="shop-pic">
				<div class="pic">
					<div class="ipic">
						<img src="{{$gdata['pic']}}"/>
					</div>
				</div>
				<div class="s-pic">
					<a href="javascript:;" class="z"></a>
					<div class="pic-view">
						<ul>
							{{foreach from="$gdata['photo']" value="$v"}}
							<li class="one"><a href="javascript:;"><img src="{{$v}}"/></a></li>
							{{endforeach}}
						</ul>
					</div>
					<a href="javascript:;" class="y"></a>
				</div>
			</div>
			<div class="shop-name">
				<li value="{{$gdata['gname']}}" id="shopName"><p class="n1">{{$gdata['gname']}}</p></li>
				<!--<p class="n2">金属机身，优雅弧屏，”薄“动心弦；1300万后置摄像头, 蓝宝石镜片，专业相机模式；智能指纹，指关节2.0，随心掌控；手机刷卡，芯片级安全；超强内核，智能生活，可圈可点！</p>-->
			</div>
			<div class="shop-price">
				<ul>
					<li class="price" value="{{$gdata['shopprice']}}">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：<span>￥ {{$gdata['shopprice']}}</span></li>
					<li>市&nbsp;&nbsp;场&nbsp;&nbsp;价：<span style="text-decoration: line-through;">{{$gdata['marketprice']}}</span></li>
					<li><span id="shop-num"></span></li>
					<li>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：<span>32</span></li>
					<li>点击 次数：<span>{{$gdata['click']}}</span></li>
				</ul>
			</div>
			<div class="shop-sku">
				{{if value="$gdata['gnumber']"}}
				<ul>
					{{if value="$spec"}}
						{{foreach from="$spec" value="$v"}}
						<li class="spec-num">
							{{$v['taname']}}:
							{{foreach from="$v['gtvalue']" key="$k" value="$vv"}}
							<a href="javascript:;" gtid="{{$v['gtid'][$k]}}">{{$vv}}</a>
							{{endforeach}}
						</li>
						{{endforeach}}
					{{endif}}
					<li>购买数量：<a href="javascript:;" id="jianhao">-&nbsp;</a><input type="text" value="1" id="shuliang"/><a href="javascript:;" id="jiahao">+</a> <span>{{$gdata['unit']}}</span></li>
					<li>库存：<span id="inventory">{{$gdata['gnumber']}}</span></li>
					
				</ul>
				<input type="hidden" name="gid" id="gid" value="{{$gdata['gid']}}" />				
				<a href="javascript:;" class="cart">加入购物车</a>
				<!--<a href="" class="buy">立即购买</a>-->
				{{else if}}
				<h2>此货品已下架~</h2>
				{{endif}}
				<div id="add-cart">
					<div class="left">
						<p></p>
					</div>
					<div class="right">
						<div class="con">
							<p class="s-name">{{$gdata['gname']}}</p>
							<p class="as">成功加入购物车!</p>
							<p class="s-num">购物车中共 <span id="cart-num"></span> 件商品，金额合计 ¥ <span id="cart-price"></span></p>
							<a href="{{U('Cart/index',array('gid'=>$gdata['gid']))}}" class="cartgo">去结算</a>
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
				{{foreach from="$hotShop" value="$v"}}
				<li>
					<p class="pic"><a href="{{U('Goods/index',array('gid'=>$v['gid']))}}"><img src="{{__ROOT__}}/{{$v['pic']}}"/></a></p>
					<p class="pname"><a href="{{U('Goods/index',array('gid'=>$v['gid']))}}">{{$v['gname']}}</a></p>
					<p class="price"><a href="{{U('Goods/index',array('gid'=>$v['gid']))}}">￥ {{$v['shopprice']}}</a><span></span></p>
				</li>
				{{endforeach}}
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
					{{$gdata['intro']}}
				</ul>
				<ul>
					2
				</ul>
				<ul>
					{{$gdata['service']}}
				</ul>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	
	<!--底部开始-->
{{include file="VIEW_PATH/Common/footer.php"}}	