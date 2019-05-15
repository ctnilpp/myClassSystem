<?php
    require('../config/db.inc.php');
    require('../models/users.php');
    require('../models/signlesson.php');
    require('../mysqli_connect.php');
    require('./share.inc.php');
    $page_title='班级管理系统';
    	if(isset($_SESSION['id'])){//验证用户是否登录,若未登录，记录路径信息，并将其引导至登录界面
			$_SESSION['purl']  = $_SERVER['REQUEST_URI'];//获取当前页面的路径数据
			$user_info = $_SESSION;//登录用户即是班干
					if($_SERVER['REQUEST_METHOD']=='GET'){//如果没有提交表单，返回页面
						$record_info = array();
						if(isset($_GET['date'])){
							$record_info = get_record($dbc,$_GET['date'],$user_info['cid']);
						}
						if(!empty($record_info)){//记录不为空则输出页面,并做好分页
							
								include('../views/static/record.html.php');
						}
						else  //如果记录为空,输出一个为空时的页面
						{
							include('../views/static/record.html.php');
						}
					}
					if($_SERVER['REQUEST_METHOD']=='POST'){//如果提交表单，处理表单后再返回页面
						$change = json_decode($_POST['data']);
						//获取表单信息
						$c_sign = array();
						foreach ($change as $key => $value) {
							if($key =='slid') $c_sign['slid'] = $value;
							if($key =='signid') $c_sign['signid'] = explode(",",$value);
						}
						$post_id= $c_sign['slid'];
						foreach ($c_sign['signid'] as $key => $value) {
							update_sign($dbc,$value,$post_id);
						}
					}
 			}
		else 
			{
			redirect_to(LOGIN_PATH);
			}
?>