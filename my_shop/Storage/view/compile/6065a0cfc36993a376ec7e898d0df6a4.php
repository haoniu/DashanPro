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
	</head>
	<body>
		<form action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-success">添加品牌</div>
		<div class="form-group">
			<label for="exampleInputEmail1">品牌标题</label>
			<input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="bname" value="<?php echo $oldData['bname']?>">
		</div>
		<script type="text/javascript">
			$(function(){
				//点击'x'之后
				$('.close_img').click(function(){
					//1.关闭图片，x也消失
					$('.img_div').remove();
					//2.显示上传表单
					$('.file_div').html('<input type="file" name="thumb">');
				})
			})
		</script>
		<div class="form-group">
			<label for="exampleInputEmail1">LOGO图</label>
			<!--如果有缩略图则显示图片-->
			<?php if($oldData['logo']){?>
                
				<div class="img_div">
					<img src="<?php echo __ROOT__?>/<?php echo $oldData['logo']?>"/>
					<a href="javascript:;" class="close_img">X</a>
					<input type="hidden" name="logo" value="<?php echo $oldData['logo']?>"/>
				</div>
			<?php }else{?>
				<input type="file" name="logo">
			
               <?php }?>
		</div>
		<!--放file表单的div-->
		<div class="file_div">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">是否热门
			<span><input id="exampleInputEmail1" class="form-control" type="checkbox" placeholder="" name="ishot" value="热门" <?php if('热门'==$oldData['ishot']){?>
                checked
               <?php }?>></span></label>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">排序</label>
			<input id="exampleInputEmail1" class="form-control" type="text" placeholder="" name="sort" value="<?php echo $oldData['sort']?>">
		</div>
		<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		<input type='hidden' name='__TOKEN__' value='3a038e5ceece7a87bb271867c13ced48'</form>
	</body>
</html>
