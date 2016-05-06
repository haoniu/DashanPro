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
		<table class="table table-hover">
			<tr class="active">
			  <th width="100">类型id</th>
			  <th>类型名称</th>
			  <th width="120">排序</th>
	
			  <th width="210">操作</th>
			</tr>
			<?php foreach ($tData as $v){?>
			<tr>
				<td><?php echo $v['tid']?></td>
				<td><?php echo $v['tname']?></td>
				<td><?php echo $v['tsort']?></td>
				<td>
					<a href="<?php echo U('Attr/index',array('tid'=>$v['tid']))?>" class="btn btn-sm btn-primary">属性列表</a>
					<a href="<?php echo U('edit',array('tid'=>$v['tid']))?>" class="btn btn-sm btn-warning">修改</a>
					<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('确定删除吗')) location.href='<?php echo U('del',array('tid'=>$v['tid']))?>'">删除</a>					
				</td>
			</tr>
			<?php }?>
		</table>
	</body>
</html>
