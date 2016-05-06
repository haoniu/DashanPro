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
	   	
	    <script src="<?php echo __PUBLIC__?>/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
	    <script type="text/javascript" src="<?php echo __PUBLIC__?>/hdjs/hdjs.min.js"></script>
	    <link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/hdjs/hdjs.css">
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
			  <?php foreach ($Spec as $v){?>
			  <th><?php echo $v['0']['taname']?></th>
			  <?php }?>
			  <th width="120">库存</th>
			  <th>货号</th>
			  <th width="210">操作</th>
			</tr>
			<?php foreach ($data as $v){?>
			<tr>
				<td><?php echo $v['glid']?></td>
				<?php foreach ($v['gtvalue'] as $vv){?>
				<td><?php echo $vv?></td>
				<?php }?>
				<td><?php echo $v['inventory']?></td>
				<td><?php echo $v['number']?></td>
				<td>
					<a href="<?php echo U('edit',array('gid'=>$gid,'glid'=>$v['glid']))?>" class="btn btn-sm btn-warning">修改</a>
					<a href="javascript:;" class="btn btn-sm btn-danger" onclick="if(confirm('确定删除吗')) location.href='<?php echo U('del',array('glid'=>$v['glid']))?>'">删除</a>
				</td>
			</tr>
			<?php }?>
		</table>
		<br />
		<br />
		<br />
		<form onsubmit="return hd_submit(this,'<?php echo U("GoodsList/index")?>','<?php echo U("GoodsList/index",array('gid'=>Q('get.gid',0,'intval')))?>')">
			<table class="table table-hover">
				<tr>
					<th width="100">添加货品</th>
					<?php foreach ($Spec as $v){?>
					<th>
						
						<select name="combine[]" class="form-control">
							<option value="">-请选择<?php echo $v[0]['taname']?>-</option>
							<?php foreach ($v as $vv){?>
							<option value="<?php echo $vv['gtid']?>" gtid="<?php echo $vv['gtid']?>"><?php echo $vv['gtvalue']?></option>
							<?php }?>
						</select>
					</th>
					<?php }?>
					<th><input class="form-control" type="text" placeholder="请输入库存" name="inventory" /></th>
					<th><input class="form-control" type="text" placeholder="请输入货号" name="number" /></th>
					<input type="hidden" name="gid" id="gid" value="<?php echo $gid?>" />
					<th>
						<button class="btn btn-primary btn-s" type="submit"> 确定添加 </button>
						<a href="<?php echo U('Goods/index')?>" class="btn btn-primary btn-s">返回</a>
					</th>
				</tr>
			</table>
		</form>
		
	</body>
</html>
