{{include file="VIEW_PATH/Common/header.php"}}
{{include file="VIEW_PATH/Common/search.php"}}

	<!--轮播图-->
	<div id="focus">
		<div class="menu">
			<ul>
				{{foreach from="$cateArr" value="$v"}}
				<li>
					
					<p><a href="{{U('List/index',array('cid'=>$v['cid']))}}">{{$v['cname']}}</a></p>
					
					{{foreach from="$v['_data']" value="$vv"}}
					<a href="{{U('List/index',array('cid'=>$vv['cid']))}}">{{$vv['cname']}}</a>
					{{endforeach}}
					
					<!--<div id="lp-yc">
						
					</div>-->
				</li>
				{{endforeach}}
				
			</ul>
		</div>
		
		<div id="slide">
			<a href="" title="购物嘉年华"><img src="{{__PUBLIC__}}/Home/image/lp/1.jpg"/></a>
			<a href="" title="极速抢购"><img src="{{__PUBLIC__}}/Home/image/lp/2.jpg"/></a>
			<a href="" title="闯一下"><img src="{{__PUBLIC__}}/Home/image/lp/3.jpg"/></a>
			<a href="" title="拼手气"><img src="{{__PUBLIC__}}/Home/image/lp/4.jpg"/></a>
			<a href="" title="购物嘉年华"><img src="{{__PUBLIC__}}/Home/image/lp/5.jpg"/></a>
		</div>
		
	</div>

	<!--明星单品开始-->
	<div id="star">
		<ul>
			<li>
				<div class="title">
					<p>满11元减10元</p>
				</div>
				<div class="cont">
					<img src="{{__PUBLIC__}}/Home/image/231.jpg"/>
				</div>
			</li>
			<li>
				<div class="title">
					<p>年货必备</p>
				</div>
				<div class="cont">
					<img src="{{__PUBLIC__}}/Home/image/5.jpg"/>
				</div>
			</li>
			<li>
				<div class="title">
					<p>最新热品</p>
				</div>
				<div class="cont">
					<img src="{{__PUBLIC__}}/Home/image/6.jpg"/>
				</div>
			</li>
			<li>
				<div class="title">
					<p>人气产品</p>
				</div>
				<div class="cont">
					<img src="{{__PUBLIC__}}/Home/image/7.jpg"/>
				</div>
			</li>
		</ul>
	</div>
	
	<!--一层开始-->
	<div id="floor">
		<div class="stor">
			<div class="title">
				<span>1F</span>
				<p>精美零食</p>
			</div>
			<div class="stor-img">
				<a href=""><img src="{{__PUBLIC__}}/Home/image/115.jpg"/></a>
			</div>
		</div>
		<div class="storey-cont">
			<div class="title">
				
			</div>
			
			<ul>
				<div class="node">
					<a href=""><img src="{{__PUBLIC__}}/Home/image/6665.jpg"/></a>
				</div>
				
				{{foreach from="$allData[1]" value="$v"}}
				<li>
					<div class="s-img">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}"><img src="{{__ROOT__}}/{{$v['pic']}}"/></a>
					</div>
					<div class="s-info">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}">{{$v['gname']}}</a>
						<p>
							<small>￥</small>
							{{$v['shopprice']}}
							
						</p>
					</div>
				</li>
				{{endforeach}}
			
			</ul>
		</div>
	</div>
	
	<!--二楼-->
	<div id="floor">
		<div class="stor">
			<div class="title">
				<span>2F</span>
				<p>饮料饮品</p>
			</div>
			<div class="stor-img">
				<a href=""><img src="{{__PUBLIC__}}/Home/image/333.jpg"/></a>
			</div>
		</div>
		<div class="storey-cont">
			<div class="title">
				
			</div>
			
			<ul>
				<div class="node">
					<a href=""><img src="{{__PUBLIC__}}/Home/image/30003.jpg"/></a>
				</div>
				{{foreach from="$allData[2]" value="$v"}}
				<li>
					<div class="s-img">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}"><img src="{{__ROOT__}}/{{$v['pic']}}"/></a>
					</div>
					<div class="s-info">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}">{{$v['gname']}}</a>
						<p>
							<small>￥</small>
							{{$v['shopprice']}}
							
						</p>
					</div>
				</li>
				{{endforeach}}
			
			</ul>
		</div>
	</div>
	
	
	<!--三楼-->
	<div id="floor">
		<div class="stor">
			<div class="title">
				<span>3F</span>
				<p>白酒品类</p>
			</div>
			<div class="stor-img">
				<a href=""><img src="{{__PUBLIC__}}/Home/image/6336.jpg"/></a>
			</div>
		</div>
		<div class="storey-cont">
			<div class="title">
				
			</div>
			
			<ul>
				<div class="node">
					<a href=""><img src="{{__PUBLIC__}}/Home/image/7036.jpg"/></a>
				</div>
				{{foreach from="$allData[3]" value="$v"}}
				<li>
					<div class="s-img">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}"><img src="{{__ROOT__}}/{{$v['pic']}}"/></a>
					</div>
					<div class="s-info">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}">{{$v['gname']}}</a>
						<p>
							<small>￥</small>
							{{$v['shopprice']}}
							
						</p>
					</div>
				</li>
				{{endforeach}}
			
			</ul>
		</div>
	</div>
	
	<!--四楼-->
	<div id="floor">
		<div class="stor">
			<div class="title">
				<span>4F</span>
				<p>家居洗护</p>
			</div>
			<div class="stor-img">
				<a href=""><img src="{{__PUBLIC__}}/Home/image/6636.jpg"/></a>
			</div>
		</div>
		<div class="storey-cont">
			<div class="title">
				
			</div>
			
			<ul>
				<div class="node">
					<a href=""><img src="{{__PUBLIC__}}/Home/image/50003.jpg"/></a>
				</div>
				{{foreach from="$allData[4]" value="$v"}}
				<li>
					<div class="s-img">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}"><img src="{{__ROOT__}}/{{$v['pic']}}"/></a>
					</div>
					<div class="s-info">
						<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}">{{$v['gname']}}</a>
						<p>
							<small>￥</small>
							{{$v['shopprice']}}
							
						</p>
					</div>
				</li>
				{{endforeach}}
			
			</ul>
		</div>
	</div>
	<!--底部开始-->
	<div id="footer">
		<div class="footer">
			<div class="logo">
				<img src="{{__PUBLIC__}}/Home/image/2142.png"/>
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