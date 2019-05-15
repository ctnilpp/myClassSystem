<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $page_title; ?></title>
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
  	<link rel="stylesheet" type="text/css" href="../assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
	<div class="row">
		<div class="login-container col-sm-offset-1 col-sm-4">
			<h3 class="login-title text-center">班级管理系统</h3>
			<form class="form-horizontal" action="index.php" method="post" onsubmit="return dosubmit()">
				<div class="form-group" id="UserNameDiv">
			    	<label for="UserName" class="col-sm-3 control-label">学号：</label>
			    	<div class="col-sm-8">
			    		<input type="text" class="form-control" id="UserName" name="username" placeholder="请输入学号">
			    		<span class="" id="UserNameTip" aria-hidden="true"></span>
			    	</div>
			  	</div>
			  	<div class="form-group" id="PasswordDiv">
				    <label for="Password" class="col-sm-3 control-label">密码：</label>
				    <div class="col-sm-8">
				    	<input type="password" class="form-control" id="Password" name="password" placeholder="请输入密码">
				    	<span class="" id="PasswordTip" aria-hidden="true"></span>
				    </div>
				</div>
				<div class="form-group" id="VerifyDiv">
				    <label for="Password" class="col-sm-3 control-label">验证码：</label>
				    <div class="col-sm-4">
				    	<input type="text" name="verify" class="form-control" id="Verify">
				    	<span class="" id="VerifyTip" aria-hidden="true"></span>
				    </div>
				    <div class="col-sm-3">
				    	<img src="../assets/img/xxx.jpg" style="width: 100px;height: 37px;" alt="" />
				    </div>
				</div>
			  	<div class="form-group">
				    <div class="col-sm-offset-3 col-sm-4">
				      	<button type="submit" class="btn btn-primary btn-block">登录</button>
					</div>
			  	</div>
			</form>
		</div>
	</div>
</body>
<!-- jQuery  -->
<script src="../assets/js/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<link rel="stylesheet" type="text/css" href="../assets/bootstrap-3.3.7-dist/js/bootstrap.min.js">
<script type="text/javascript" src="../assets/js/login.js"></script>
</html>