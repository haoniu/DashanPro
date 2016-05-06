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
	    <script type="text/javascript" src="{{__PUBLIC__}}/jquery-1.8.2.min.js"></script>
	    <script type="text/javascript" src="{{__PUBLIC__}}/hdjs/hdjs.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="{{__PUBLIC__}}/hdjs/hdjs.css">
	</head>
	<body>
		<form onsubmit="return hd_submit(this,'{{U("Order/delivery")}}','{{U("Order/send")}}')">
			<div class="alert alert-success">发送货品</div>
			<p class="bg-info">当前订单号：{{$oldData['number']}}</p>
			<div class="form-group">
				<label for="exampleInputEmail1">配送快递</label>
				<select name="express" class="form-control" width="300">
					<option value="中通">中通</option>
					<option value="圆通">圆通</option>
					<option value="申通">申通</option>
					<option value="汇通">汇通</option>
					<option value="顺风">顺风</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">物流单号</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入物流单号"  name="num">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">订单备注</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入订单备注" name="remark">
			</div>
			<input type="hidden" name="status" id="" value="3" />
			<input type="hidden" name="oid" id="" value="{{$oid}}" />
			<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
