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
			<tr>
				<td>{{$data['glid']}}</td>
				{{foreach from="$data['gtvalue']" value="$v"}}
				<td>{{$v}}</td>
				{{endforeach}}
				<td>{{$data['number']}}</td>
				<td>{{$data['inventory']}}</td>
			</tr>
		</table>
		<br />
		<br />
		<form action="" method="post">
			<table class="table table-hover">
				<tr>
					<th width="100">修改货品</th>
					{{foreach from="$Spec" value="$v"}}
					<th>
						
						<select name="combine[]" class="form-control">
							<option value="">-请选择{{$v[0]['taname']}}-</option>
							{{foreach from="$v" value="$vv"}}
							<option value="{{$vv['gtid']}}" {{if value="in_array($vv['gtid'],$data['combine'])"}}selected{{endif}}>{{$vv['gtvalue']}}</option>
							{{endforeach}}
						</select>
					</th>
					{{endforeach}}
					<th><input class="form-control" type="text" placeholder="请输入库存" name="number"  value="{{$data['number']}}"/></th>
					<th><input class="form-control" type="text" placeholder="请输入货号" name="inventory" value="{{$data['inventory']}}"/></th>
					<input type="hidden" name="gid" id="gid" value="{{$gid}}" />
					<th>
						<button class="btn btn-primary btn-s" type="submit"> 确定修改 </button>
					</th>
				</tr>
			</table>
		</form>
	</body>
</html>
