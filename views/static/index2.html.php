<?php include('../views/layouts/application.html.php'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <div>
                <a href="main.html" target="iframe" class="list" id="List1">
                    <span><i class="glyphicon glyphicon-home"></i> 首页</span>
                </a>
            </div>
            <div>
                <a href="javascript:;" class="list" id="List2">
                    <span><i class="glyphicon glyphicon-user"></i> 学生管理 <i class="glyphicon glyphicon-chevron-right pull-right" id="glyphicon2"></i></span>
                </a>
                <ul class="listgroup" id="ListGroup2" style="display: none;">
                    <li><a href="listHome.html" target="iframe">商品列表</a></li>
                    <li><a href="listHome1.html" target="iframe">供应商订单表</a></li>
                    <li><a href="listArticle.html" target="iframe">入库表</a></li>
		            <li><a href="listArticle1.html" target="iframe">出库表</a></li>
		            <li><a href="listArticle2.html" target="iframe">供应商表</a></li>
                </ul>
            </div>
            <div>
                <a href="javascript:;" class="list" id="List3">
                    <span><i class="glyphicon glyphicon-book"></i> 课程管理 <i class="glyphicon glyphicon-chevron-right pull-right" id="glyphicon3"></i></span>
                </a>
                <ul class="listgroup" id="ListGroup3" style="display: none;">
                    <li><a href="listFile.html" target="iframe">客户订单表</a></li>
                    <li><a href="listData.html" target="iframe">退货表</a></li>
		    <li><a href="listFile1.html" target="iframe">客户信息表</a></li>
                </ul>
            </div>
            <div>
                <a href="javascript:;" class="list" id="List4">
                    <span><i class="glyphicon glyphicon-list-alt"></i> 成绩管理 <i class="glyphicon glyphicon-chevron-right pull-right" id="glyphicon4"></i></span>
                </a>
                <ul class="listgroup" id="ListGroup4" style="display: none;">
                    <li><a href="listComment.html" target="iframe">用户表</a></li>
                    <li><a href="listDiscuss.html" target="iframe">权限表</a></li>
                </ul>
            </div>
            <div>
                <a href="javascript:;" class="list" id="List5">
                    <span><i class="glyphicon glyphicon-calendar"></i> 考勤管理 <i class="glyphicon glyphicon-chevron-right pull-right" id="glyphicon4"></i></span>
                </a>
                <ul class="listgroup" id="ListGroup4" style="display: none;">
                    <li><a href="listComment.html" target="iframe">用户表</a></li>
                    <li><a href="listDiscuss.html" target="iframe">权限表</a></li>
                </ul>
            </div>
            <div>
                <a href="javascript:;" class="list" id="List6">
                    <span><i class="glyphicon glyphicon-signal"></i> 投票管理 <i class="glyphicon glyphicon-chevron-right pull-right" id="glyphicon4"></i></span>
                </a>
                <ul class="listgroup" id="ListGroup4" style="display: none;">
                    <li><a href="listComment.html" target="iframe">用户表</a></li>
                    <li><a href="listDiscuss.html" target="iframe">权限表</a></li>
                </ul>
            </div>
            <div>
                <a href="javascript:;" class="list" id="List7">
                    <span><i class="glyphicon glyphicon-flag"></i> 活动管理 <i class="glyphicon glyphicon-chevron-right pull-right" id="glyphicon4"></i></span>
                </a>
                <ul class="listgroup" id="ListGroup4" style="display: none;">
                    <li><a href="listComment.html" target="iframe">用户表</a></li>
                    <li><a href="listDiscuss.html" target="iframe">权限表</a></li>
                </ul>
            </div>
            <div>
                <a href="javascript:;" class="list" id="List8">
                    <span><i class="glyphicon glyphicon glyphicon-cog"></i> 系统管理 <i class="glyphicon glyphicon-chevron-right pull-right" id="glyphicon5"></i></span>
                </a>
                <ul class="listgroup" id="ListGroup5" style="display: none;">
                    <li><a href="listAdmin.html" target="iframe">数据库备份</a></li>
                    <li><a href="listUser.html" target="iframe">日志查询</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 main">

                <div title="首页"><iframe frameborder="0" name="iframe" src="main.html" style="width:100%;"></iframe></div>

            <!-- <iframe src="main.php"  frameborder="0" name="mainFrame" width="100%"></iframe> -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        slide("#List2","#ListGroup2","#glyphicon2");
        slide("#List3","#ListGroup3","#glyphicon3");
        slide("#List4","#ListGroup4","#glyphicon4");
        slide("#List5","#ListGroup5","#glyphicon5");
        // slide("#List6","#ListGroup6","#glyphicon6");
        // slide("#List7","#ListGroup7","#glyphicon7");
    });
    function slide(fid,sid,gid){
        $(fid).click(function(){
            $(sid).slideToggle("fast");
            if($(gid).hasClass("glyphicon-chevron-right")){
                $(gid).removeClass("glyphicon-chevron-right");
                $(gid).addClass("glyphicon-chevron-down");
            }
            else{
                $(gid).removeClass("glyphicon-chevron-down");
                $(gid).addClass("glyphicon-chevron-right");
            }
        });
    }
</script>
<script type="text/javascript">
    $(window).on("load resize",function(){
        var h=window.innerHeight||document.body.clientHeight||document.documentElement.clientHeight;
        $(".sidebar").css("height",h);
        $("iframe").css("height",h-70);
    });
    var h=window.innerHeight||document.body.clientHeight||document.documentElement.clientHeight;
    var h1 = h-105;
    function addTab(title, url){
        if ($('#tt').tabs('exists', title)){
            $('#tt').tabs('select', title);
        } else {
            var content = '<iframe frameborder="0"  src="'+url+'" style="width:100%;height:'+h1+'px"></iframe>';
            $('#tt').tabs('add',{
                title:title,
                content:content,
                closable:true
            });
        }
    }
</script>
<?php include ('../views/layouts/footer.html.php'); ?>