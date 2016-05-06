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
	    <link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/hdjs/hdjs.css"/>
	    <script src="<?php echo __PUBLIC__?>/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
	    <script src="<?php echo __PUBLIC__?>/hdjs/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
	    <script type="text/javascript">
	    		$(function(){
	    			 $('#password').validate({
	    			 	//要验证的表单的name名称
	    				password :  {
	    					//规则
			                rule: {
			                    required: true,
			                },
			                error: {
			                    required: '旧密码不能为空',
			                },
			                success: 'ok',
			                message: '请填写旧密码'
	            		},
	            		newPassword :  {
	    					//规则
			                rule: {
			                    required: true,
			                    minlen:1,
			                    maxlen:20
			                },
			                error: {
			                    required: '新密码不能为空',
			                    minlen:'新密码不得少于6位',
			                    maxlen:'新密码不得超出20位'
		                	},
		                	success: 'ok',
			                message: '请填写新密码'
		            		},
		            	confirmPassword :  {
		    					//规则
			                rule: {
			                    required: true,
			                    confirm: 'newPassword'
			                },
			                error: {
			                    required: '确认密码不能为空',
			                    confirm:'两次密码不一致'
			                },
			                success: 'ok',
			                message: '请填写确认密码'
	            		},
	    			 })
	    		})
	    </script>
	</head>
	<body>
		<form action="" method="post" id="password">
		<div class="alert alert-success">修改密码</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><span id="hd_password"></span></label>
			<input id="exampleInputEmail1" class="form-control" type="password" placeholder="" required="" name="password">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><span id="hd_newPassword"></label>
			<input id="exampleInputEmail1" class="form-control" type="password" placeholder="" required="" name="newPassword">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><span id="hd_confirmPassword"></label>
			<input id="exampleInputEmail1" class="form-control" type="password" placeholder="" required="" name="confirmPassword">
		</div>
		<button class="btn btn-primary btn-block" type="submit"> 确定 </button>
		</form>
	</body>
</html>
