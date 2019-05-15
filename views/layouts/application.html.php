<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>考勤系统</title>
    <link rel="icon" href="https://static.jianshukeji.com/hcode/images/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bui.css" />
   <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="../assets/js/vue.min.js"></script>
    <!-- 依赖库 手机调试的js引用顺序如下 -->
    <script src="../assets/js/zepto.js"></script>
    <script src="../assets/js/plugins/fastclick.js"></script>
    <!-- BUI库 -->
    <script src="../assets/js/bui.js"></script>
    <style type="text/css">
    .personal-header{
        background: url("images/Personal1-bg-personal1.png") no-repeat;
        background-size: cover;
        padding-top: .3rem;
        padding-bottom: .3rem;
    }
    .personal-header .personal-img{
        width: 1.2rem;
        height: 1.2rem;
        border-radius: 50%;
        border: 3px solid #fff;
        overflow: hidden;
        margin: 0 auto .2rem auto;
        text-align: center;
    }
    .personal-header .personal-img img{
        width: 100%;
    }
    .personal-header p{
        text-align: center;
        color: #ffffff;
        margin-bottom: 0.1rem;
    }
    .personal-header .name{
        font-size: 0.26rem;
    }
    .personal-header .grade{
        font-size: 0.2rem;
    }
    .nav-list{
        border-top: none;
        margin-top: 0.2rem;
        padding: 0 0.2rem;
        background-color: #ffffff;
    }
    .nav-list .bui-btn{
        padding-left: 0;
        padding-right: 0;
    }
    .nav-list li:first-child{
        border-top: none;
    }
    .nav-list .icon i{
        font-size: 0.4rem;
    }
    .nav-list .icon{
        height: 0.42rem;
    }
    .nav-list .bui-btn{
        border: none;
        border-top: 1px solid #efefef;
    }
    
    .icon-yellow{
        color: #ffad03;
    }
    .icon-thinblue{
        color: #56ced5;
    }
    .icon-green{
        color: #6ed046;
    }
    .icon-red{
        color: #fd8886;
    }
</style>

    <?php include('../views/layouts/shim.html.php'); ?>
</head>
<body>
	<?php include('../views/layouts/header.html.php'); ?>
	<?php include('../views/layouts/flash.html.php'); ?>