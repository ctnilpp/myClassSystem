<?php
    require('../config/db.inc.php');
    require('./share.inc.php');
    require('../config/sign.inc.php');
    require('../models/users.php');
    require('../models/signlesson.php');
    require('../models/course.php');
    require('../mysqli_connect.php');
     require('../models/sign.php');
    $admin_path = ADMIN_PATH;
    $page_title='班级管理系统';
      	if(isset($_SESSION['id'])){//验证用户是否登录,若未登录，记录路径信息，并将其引导至登录界面
      		if($_SESSION['role']=='班干'){
			$_SESSION['purl']  = $_SERVER['REQUEST_URI'];//获取当前页面的路径数据
			$user_info = $_SESSION;//登录用户即是班干
			$sl_info =array();
			$sl_info =get_signlesson($dbc);
			$co_info =get_course($dbc,$user_info['cid'],get_semester());
			$sign_config = array();
			$sign_config = get_sign_config();//获取签到表配置
			// var_dump(date("Y-m-d H:i:s",time()));
			if(!$sign_config['open']){
					$open = '开启考勤';
					$color = 'success';
			}
			else {
				$color = 'danger';
				$open = '关闭考勤';
			}
					if($_SERVER['REQUEST_METHOD']=='GET'){//如果没有提交表单，返回页面
								include('../views/static/admin.html.php');
					}
					if($_SERVER['REQUEST_METHOD']=='POST'){//如果提交表单，处理后再返回页面
								
								//处理考勤配置
								if(isset($_POST['data'])){
										$con = json_decode($_POST['data']);
										change_sign_config($con);
								}
								//处理考勤开关
								if(isset($_POST['open'])){
									if(!$sign_config['open']){
										$sign_submit = array();
										$sign_submit = create_signlesson($dbc,$sign_config,$user_info['cid']);
										$sign_config['id'] = submit_signlesson($dbc,$sign_submit);
										$time = $sign_config['time'];
										$sign_config['end'] = strtotime("+$time minute");
										change_sign_config($sign_config);
										create_stu_sign($dbc,$sign_submit['coid'],$sign_config['id'],$user_info['cid']);
										}
									change_sign_open();
									unset($_POST['open']);
									redirect_to(ADMIN_PATH);
								}
					}
 			  }
 			  else redirect_to(LOGIN_PATH);
 			}
		else 
			{
			redirect_to(LOGIN_PATH);
			}
?>