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
			    <th width="100">货品ID</th>
			    <th width="300">商品名称</th>
			    <th>数量</th>
			    <th>总价格</th>
			    <th>备注</th>
			</tr>
			{{foreach from="$listData" value="$v"}}
			<tr>
				<td>{{$v['gid']}}</td>
				<td>{{$v['name']}}</td>
				<td>{{$v['num']}}</td>
				<td>{{$v['subtotal']}}</td>
				<td>{{$v['explain']}}</td>
			</tr>
			{{endforeach}}
		</table>
	</body>
</html>
