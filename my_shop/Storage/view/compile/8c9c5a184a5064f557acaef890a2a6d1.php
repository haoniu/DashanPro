<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>	
		<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/Home/css/load.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo __PUBLIC__?>/Home/css/hdjs.css" />
		<script src="<?php echo __PUBLIC__?>/Home/js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo __PUBLIC__?>/Home/js/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
		
	</head>

	<body>
		<div id="zc">
			<h2>注册商城帐号</h2>
			<form id="HDJS" action="" method="post">
				<table class="sczc">
					<tbody>
						<tr>
							<th>用户名</th>
							<td>
								<input type="text" name="uname" class="put">
							</td>
						</tr>
						<tr>
							<th>姓名</th>
							<td>
								<input type="text" name="name" class="put">
							</td>
						</tr>
						<tr>
							<th>性别</th>
							<td >
								<label>
									<input name="sex" type="radio" value="男" class="sex"> 男</label>
								<label>
									<input name="sex" type="radio" value="女"> 女</label>
								<span id="hd_sex"></span>
							</td>
						</tr>
						<tr>
							<th>邮箱</th>
							<td>
								<input type="text" name="email" class="put">
							</td>
						</tr>
						
						<tr>
							<th>手机</th>
							<td>
								<input type="text" name="mobile" class="put">
							</td>
						</tr>
						<tr>
							<th>QQ号</th>
							<td>
								<input type="text" name="qq" class="put">
							</td>
						</tr>
						<tr>
							<th>密码</th>
							<td>
								<input type="password" name="password" class="put">
							</td>
						</tr>
						<tr>
							<th>确认密码</th>
							<td>
								<input type="password" name="cpassword" class="put">
							</td>
						</tr>
					</tbody>
				</table>
				<input type="submit" value="立即注册" class="sub">
			</form>
		<!--表单验证Start-->
			<script>
				$(function() {
					$('#HDJS').validate({
						uname: {
							rule: {
								required: true,
								ajax:{url:'<?php echo U('Login/ajaxCheck')?>'}
							},
							error: {
								required: '用户名不能为空'
							},
							success: 'ok',
							message: '请输入用户名'
						},
						email: {
							rule: {
								required: true,
								email: true
							},
							error: {
								required: '邮箱不能为空',
								email: '邮箱不正确'
							},
							success: 'ok',
							message: '请输入邮箱'
						},
						mobile: {
							rule: {
								phone: true
							},
							error: {
								phone: '手机号错误'
							},
							success: 'ok',
							message: '请输入手机号'
						},
						name: {
							rule: {
								china: true
							},
							error: {
								china: '不是中文哟'
							},
							success: 'ok',
						},
						qq: {
							rule: {
								qq: true
							},
							error: {
								qq: 'QQ号错了'
							},
							success: 'ok',
						},
						password: {
							rule: {
								required: true,
								confirm: 'cpassword'
							},
							error: {
								required: '密码不能为空',
								confirm: '两次密码不一致'
							},
							success: 'ok',
						},
						sex: {
							rule: {
								required: true
							},
							error: {
								required: '请选择性别'
							},
							success: 'ok',
						},
					})
				})
			</script>
			<!--表单验证End-->
		</div>
	</body>

</html>