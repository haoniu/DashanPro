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
	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	    <!--[if lt IE 9]>
	      <script src="dist/js/vendor/html5shiv.js"></script>
	      <script src="dist/js/vendor/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<table class="table table-hover">
			<tr class="active">
			  <th width="100">订单ID</th>
			  <th width="300">订单号</th>
			  <th>收货人</th>
			  <th>订单时间</th>
			  <th>订单状态</th>
			  <th width="230">操作</th>
			</tr>
			{{foreach from="$orderData" value="$v"}}
			<tr>
				<td>{{$v['oid']}}</td>
				<td>{{$v['number']}}</td>
				<td>{{$v['consignee']}}</td>
				<td>{{date('Y-m-d',$v['sendtime'])}}</td>
				<td>
					{{if value="$v['status'] eq 1"}}未付款{{endif}}
					{{if value="$v['status'] eq 2"}}已付款{{endif}}
					{{if value="$v['status'] eq 3"}}已发货{{endif}}
					{{if value="$v['status'] eq 4"}}已收货{{endif}}
				</td>
				<td>
					<a href="{{U('delivery',array('oid'=>$v['oid']))}}" class="btn btn-sm btn-info">发货</a>
					<a href="{{U('check',array('oid'=>$v['oid']))}}" class="btn btn-sm btn-warning">查看</a>
					<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('确定删除吗')) location.href='{{U('del',array('oid'=>$v['oid']))}}'">删除</a>
				</td>
			</tr>
			{{endforeach}}
		</table>
	</body>
</html>
