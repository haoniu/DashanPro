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
	    <script type="text/javascript" src="{{__PUBLIC__}}/jquery-1.8.2.min.js"></script>
	    <script type="text/javascript" src="{{__PUBLIC__}}/hdjs/hdjs.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="{{__PUBLIC__}}/hdjs/hdjs.css">
	</head>
	<body>
		<form onsubmit="return hd_submit(this,'{{U("Type/add")}}','{{U("Type/index")}}')">
			<div class="alert alert-success">添加类型</div>
			<div class="form-group">
				<label for="exampleInputEmail1">类型名称</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入类型名称" name="tname">
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">分类排序</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入类型排序" required="" name="tsort" value="100">
			</div>
			<input type="hidden" name="type_tid" id="" value="" />
			<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
