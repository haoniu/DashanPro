<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>

	<link rel="stylesheet" href="{{__PUBLIC__}}/Bootstrap/Css/bootstrap.min.css" />
	<link rel="stylesheet" href="{{__PUBLIC__}}/Admin/Css/common.css" />
	<script src="{{__PUBLIC__}}/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(function(){
			$('select[name=cid]').change(function(){
				//获得被选中的tid
				var tid = $(':selected',this).attr('tid');
				//因为顶级分类没有类型，不需要发异步的
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
								attr += '<tr class="info"><td align="right">'+v.taname+'</td><td>';
								attr += '<select name="attr['+v.taid+']" id=""><option value="">请选择</option>';
									$.each(v.tavalue,function(kk, vv) {
										attr += '<option value="'+vv+'">'+vv+'</option>';
									});
								attr += '</select></td></tr>'; 

							}else{//否则就是规格
								spec += '<tr class="info"><td align="right">'+v.taname+'</td><td>';
								spec += '<select name="spec['+v.taid+'][value][]" id=""><option value="">请选择</option>';
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
	<div class="container-fluid">
	<div class="row-fluid">
	<div class="span12">

	<form action="" method='post' enctype="multipart/form-data">
		<fieldset>
			<legend>添加商品</legend>
			<table class='table table-bordered table-hover'>
				<thead>
					<tr>
						<th colspan="2" class="btn btn-primary">基本信息</th>
					</tr>
				</thead>
				<tbody>
					<tr class="info">
						<td>所属分类</td>
						<td>
							<select name="cid">
								<option value="0">-请选择-</option>
								{{foreach from="$cateData" value="$v"}}
									<option value="{{$v['cid']}}" tid="{{$v['type_tid']}}">{{$v['_name']}}</option>
								{{endforeach}}
							</select>
						</td>
					</tr>
					<tr class="info">
						<td>所属品牌</td>
						<td>
							<select name="bid">
								<option value="0">-请选择-</option>
								{{foreach from="$brands" value="$v"}}
									<option value="{{$v['bid']}}">{{$v['bname']}}</option>
								{{endforeach}}
								
							</select>
						</td>
					</tr>
					<tr class="info">
						<td>商品名称</td>
						<td>
							<input type="text" name='gname'/>
						</td>
					</tr>
					<tr class="info">
						<td>件数</td>
						<td>
							<input type="text" name='gnumber'/>
						</td>
					</tr>
					<tr class="info">
						<td>单位</td>
						<td>
							<input type="text" name='unit' value='件'/>
						</td>
					</tr>
					<tr class="info">
						<td>市价场</td>
						<td>
							<input type="text" name='marketprice'/>
						</td>
					</tr>
					<tr class="info">
						<td>商城价</td>
						<td>
							<input type="text" name='shopprice'/>
						</td>
					</tr>
					<tr class="info">
						<td>点击次数</td>
						<td>
							<input type="text" name='click'/>
						</td>
					</tr>
				</tbody>
			</table>

			<p class="btn btn-primary">商品属性</p>
			<table class="table table-bordered table-hover" id='attr' class="info">
				
				
			</table>
			<p class="btn btn-primary">商品规格</p>
			<table class="table table-bordered table-hover" id='spec'>
				
			</table>

			<table class='table table-bordered'>
				<tr>
					<th colspan="3" class="btn btn-primary">列表图</th>
				</tr>
				<tr class="info">
					<td>上传图片</td>
					<td>
						<input type="file" name='pic' id='pic'/>
					</td>
					<td id='pic-list'></td>
				</tr>
			</table>

			<table class='table table-bordered'>
				<tr>
					<th colspan="3" class="btn btn-primary">商品图册</th>
				</tr>
				<tr class="info">
					<td>上传图片</td>
					<td>
						<input type="file" name='photo' id='photo' />
					</td>
					<td id='photo-list'></td>
				</tr>
			</table>

			<table class='table'>
				<tr class="next_show">
					<th class="btn btn-primary">商品详细</th>
				</tr>
					<td>
						<textarea name="intro" id="intro"></textarea>
					</td>
			</table>

			<table class='table'>
				<tr class="next_show">
					<th class="btn btn-primary">售后服务</th>
				</tr>
					<td>
						<textarea name="service" id="service"></textarea>
					</td>
			</table>
			<input type="hidden" name='tid' value='0'/>
			<input type="submit" value="确认添加" class="btn btn-primary btn-block btn-large" />
		</fieldset>
	</form>

	</div>
	</div>
	</div>
</body>
</html>