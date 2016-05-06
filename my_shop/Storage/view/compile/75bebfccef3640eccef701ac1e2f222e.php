<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/Home/css/hdjs.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/Home/css/load.css"/>
		<script src="<?php echo __PUBLIC__?>/Home/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo __PUBLIC__?>/Home/js/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
			<script>
				$(function() {
					$('#HDJS').validate({
						uname: {
							rule: {
								required: true
							},
							error: {
								required: '用户名不能为空'
							},
							success: '验证通过',
							message: '请输入用户名'
						},
						password: {
							rule: {
								required: true,
							},
							error: {
								required: '密码不能为空',
							}
						},
					})
				})
			</script>
	</head>
	<body>
		<div id="denglu">
			<h2>欢迎登录商城帐号</h2>
			
			<form id="HDJS" onsubmit="return hd_submit(this,'<?php echo U("Login/index")?>','<?php echo $_SERVER['HTTP_REFERER']?>')">
			<table class="huanyin">
				<tr>
					<th>用户名</th>
					<td>
						<input type="text" name="uname" class="put">
					</td>
				</tr>	
				<tr>
					<th>密码</th>
					<td>
						<input type="password" name="password" class="put">
					</td>
				</tr>
			</table>
			<input type="submit" value="登录" class="sub-load">
			</form>
		</div>
	</body>
</html>
