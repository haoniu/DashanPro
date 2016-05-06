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
		<form action="" method="post">
			<div class="alert alert-success">添加属性</div>
			<div class="form-group">
				<label for="exampleInputEmail1">属性名称</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入属性名称" name="taname" value="{{$oldData['taname']}}">
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">属性类别</label><br />
				<label>属性：<input id="exampleInputEmail1" class="" type="radio" name="class" value="0" {{if value="'0' eq $oldData['class']"}}checked{{endif}}><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></label>
				<label>规格：<input id="exampleInputEmail1" class="" type="radio" name="class" value="1" {{if value="'1' eq $oldData['class']"}}checked{{endif}}></label>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">属性值</label>
				<textarea name="tavalue" rows="5" cols=""  class="form-control" placeholder="请输入属性值，输入多个，请用|分开" value="">{{$oldData['tavalue']}}</textarea>
			</div>
			
			<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
