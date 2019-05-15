<?php
	 //获取考勤的记录并做分页输出
 function get_signlesson($dbc){
 	$sign_info = array();
 	// $q = "SELECT * FROM signlesson ";
 	// $q = "SELECT classinfo.num as cnum,course.id as coid,course.name,signlesson.id as slid,signlesson.date,signlesson.num,signlesson.content from course inner join signlesson on course.id =signlesson.coid inner join classinfo on classinfo.id = course.cid";
 	$q = "SELECT DISTINCT `date`  FROM signlesson ";
 	$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 	$length = mysqli_num_rows($r);
 	$i=$length;
 	while($length>0){
 		array_push($sign_info, mysqli_fetch_array($r,MYSQLI_ASSOC));
 		$length--;
 	}
 	mysqli_free_result($r);
 	return $sign_info;
 }


 function get_record($dbc,$date,$cid){
 	$record_info =array();
 	$q = "SELECT * FROM `signlesson` WHERE `date` = '$date'";
 	$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 	$length = mysqli_num_rows($r);
 	$i=0;
 	while($length>0){
 		array_push($record_info, mysqli_fetch_array($r,MYSQLI_ASSOC));
 		//查找course
 		$coid = $record_info[$i]['coid'];
 		$q2 = "SELECT * FROM `course` WHERE `id` = '$coid'";
 	$r2  = mysqli_query($dbc,$q2) or trigger_error("查询：$q2\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 		if(mysqli_num_rows($r2)>0){
 			$course_info = mysqli_fetch_array($r2,MYSQLI_ASSOC);
 		}
 		$record_info[$i]['name'] = $course_info['name'];

 		//查找课室
 		$class_info = array();
 		$q2 = "SELECT * FROM `classinfo` WHERE `id` = '$cid'";
 		$r2  = mysqli_query($dbc,$q2) or trigger_error("查询：$q2\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 		if(mysqli_num_rows($r2)>0){
 			$class_info = mysqli_fetch_array($r2,MYSQLI_ASSOC);
 		}

 		$record_info[$i]['cnum'] = $class_info['num'];
 		$wdl = encodesign($record_info[$i]['content']);
 		$record_info[$i]['week'] = $wdl[0];
 		$record_info[$i]['day'] = exnumtoday($wdl[1]);
 		$record_info[$i]['section'] = $wdl[2];

 		//查找学生记录
 		$slid = $record_info[$i]['id'];
 		$sign_info = array();
 		$q2 = "SELECT * FROM `sign` WHERE `slid` = '$slid' AND `issign` = '0'";
 		$r2  = mysqli_query($dbc,$q2) or trigger_error("查询：$q2\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 		$length2 = mysqli_num_rows($r2);
 		$i2=0;
 		while($length2>0){
 		array_push($sign_info, mysqli_fetch_array($r2,MYSQLI_ASSOC));
 		$sid = $sign_info[$i2]['sid'];
 		 $q3 = "SELECT * FROM `students` WHERE `id` = '$sid'";
 		$r3  = mysqli_query($dbc,$q3) or trigger_error("查询：$q3\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 		if(mysqli_num_rows($r3)>0){
 			$student_info = mysqli_fetch_array($r3,MYSQLI_ASSOC);
 		}
 		$sign_info[$i2]['name'] = $student_info['name'];
 		$length2--;
 		$i2++;
 			}
 			array_push($record_info[$i], $sign_info);
 		$i++;
 		$length--;
 	}
 	return $record_info;
 }

 function change_sign_open(){
 	$sign_config= get_sign_config();
 	$sign_config['open'] = !$sign_config['open'];
 	if($sign_config['open']){
 		$sign_config['password'] = rand(0,99999);
 	}
    change_sign_config($sign_config);
 }

 function create_signlesson($dbc,$sign_config,$cid){
 			$result =array();
 			$name = $sign_config['name'];
 			$q = "SELECT course.id from course where name = '$name' AND cid = '$cid'";
 			$r = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " . 
      mysqli_error($dbc));
 			if(mysqli_num_rows($r)>0){
 				$result = mysqli_fetch_array($r,MYSQLI_ASSOC);
 			}
 			$coid  = $result['id'];
 			$sign_submit = array();
 			$test = array();
			array_push($test,$sign_config['week']);
			array_push($test,$sign_config['day']);
			array_push($test,$sign_config['section']);
			$content = decodesign($test);
			$sign_submit['content'] = $content;
			$sign_submit['date'] = date('Y-m-d');
			$sign_submit['num'] = 0;
			$sign_submit['coid'] = $coid;
			return $sign_submit;
 }

 function submit_signlesson($dbc,$sign_submit){
 	$date = $sign_submit['date'];
 	$num = $sign_submit['num'];
 	$content =$sign_submit['content'];
 	$coid = $sign_submit['coid'];   
 	$q = "INSERT INTO `db_g2`.`signlesson` (`id`, `date`, `num`, `content`, `coid`) VALUES (NULL,'$date', '$num', '$content' ,'$coid')";
 	$r = mysqli_query($dbc,$q) or trigger_error("查询:$q\n<br />MySQL Error:".mysqli_error($dbc));
 	$id = mysqli_insert_id($dbc);
 	return $id;
 }

 function update_sign($dbc,$value,$post_id){
			$q = "UPDATE `sign` SET `issign`= '1' WHERE id = '$value' AND slid = '$post_id'";
			$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " .mysqli_error($dbc));
			$q = "UPDATE `signlesson` SET `num`= `num`+1 WHERE id = '$post_id'";
			$r  = mysqli_query($dbc,$q) or trigger_error("查询：$q\n<br />MySQL Error: " .mysqli_error($dbc));
 }

