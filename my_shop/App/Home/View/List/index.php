{{include file="VIEW_PATH/Common/header.php"}}
{{include file="VIEW_PATH/Common/search.php"}}
	<!--列表页开始-->
	<div class="hr-10"></div>
	<div id="crumb">
		<p><a href="">首页  </a>
			{{foreach from="$fcids" value="$v"}}
			<a href="{{U('List/index',array('cid'=>$v['cid']))}}">>{{$v['cname']}}</a>
			{{endforeach}}
		</p>
	</div>
	<div class="hr-20"></div>
	
	<!--商品分类-->
	<div id="shop-class">
		<!--<div class="cate-attr">-->
			<!--<p>分类筛选</p>-->
			<!--<ul>
				<li><a href="">不限</a></li>
				<li><a href="">ORION</a></li>
				<li><a href="">好丽友</a></li>
				<li><a href="">德芙</a></li>
				<li><a href="">乐事</a></li>
				<li><a href="">Lotte乐天</a></li>
				<li><a href="">Dove</a></li>
				<li><a href="">洽洽</a></li>
				<li><a href="">不二家</a></li>
			</ul>-->
		<!--</div>-->
		<div style="width: 1200px;height: 1px;border-bottom: 1px solid #DEDEDE;display: block;float: left;"></div>
		{{foreach from="$goodsAttr" key="$k" value="$v"}}
		<div class="cate-sort">
			<p>{{$v['name']}}：</p>
			<ul>
				<?php 
					$temp = $param;
					//初始的时候都为0
					$temp[$k] = 0;
				?>
				<li><a href="{{U('List/index',array('cid'=>$_GET['cid'],'param'=>implode('_',$temp)))}}" {{if value="$param[$k] eq 0"}}class="hover"{{endif}}>不限</a></li>
				{{foreach from="$v['value']" value="$vv"}}
				<?php 
					$temp[$k] = $vv['gtid'];
				 ?>
				<li><a href="{{U('List/index',array('cid'=>$_GET['cid'],'param'=>implode('_',$temp)))}}" {{if value="$param[$k] eq $vv['gtid']"}}class="hover"{{endif}}>{{$vv['gtvalue']}}</a></li>
				{{endforeach}}
			</ul>
		</div>
		{{endforeach}}
		<div class="gao"></div>
	</div>
	
	<div class="hr-20"></div>
	<!--商品列表-->
	<div id="shop-list">
		<div class="list">
			<div class="title">
				<p>商品列表</p>
			</div>
			<div class="sort">
				<ul>
					<li><p>排序：</p></li>
					<li><a href="">销量</a></li>
					<li><a href="">价格</a></li>
					<li><a href="">上架时间</a></li>
					<li><a href="">评分</a></li>
				</ul>
			</div>
			
			{{if value="$goodsData"}}
			{{foreach from="$goodsData" value="$v"}}
			<div class="shop">
				<div class="pic">
					<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}"><img src="{{__ROOT__}}/{{$v['pic']}}"/></a>
				</div>
				<p class="ming">{{$v['gname']}}</p>
				<p class="price">
					<small>￥</small>
					{{$v['shopprice']}}
					<small></small>
				</p>
				<a href="" class="add">加入购物车</a>
				<!--<p class="sele">已售：10213</p>-->
				<!--<a href="" class="att">加关注</a>-->
			</div>
			{{endforeach}}
			{{endif}}
		</div>
		<div class="hot">
			<p class="recom">热销推荐</p>
			{{foreach from="$hotShop" value="$v"}}
			<div class="shop">
				<div class="pic">
					<a href="{{U('Goods/index',array('gid'=>$v['gid']))}}"><img src="{{__ROOT__}}/{{$v['pic']}}"/></a>
				</div>
				<p class="ming"><a href="{{U('Goods/index',array('gid'=>$v['gid']))}}">{{$v['gname']}}</a></p>
				<p class="price">
					<small>￥</small>
					55.
					<small>6</small>
				</p>
				<a href="" class="add">加入购物车</a>
				<p class="sele">已售：10213</p>
			</div>
			{{endforeach}}
		</div>
	</div>
	<div class="clear"></div>
	
{{include file="VIEW_PATH/Common/footer.php"}}