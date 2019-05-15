<?php
    require('../config/db.inc.php');
    require('./share.inc.php');
    require('../config/sign.inc.php');
    require('../models/users.php');
    require('../mysqli_connect.php');
    $stu_path = STU_PATH;
    $page_title='班级管理系统';
		if(isset($_SESSION['id'])){//验证用户是否登录,若未登录，记录路径信息，并将其引导至登录界面
			$errors = array();
			$_SESSION['purl']  = $_SERVER['REQUEST_URI'];//获取当前页面的路径数据
			$user_info = $_SESSION;//登录用户即是学生
			$sign_config = array();
			$sign_config = get_sign_config();//获取签到表配置
			$errors = array();
			$able_sign = able_sign($sign_config['end']);
			if($sign_config['open']&&$able_sign){
					$open = '开启';
					$color = 'green';
			}
			else {
				$color = 'red';
				$open = '关闭';
			}
					if($_SERVER['REQUEST_METHOD']=='GET'){//如果没有提交表单，返回页面
						include('../views/static/stu.html.php');
					}
					if($_SERVER['REQUEST_METHOD']=='POST'){//如果提交表单，处理表单后再返回页面
						
						if($sign_config['open']){
							if($sign_config['password']==$_POST['password']){
								//先验证是否已经签到过，防止重复签到
								if(!is_sign($dbc,$user_info['id'],$sign_config['id'])){
									if($able_sign){
										user_sign($dbc,$user_info['id'],$sign_config['id']);
									 	$errors[] = "签到成功";
									}
									else $errors[] = "签到失败,超过签到期限";
								}
								else {
									$errors[] = "你已经签到过了";
								}
							}
							else $errors[] = "签到失败,密码错误";
						}
						else {
							$errors[] = "签到失败,签到未开启";
							// echo_redirect("签到失败,签到未开启",$stu_path);
						}
						include('../views/static/stu.html.php');
					}
 			}
		else 
			{
			redirect_to(LOGIN_PATH);
			}
   
?>