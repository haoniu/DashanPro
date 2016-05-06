<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
	    <!-- Loading Bootstrap -->
	    <link href="{{__PUBLIC__}}/Admin/Flat/dist/css/vendor/bootstrap.min.css" rel="stylesheet">
	    <!-- Loading Flat UI -->
	    <link href="{{__PUBLIC__}}/Admin/Flat/dist/css/flat-ui.css" rel="stylesheet">
	    <link href="{{__PUBLIC__}}/Admin/Flat/docs/assets/css/demo.css" rel="stylesheet">
	    <link rel="shortcut icon" href="{{__PUBLIC__}}/Admin/Flat/img/favicon.ico">
		<style type="text/css">
			.page li{
				margin-right: 0;
			}
		</style>
	</head>
	<body>
		<table class="table table-hover">
			<tr class="active">
			  <th width="">ID</th>
			  <th width="400">商品名称</th>
			  <th width="100">价格</th>
			  <th width="100">库存</th>
			  <th width="120">点击次数</th>
			  <th width="120">添加时间</th>
			  <th width="210">操作</th>
			</tr>
			{{foreach from="$data" value="$v"}}
			<tr>
				<td>{{$v['gid']}}</td>
				<td>{{$v['gname']}}</td>
				<td>{{$v['shopprice']}}</td>
				<td>{{$v['gnumber']}}</td>
				<td>{{$v['click']}}</td>
				<td>{{date('Y-m-d',$v['sendtime'])}}</td>
				<td>
					<a href="{{U('GoodsList/index',array('gid'=>$v['gid']))}}" class="btn btn-sm btn-primary">货品列表</a>
					<a href="{{U('edit',array('gid'=>$v['gid']))}}" class="btn btn-sm btn-warning">修改</a>
					<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('确定删除吗')) location.href='{{U('del',array('gid'=>$v['gid']))}}'">删除</a>
				</td>
			</tr>
			{{endforeach}}
		</table>
		{{if value="$count>6"}}
		<center>
			<div class="page pagination">
				<ul>
					{{$page}}
				</ul>
			</div>
		</center>
		{{endif}}
	</body>
</html>
