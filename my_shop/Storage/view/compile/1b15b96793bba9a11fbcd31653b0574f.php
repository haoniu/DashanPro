<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
	    <!-- Loading Bootstrap -->
	    <link href="<?php echo __PUBLIC__?>/Admin/Flat/dist/css/vendor/bootstrap.min.css" rel="stylesheet">
	    <!-- Loading Flat UI -->
	    <link href="<?php echo __PUBLIC__?>/Admin/Flat/dist/css/flat-ui.css" rel="stylesheet">
	    <link href="<?php echo __PUBLIC__?>/Admin/Flat/docs/assets/css/demo.css" rel="stylesheet">
	    <link rel="shortcut icon" href="<?php echo __PUBLIC__?>/Admin/Flat/img/favicon.ico">
	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	    <!--[if lt IE 9]>
	      <script src="dist/js/vendor/html5shiv.js"></script>
	      <script src="dist/js/vendor/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<form action="" method="post">
			<div class="alert alert-success">添加类型</div>
			<div class="form-group">
				<label for="exampleInputEmail1">类型名称</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入类型名称" name="tname" value="<?php echo $oldData['tname']?>">
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">分类排序</label>
				<input id="exampleInputEmail1" class="form-control" type="text" placeholder="请输入类型排序" required="" name="tsort" value="<?php echo $oldData['tsort']?>">
			</div>
			<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
