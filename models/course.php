<?php 
 //获取班级的课表信息
 function get_course($dbc,$cid,$semester){
 	$course_info = array();
 	$q = "SELECT * FROM `course` WHERE ` semester` = $semester AND `cid` = $cid";
 	$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 	$length = mysqli_num_rows($r);
 	$i=$length;
 	while($length>0){
 		array_push($course_info, mysqli_fetch_array($r,MYSQLI_ASSOC));
 		$length--;
 	}
 	mysqli_free_result($r);
 	return $course_info;
 }

