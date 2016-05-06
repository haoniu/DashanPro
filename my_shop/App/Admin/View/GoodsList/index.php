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
	   	
	    <script src="{{__PUBLIC__}}/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
	    <script type="text/javascript" src="{{__PUBLIC__}}/hdjs/hdjs.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="{{__PUBLIC__}}/hdjs/hdjs.css">
		<script type="text/javascript">
			$(function(){
				
				//获得被选中的
				$('select').change(function(){
					var v = $(this).val();
					document.title = v;
				})
				
				
			})
		</script>
	</head>
	<body>
		
		
		<table class="table table-hover">
			<tr class="active">
			  <th width="100">货品ID</th>
			  {{foreach from="$Spec" value="$v"}}
			  <th>{{$v['0']['taname']}}</th>
			  {{endforeach}}
			  <th width="120">库存</th>
			  <th>货号</th>
			  <th width="210">操作</th>
			</tr>
			{{foreach from="$data" value="$v"}}
			<tr>
				<td>{{$v['glid']}}</td>
				{{foreach from="$v['gtvalue']" value="$vv"}}
				<td>{{$vv}}</td>
				{{endforeach}}
				<td>{{$v['inventory']}}</td>
				<td>{{$v['number']}}</td>
				<td>
					<a href="{{U('edit',array('gid'=>$gid,'glid'=>$v['glid']))}}" class="btn btn-sm btn-warning">修改</a>
					<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('确定删除吗')) location.href='{{U('del',array('glid'=>$v['glid']))}}'">删除</a>
				</td>
			</tr>
			{{endforeach}}
		</table>
		<br />
		<br />
		<br />
		<form onsubmit="return hd_submit(this,'{{U("GoodsList/index")}}','{{U("GoodsList/index",array('gid'=>Q('get.gid',0,'intval')))}}')">
			<table class="table table-hover">
				<tr>
					<th width="100">添加货品</th>
					{{foreach from="$Spec" value="$v"}}
					<th>
						
						<select name="combine[]" class="form-control">
							<option value="">-请选择{{$v[0]['taname']}}-</option>
							{{foreach from="$v" value="$vv"}}
							<option value="{{$vv['gtid']}}" gtid="{{$vv['gtid']}}">{{$vv['gtvalue']}}</option>
							{{endforeach}}
						</select>
					</th>
					{{endforeach}}
					<th><input class="form-control" type="text" placeholder="请输入库存" name="inventory" /></th>
					<th><input class="form-control" type="text" placeholder="请输入货号" name="number" /></th>
					<input type="hidden" name="gid" id="gid" value="{{$gid}}" />
					<th>
						<button class="btn btn-primary btn-s" type="submit"> 确定添加 </button>
						<a href="{{U('Goods/index')}}" class="btn btn-primary btn-s">返回</a>
					</th>
				</tr>
			</table>
		</form>
		
	</body>
</html>
