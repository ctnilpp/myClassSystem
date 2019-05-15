<?php
  
  define('STU_PATH','./stu.php');
  define('ADMIN_PATH','./admin.php');
  define('HELP_PATH','./help.php');
  define('ABOUT_PATH','./about.php');
  define('CONTACT_PATH','./contact.php');
  define('SIGNUP_PATH','./signup.php');
  define('USERSHOW_PATH','./users-show.php?id=');
  define('LOGIN_PATH','./login.php');
  define('LOGOUT_PATH','./logout.php');
  define('USERINDEX_PATH','./users-index.php');
  define('USERUPDATE_PATH','./users-update.php?id=');
  define('USERDELETE_PATH','./users-delete.php?id=');
  define('ACCOUNTACTIVATION_PATH','./account-activation.php');
  define('PASSWORDRESET1_PATH','./password-reset1.php');
  define('PASSWORDRESET2_PATH','./password-reset2.php');
  define('MICROPOSTCREATE_PATH','micropost-create.php');
  define('MICROPOSTDELETE_PATH','micropost-delete.php?id=');
  define('VIEWFOLLOW_PATH','./view-follow.php?id=');
  define('MICROPOSTSEARCH_PATH','./micropost-search.php');
  define('MAXRANK',10);

  define('LIVE', FALSE); // 网站状态的标志变量
  define('EMAIL', 'mblogadmin@126.com'); // 管理员联系地址
  define ('BASE_URL', 'http://127.0.0.1/group-2/php/');
  define ('BASE_ROOT', 'http://127.0.0.1/group-2/');
  define ('BASE_HOME', 'http://127.0.0.1');
  // define ('BASE_URL', 'http://localhost/php/');
  // define ('BASE_ROOT', 'http://localhost/');
  // define ('BASE_HOME', 'http://localhost');
  define ('MYSQL', '../../mysqli_connect.php');
    
  // 创建错误处理函数：
  function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
    $message = "一个错误出现在脚本 '$e_file' 的 $e_line 行：$e_message\n";
    $message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
    if (!LIVE) { // 开发状态（输出错误）
      echo '<div class="error">' . nl2br($message); //显示错误消息
      echo '<pre>' . print_r ($e_vars, 1) . "\n"; //添加变量和跟踪栈
      // debug_print_backtrace();
      echo '</pre></div>';
    } else { // 不显示错误
      $body = $message . "\n" . print_r ($e_vars, 1);
      send_mail(EMAIL, '网站错误报告', $body);
      if ($e_number != E_NOTICE) { //仅输出错误消息
        echo '<div class="error">抱歉发生了系统错误。</div><br />';
      }
    }
    return true;
  }
  set_error_handler ('my_error_handler'); // 设置错误处理函数
  session_start();  //开启会话
?>