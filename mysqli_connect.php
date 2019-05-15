<?php
  // 将数据库访问信息设置为常量：
  DEFINE ('DB_USER', 'root');
  DEFINE ('DB_PASSWORD', '');
  DEFINE ('DB_HOST', '127.0.0.1');
  DEFINE ('DB_NAME', 'db_g2');
  
  $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$dbc) {	// 若连接失败，触发错误
    trigger_error ('不能连接 MySQL: ' . mysqli_connect_error() );
  } else { // 否则，设置编码：
    mysqli_set_charset($dbc, 'utf8');
  }
  //利用phpmailer发送邮件 【第8课 帐号激活与密码重置 操作步骤 1.4 版本 1】
  function send_mail($to,$title,$content) {
    require_once("../phpmailer/class.phpmailer.php"); 
    require_once("../phpmailer/class.smtp.php");
    //实例化PHPMailer核心类
    $mail = new PHPMailer();
    // $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->Host = 'smtp.126.com';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->Hostname = 'http://www.sdmblog.com';
    $mail->CharSet = 'UTF-8';
    $mail->FromName = '校园微博';
    $mail->Username ='xxxx';
    $mail->Password = 'xxxx';  //126信箱第三方客户授权码
    $mail->From = 'xxxx@126.com';
    $mail->isHTML(true);
    $mail->addAddress($to,$title);
    $mail->Subject = $title;
    $mail->Body = $content;
    return $mail->send();
  }
?>