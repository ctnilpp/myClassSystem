<?php
  //重定向到指定页面 【第5课 注册 操作步骤 4 版本 1】
  function redirect_to($fn) {
    $url = BASE_URL . $fn; // 定义URL
    ob_end_clean(); // 删除缓存
    header("Location: $url");
    exit(); // 退出脚本
  }

  //重定向到cookie记录的页面 【第7课 更新、显示和删除用户 操作步骤 4 版本 1】
  function redirect_back($fn,$x=0) {
    $url = ($x==0)? BASE_ROOT : BASE_HOME;
    $url .= $fn; // 定义URL
    ob_end_clean(); // 删除缓存
    header("Location: $url");
    exit(); // 退出脚本
  }

  //获取用户头像 【第5课 注册 操作步骤 5 版本 1】
  function gravatar_for($qq,$name,$size=80,$style='') {
    if (empty($qq)) {
      $imgurl = '<img src="../assets/img/ungravatar.png" alt="' . $name;
      $imgurl .= '"  class="' . $style . '" width=' . $size . ' />';
    } else {
      $gravatar_url = 'http://q1.qlogo.cn/g?b=qq&nk='.$qq.'&s=100&t='. time();
      $imgurl = '<img src="' . $gravatar_url . '" alt="' . $name;
      $imgurl .= '"  class="' . $style . '" width=' . $size . ' />';
    }
    return $imgurl;
  }

  //获取当前时间 【第5课 注册 操作步骤 10 版本 1】
  function get_current_time() {
    date_default_timezone_set('Asia/Shanghai');
    return date('Y-m-d H:i:s', time());
  }

  //生成分页器HTML 【第9课 用户微贴 操作步骤 2.1 版本 2】
  function makepager($pages, $cpage, $qstr='') {
    $pager_html = '';

    if ($pages > 1) {
      $pager_html .= '<ul class="pagination">'; 
      if ($cpage != 1) { //若不是第一页，则需要前一页按钮
        $pager_html .= '<li><a href="?s=' . ($cpage-1) . $qstr . '">&#8592;</a></li>';
      } else {
        $pager_html .= '<li class="disabled"><a href="#">&#8592;</a></li>';
      }
      for($i = 1; $i <= $pages; $i++) {
        if ($i != $cpage) { //若不是当前页，则需要页超链
          $pager_html .= '<li><a href="?s=' . $i . $qstr . '"> ' . $i . ' </a></li>';
        } else {
          $pager_html .= '<li class="active"><a href="#">' . $i . '</a></li>';
        }
      }
      if ($cpage != $pages) { //若不是最后一页，则需要下一页按钮
        $pager_html .= '<li><a href="?s=' . ($cpage + 1) . $qstr. '">&#8594;</a></li>';
      } else {
        $pager_html .= '<li class="disabled"><a href="#">&#8594;</a></li>';
      }      
      $pager_html .= '</ul><input id="fqstr" type="hidden" value="'. $qstr .'" />'; 
    }
    return $pager_html;
  }

  //检查密码重置是否过期 【第8课 帐号激活与密码重置 操作步骤 2.6 版本 1】
  function check_expiration($ra) {
    date_default_timezone_set('Asia/Shanghai');
    $t0 = date_parse($ra);
    $t1 = mktime($t0['hour'],$t0['minute'],$t0['second'],$t0['month'],$t0['day'],$t0['year']);
    $t2 = time();
    return (($t2-$t1) <=7200) ? false : true; //两小时为限
  }

  //计算微贴的年龄 【第9课 用户微贴 操作步骤 2.3 版本 1】
  function microposttime($ra) {
    date_default_timezone_set('Asia/Shanghai');
    $t0 = date_parse($ra);
    $t1 = mktime($t0['hour'],$t0['minute'],$t0['second'],$t0['month'],$t0['day'],$t0['year']);
    $t2 = time();
    $years = floor(($t2 - $t1)/(3600*24*365));
    if ($years >= 1) return "$years 年"; 
    $mons = floor(($t2 - $t1)/(3600*24*30));
    if ($mons >= 1) return "$mons 月";
    $days = floor(($t2 - $t1)/(3600*24));
    if ($days >= 1) return "$days 天";
    $hours = floor(($t2 - $t1)/3600);
    if ($hours >= 1) return "$hours 小时";
    $mins = floor(($t2 - $t1)/60);
    if ($mins >= 1) return "$mins 分钟";
    return ($t2 - $t1) . " 秒";
  }

  //调整上传图像的大小 【第9课 用户微贴 操作步骤 5.3 版本 1】
  function imageadjust($pt,$picn) {    
    if ($pt == 'jpeg' || $pt == 'jpg') {
      $img = imagecreatefromjpeg($picn);
    } else if ($pt == 'png') {
      $img = imagecreatefrompng($picn);   
    } else {
      $img = imagecreatefromgif($picn);
    }
    $ow = imagesx($img);
    $oh = imagesy($img);
    if ($ow <= 400 && $oh <= 400) {
      imagedestroy($img);
      return;
    }
    //若宽或高超过400则压缩
    $nw = ($ow > $oh) ? 400 : intval(400*$ow/$oh);
    $nh = ($oh > $ow) ? 400 : intval(400*$oh/$ow);
    $nimg = imagecreatetruecolor($nw,$nh);
    imagecopyresampled($nimg,$img,0,0,0,0,$nw,$nh,$ow,$oh);
    if ($pt == 'jpeg' || $pt == 'jpg') {
      imagejpeg($nimg,$picn);
    } else if ($pt == 'png') {
      imagepng($nimg,$picn);    
    } else {
      imagegif($nimg,$picn);
    }
    imagedestroy($nimg);
    imagedestroy($img);
  }

  //生成json数据 【第10课 关注用户 操作步骤 7.1 版本 1】
  function create_response_json($code,$msg) { 
    $ret = array();
    $ret['rescode'] = $code;
    $ret['msg'] = $msg;
    return json_encode($ret);
  }

  //渲染模板
  function render($filename,$vp='') {
    if (is_file($filename)) {
      ob_start();
      include $filename;
      $contents = ob_get_contents();
      ob_end_clean();
      return $contents;      
    }
    return false;
  }

  //文件配置中的类型转换 先判断特殊类型，都不满足则变为整型
  function change($s){
          if($s ==='false')
          return false;
          else if($s ==='true')
          return true;
          else if ($s===true)
          return 'true';
          else if ($s===false)
          return 'false';
          else if (is_string($s))
            return $s;
          else return $s;
  }

  //拿取记录表的时候对周星期大节进行解码
  function encodesign($s){
      $array =  explode("-", $s);
      return $array;
  }

  //提交记录表的时候对周星期大节进行编码
 function decodesign($array){
      $result =  $array['0']."-".$array['1']."-".$array['2'];
      return $result;
  }


  //数字与星期转换
  function exnumtoday($a){
      switch ($a) {
        case '1':
          return "一";
          break;
          case '2':
          return "二";
          break;
          case '3':
          return "三";
          break;
          case '4':
          return "四";
          break;
          case '5':
          return "五";
          break;
          case '6':
          return "六";
          break;
          case '7':
          return "日";
          break;
          default:
          return "无";
      }
  }

   //拿取课程表的时候计算学期
 function get_semester(){
      $now_m = date("m",time());
      if($now_m>9||$now_m<2) return 1;
      else return 2;
  }
  //检查签到表的时间是否到期了
  function able_sign($end){
      if(time()>$end) return false;
      else return true;
  }

  function echo_redirect($text,$path){
      // $text = mb_convert_encoding($text, "GBK", "UTF-8");
      echo "<script>alert('$text');window.location.href=\"$path\"</script>";
  }

  function echo_date($time){
      date_default_timezone_set('PRC'); 
      return date("Y-m-d H:i:s",$time);
  }
?>