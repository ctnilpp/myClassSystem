<?php
	//验证表单数据是否合法
 function is_valid(){
 	$errors = array();
 	if(empty($_POST['id'])){
 		$errors[] = "用户名不能为空";
 	}
 	else if(!preg_match('/^\d{11}$/',$_POST['id'])){
 		$errors[] = "用户名必须为数字且共11位";
 	}
 	if(empty($_POST['password'])){
 		$errors[] = "密码不能为空";
 	}
 	return $errors;
 }

 function user_certification($dbc){//用户验证
 	$user_row =array();
 	$id = $_POST['id'];
 	$password = $_POST['password'];
 	$q  =  "SELECT id,name,password,cid,role FROM students WHERE (id ='$id' AND password = sha1('$password'))";
 	$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 	if(mysqli_num_rows($r) == 1){
 		$user_row = mysqli_fetch_array($r,MYSQLI_ASSOC);
 	}
 	mysqli_free_result($r);
 	return $user_row;
 }

 //验证是否已经签到
 //具体方法为 从数据库中查看是否有与sign_config['id']相对应的slid,且看issign签到是否为1，为1则说明已经签到过，否则没有
 function is_sign($dbc,$sid,$slid){
 	 $q  =  "SELECT issign FROM sign WHERE (sid ='$sid' AND slid = '$slid')";	 
 	$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 	if(mysqli_num_rows($r)>0){
 		$result = mysqli_fetch_array($r,MYSQLI_ASSOC);
 	}
 	if($result['issign']=='1')return true;
 	else 
 	return false;
 }


//签到
 function user_sign($dbc,$sid,$slid){
 		$q = "UPDATE `sign` SET `issign`= '1' WHERE sid = '$sid' AND slid = '$slid'";
 		$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 		$q = "UPDATE `signlesson` SET `num`= `num`+1 WHERE id = '$slid'";
		$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " .mysqli_error($dbc));
 }

