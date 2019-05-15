<?php include('../views/layouts/application.html.php'); ?>
<div id="page" class="bui-page register-page">
    <header class="bui-bar">
        <div class="bui-bar">
            <div class="bui-bar-left">
            </div>
            <div class="bui-bar-main">考勤系统</div>
            <div class="bui-bar-right">
            </div>
        </div>
    </header>
    <main id="main">
        <?php include('../views/shared/error_message.html.php'); ?>
        <div class="section-title">登录信息</div>
        <form id="people-form" class="form-inline" method="post" action="./login.php">
            <ul class="bui-list">
                <li class="bui-btn bui-box clearactive">
                    <label class="bui-label" for="id">学号</label>
                    <div class="span1">
                        <div class="bui-input">
                            <input id="id" type="number" name="id" placeholder="请输入你的学号">
                        </div>
                    </div>
                </li>
                <li class="bui-btn bui-box clearactive">
                    <label class="bui-label" for="password">密码</label>
                    <div class="span1">
                        <div class="bui-input">
                            <input id="password" type="password" name="password">
                        </div>
                    </div>
                </li>
            </ul>
            <div class="container-xy">
                <button type="submit" class="bui-btn round primary" id="ok_btn">登录</button>
            </div>
        </form>
    </main>
</div>
<?php include ('../views/layouts/footer.html.php'); ?>