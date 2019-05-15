<?php include('../views/layouts/application.html.php'); ?>
<div id="page" class="bui-page register-page">
    <header class="bui-bar">
        <div class="bui-bar">
            <div class="bui-bar-left">
                <a class="bui-btn" <?php echo "href=\"".LOGIN_PATH."\""; ?> ><i class="icon-back"></i></a>
            </div>
            <div class="bui-bar-main">学生考勤签到界面</div>
            <div class="bui-bar-right">
            </div>
        </div>
    </header>
    <main id="main">
        <?php include('../views/shared/error_message.html.php'); ?>
        <div class="bui-box" style="margin: 30px 0 20px 0;">
            <div class="span12"><h1 style="text-align: center;"><?php echo $user_info['name']; ?></h1>
            </div>
        </div>
        <div class="bui-box" style="margin-bottom: 10px;">
            <div class="span12"><h3 style="text-align: center;">注：考勤系统已 <span style="color: <?php echo $color ?>"><?php echo $open; ?><span></h3>
            </div>
        </div>
        <form id="people-form" class="form-inline" method="post" action="<?php echo  $stu_path; ?>">
            <ul class="bui-list">
                <li class="bui-btn bui-box clearactive">
                    <label class="bui-label" for="password">密码</label>
                    <div class="span1">
                        <div class="bui-input">
                            <input id="password" type="number" name="password" placeholder="请输入密码">
                        </div>
                    </div>
                </li>
            </ul>
            <div class="container-xy">
                <button type="submit" class="bui-btn round primary" id="ok_btn">签到</button>
            </div>
        </form>
    </main>
</div>
<?php include ('../views/layouts/footer.html.php'); ?>