<?php
function create_stu_sign($dbc,$coid,$slid,$cid){//创建班级学生的签到表
 	$q2 = "SELECT * FROM `students` WHERE cid = $cid";
 	$r2  = mysqli_query($dbc,$q2) or trigger_error("查询：$q2\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 	$result2 = array();
 	$length = mysqli_num_rows($r2);
 	$i = $length;
 	while($i>0){
 		array_push($result2, mysqli_fetch_array($r2,MYSQLI_ASSOC));
 		$i--;
 	}
 	$j = 0;
 	while($j<$length){
 		$sid = $result2[$j]['id'];
 		$issign = '0';
 		$q3 = "INSERT INTO `db_g2`.`sign` (`id`, `issign`, `sid`, `slid`) VALUES (NULL, '$issign', '$sid', '$slid');";
 		$r3 = mysqli_query($dbc,$q3) or trigger_error("查询：$q3\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 		$j++;
 	}
 	

}
