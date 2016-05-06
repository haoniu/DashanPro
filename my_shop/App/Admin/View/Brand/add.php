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
		<form action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-success">添加品牌</div>
		<div class="form-group">
			<label for="exampleInputEmail1">品牌标题</label>
			<input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="bname">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">LOGO图</label>
			<input id="exampleInputEmail1" type="file" name="logo">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">是否热门
			<span><input id="exampleInputEmail1" class="form-control" type="checkbox" placeholder="" name="ishot" value="热门"></span></label>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">排序</label>
			<input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="sort">
		</div>
		<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
