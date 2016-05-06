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
		<a href="{{U('Type/index')}}" class="btn btn-sm btn-info">返回上一步</a><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<a href="{{U('add',array('tid'=>$tid))}}" class="btn btn-sm btn-info">添加属性</a>
		<br />
		
		<table class="table table-hover">
			
			<tr class="active">
			  <th width="100">属性ID</th>
			  <th width="150">属性名称</th>
			  <th width="200">属性类别</th>
			  <th width="400">属性值</th>
			  <th width="200">操作</th>
			</tr>
			{{foreach from="$data" value="$v"}}
			<tr>
				<td>{{$v['taid']}}</td>
				<td>{{$v['taname']}}</td>
				{{if value="$v['class'] == 0"}}
				<td>属性</td>
				{{else if}}
				<td>规格</td>
				{{endif}}
				<td>{{$v['tavalue']}}</td>
				<td>
					<a href="{{U('edit',array('taid'=>$v['taid'],'tid'=>$tid))}}" class="btn btn-sm btn-warning">编辑</a>
					<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('确定删除吗')) location.href='{{U('del',array('taid'=>$v['taid']))}}'">删除</a>					
				</td>
			</tr>
			{{endforeach}}
			
		</table>
	</body>
</html>
