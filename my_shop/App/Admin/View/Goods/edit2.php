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
	    <!--<script src="{{__PUBLIC__}}/Admin/goods.js" type="text/javascript" charset="utf-8"></script>-->

<script type="text/javascript">
		    $(function(){
	//获得被选中的cid
	$('select[name=cid]').change(function(){
		//获得被选中的tid
		var tid = $(':selected',this).attr('tid');
		//顶级没类型不发异步
		if(tid == 0) return;
		
		//通过异步发送tid，获得类型属性，然后组合字符串插入到页面
		$.ajax({
		//请求地址
			url : '{{U('ajaxGetAttr')}}',
			//发送的数据
			data: {tid : tid},
			//请求类型
			type:'post',
			//返回的数据类型
			dataType:'json',
			//成功返回
			success:function(phpData){
				//属性
				var attr = '';
				//规格
				var spec = '';
					$.each(phpData,function(k, v) {
						//如果是属性时
						if(v.class == 0){
							attr += '<tr><td>'+v.taname+'</td><td>';
							attr += '<select name="attr['+v.taid+']" id="" class="form-control"><option value="">请选择</option>';
								$.each(v.tavalue,function(kk, vv) {
									attr += '<option value="'+vv+'">'+vv+'</option>';
								});
							attr += '</select></td></tr>'; 

						}else{//否则就是规格
							spec += '<tr><td>'+v.taname+'</td><td>';
							spec += '<select name="spec['+v.taid+'][value][]" id="" ><option value="">请选择</option>';
								$.each(v.tavalue,function(kk, vv) {
									spec += '<option value="'+vv+'">'+vv+'</option>';
								});
							spec += '</select></td>';
							spec += '<td>附加价格：<input type="text" name="spec['+v.taid+'][price][]" value="0" /></td>'
							spec += '<td><span class="add-spec btn btn-success"><i class="icon-plus icon-white"></i>添加规格</span></td>';
							spec += '</tr>'; 
						}
					});
				$('#attr').html(attr);
				$('#spec').html(spec);
			}
		})
	})	
	//点击增加规格
	$('.add-spec').live('click',function(){
		//找到父级的tr
		var tr = $(this).parents('tr');
		//克隆它
		var trObj = tr.clone();
		$('.add-spec',trObj).removeClass('btn-success add-spec').addClass('btn-danger del-spec').html('<i class="icon-minus icon-white"></i>删除规格');
		//在它的下一行插入
		tr.after(trObj);

	})
	//删除规格
	$('.del-spec').live('click',function(){
		$(this).parents('tr').remove();
	})
	
	
})
</script>
	</head>
	<body>
		<form action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-success">添加商品</div>
		<div class="form-group">
			<button type="button" class="btn btn-primary btn-sm">基本信息</button>
			<table class="table table-hover">
				<tr>
					<td>所属分类</td>
					<td>
						<select name="cid" class="form-control">
							<option value="">-请选择-</option>
							{{foreach from="$cateData" value="$v"}}
							<option value="{{$v['cid']}}" tid="{{$v['type_tid']}}" {{if value="$oldData['cid'] eq $v['cid']"}}selected{{endif}}>{{$v['_name']}}</option>
							{{endforeach}}
						</select>
					</td>
				</tr>
				<tr>
					<td>所属品牌</td>
					<td>
						<select name="bid" class="form-control">
							<option value="">-请选择-</option>
							{{foreach from="$brands" value="$v"}}
							<option value="{{$v['bid']}}" {{if value="$oldData['bid'] eq $v['bid']"}} selected {{endif}}>{{$v['bname']}}</option>
							{{endforeach}}
						</select>
					</td>
				</tr>
				<tr>
					<td>商品名称</td>
					<td><input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="gname" value="{{$oldData['gname']}}"></td>
				</tr>
				<tr>
					<td>商品数量</td>
					<td><input id="exampleInputEmail1" class="form-control" type="text" placeholder="" required="" name="gnumber" value="{{$oldData['gnumber']}}"></td>
				</tr>
				<tr>
					<td>单位</td>
					<td><input id="exampleInputEmail1" class="form-control" type="text" placeholder="" required="" name="unit" value="{{$oldData['unit']}}"></td>
				</tr>
				<tr>
					<td>市场价</td>
					<td><input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="marketprice" value="{{$oldData['marketprice']}}"></td>
				</tr>
				<tr>
					<td>商城价</td>
					<td><input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="shopprice" value="{{$oldData['shopprice']}}"></td>
				</tr>
				<tr>
					<td>点击次数</td>
					<td><input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="click" value="{{$oldData['click']}}"></td>
				</tr>
			</table>
			
		</div>
		<div class="form-group">
			<button type="button" class="btn btn-primary btn-sm">列表图</button><br />
			<input id="exampleInputEmail1" type="file" name="pic">
		</div>
		<div class="form-group">
			<button type="button" class="btn btn-primary btn-sm">商品属性</button>
			<table class="table .table-hover" id="attr">
				<tr>
					<td></td>
					<td>
						<select name="attr['+v.taid+']" id="" class="form-control">
							<option value="">请选择</option>';								
							<option value="'+vv+'"></option>
						</select>
					</td>
				</tr>
			</table>
		</div>
		
		<div class="form-group">
			<button type="button" class="btn btn-primary btn-sm">商品规格</button>
			<table class="table .table-hover" id="spec">
				
			</table>
		</div>
		
		<script type="text/javascript" charset="utf-8" src="{{__PUBLIC__}}/ueditor1_4_3/ueditor.config.js"></script>
		<script type="text/javascript" charset="utf-8" src="{{__PUBLIC__}}/ueditor1_4_3/ueditor.all.min.js"> </script>
		<script type="text/javascript" charset="utf-8" src="{{__PUBLIC__}}/ueditor1_4_3/lang/zh-cn/zh-cn.js"></script>
		<div class="form-group">
			<button type="button" class="btn btn-primary btn-sm">商品详细</button>
			<script id="editor" type="text/plain" style="width:100%;height:300px;" name="intro">{{$oldDetail['intro']}}</script>
			<script>
		    		var ue = UE.getEditor('editor');
			</script>
		</div>
		
		
		<div class="form-group">
			<button type="button" class="btn btn-primary btn-sm">售后服务</button>
			<script id="editor1" type="text/plain" style="width:100%;height:300px;" name="service">{{$oldDetail['service']}}</script>
			<script>
		    		var ue = UE.getEditor('editor1');
			</script>
		</div>
		<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
