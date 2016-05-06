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
