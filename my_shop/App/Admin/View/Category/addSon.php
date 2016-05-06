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
		<form onsubmit="return hd_submit(this,'{{U("Category/add")}}','{{U("Category/index")}}')">
			<div class="alert alert-success">添加子分类</div>
			<div class="form-group">
				<label for="exampleInputEmail1">子分类名称</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入分类名称" name="cname">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">所属分类</label>
				<select name="pid" class="form-control">
					<option value="{{$fatherCate['cid']}}">{{$fatherCate['cname']}}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">添加的类型</label>
				<select name="type_tid" class="form-control">
					{{foreach from="$allType" value="$v"}}
					<option value="{{$v['tid']}}">{{$v['tname']}}</option>
					{{endforeach}}
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">排序序号</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入排序号码"  name="csort">
			</div>
			<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
