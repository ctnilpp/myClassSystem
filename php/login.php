<?php
    require('../config/db.inc.php');
    require('../models/users.php');
    require('../mysqli_connect.php');
    require('./share.inc.php');
    if($_SERVER['REQUEST_METHOD']=='GET'){
    	include('../views/static/login.html.php');
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $errors = is_valid();
            if(empty($errors)){//正常输入
                $user_row = array();
                $user_row = user_certification($dbc);
                if(!empty($user_row)){//在数据库找到该用户
                    $_SESSION = array_slice($user_row,0,5,true); //创建会话
                    $s = $_SESSION['id'];
                    if(!isset($_SESSION['purl'])){//检查是否有路径数据，没有则返回主页面
                            //根据权限不同需要返回到不同的页面去
                            if($_SESSION['role']=='学生')  redirect_to(STU_PATH);
                            if($_SESSION['role']=='班干')  redirect_to(ADMIN_PATH);
                    }
                    else redirect_to(STU_PATH($_SESSION['purl'])); //如果有路径数据，返回路径数据存储的页面
                }
                else {
                    $errors[] = "无效的用户名或密码";
                }
                mysqli_close($dbc);
    	    }
    	include('../views/static/login.html.php');
    }
    $page_title='班级管理系统';
    
?>