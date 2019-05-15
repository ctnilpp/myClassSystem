<?php include('../views/layouts/application.html.php'); ?>
<div class="bui-page">
    <!--固定在顶部结构 header-->
    <header class="bui-bar">
        <div class="bui-bar-left">
            <a class="bui-btn" <?php echo "href=\"".LOGIN_PATH."\""; ?> ><i class="icon-back"></i></a>
        </div>
        <div class="bui-bar-main">
            班干考勤界面
        </div>
        <div class="bui-bar-right">
            <a class="bui-btn">
                <i class="icon-search"></i>
            </a>
        </div>
    </header>
    <main>
        <div id="uiSlideTab" class="bui-tab">
            <div class="bui-tab-main">
                <ul>
                    <li>
                        <div id="uiScroll" class="bui-scroll">
                            <div class="bui-scroll-head"></div>
                            <div class="bui-scroll-main">
                                <ul id="listview" class="bui-listview">
                                </ul>
                            </div>
                            <div class="bui-scroll-foot"></div>
                        </div>
                    </li>
                    <!-- <li>
                        
                    </li>
                    <li>
                        <div id="uiSlideTabChild" class="bui-tab">
                            <div class="bui-tab-head">
                                <ul class="bui-nav">
                                    <li class="bui-btn active">最新</li>
                                    <li class="bui-btn">最热</li>
                                </ul>
                            </div>
                            <div class="bui-tab-main">
                                <ul>
                                    <li>
                                        最新内容
                                    </li>
                                    <li>
                                        最热内容
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li> -->
                    <li>
                        <div class="section-title">请填写考勤信息的课程设置</div>
                        <form id="config-form" class="form-inline">
                            <ul class="bui-list">
                                <li class="bui-btn bui-box clearactive">
                                    <label class="bui-label" for="provinceSelect">课程选择</label>
                                    <div class="span1">
                                        <div id="provinceSelect" class="bui-btn bui-box">
                                            <div id="college" class="span1"><?php echo $sign_config['name']; ?></div>
                                            <i class="icon-listright"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="bui-btn bui-box clearactive">
                                    <label class="bui-label" for="week">教学周次</label>
                                    <div class="span1">
                                        <div id="week" class="bui-number"></div>
                                    </div>
                                </li>
                                <li class="bui-btn bui-box clearactive">
                                    <label class="bui-label" for="day">上课星期</label>
                                    <div class="span1">
                                        <div id="day" class="bui-number"></div>
                                    </div>
                                </li>
                                <li class="bui-btn bui-box clearactive">
                                    <label class="bui-label" for="section">上课节次</label>
                                    <div class="span1">
                                        <div id="section" class="bui-number"></div>
                                    </div>
                                </li>
                                <div class="section-title">请填写考勤系统的配置</div>
                                <li class="bui-btn bui-box clearactive">
                                    <label class="bui-label" for="week">有效时间（min）</label>
                                    <div class="span1">
                                        <div id="time" class="bui-number"></div>
                                    </div>
                                </li>
                            </ul>
                               <div class="section-title" >考勤系统五位密码:<span style="color: red;font-weight: bold;"> <?php if($sign_config['open']) echo $sign_config['password'];?> </span></div>
                            <div class="container-xy" <?php if($sign_config['open']) echo "style=\"display:none;\""; ?>>
                                <button  type="submit" class="bui-btn round primary" id="ok_btn">保存</button>
                            </div>
                        </form>
                        
                        <div class="section-title">请设置考勤系统的开放权限</div>
                        <p> <?php if($sign_config['open']) echo  "考勤结束时间为 ";
                        echo "<span style=\"color: blue;font-weight: bold;\">";
                         echo echo_date($sign_config['end']);
                         echo "</span>";
                          echo" 请记得按时关闭"; ?>    </p>
                        <form method="post" action="<?php echo $admin_path; ?>">
                            <input type="hidden" name="open" value="change">
                            <button type="submit" class="bui-btn <?php echo $color;?>"><?php echo $open;?></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <footer>
        <ul id="uiSlideTabNav" class="bui-nav">
            <li class="bui-btn bui-box-vertical active"><i class="icon-home"><span class="bui-badges">2</span></i>
                <div class="span1">首页</div>
            </li>
<!--             <li class="bui-btn bui-box-vertical"><i class="icon-share"></i>
                <div class="span1">记录</div>
            </li>
            <li class="bui-btn bui-box-vertical"><i class="icon-pic"><span class="bui-badges"></span></i>
                <div class="span1">图片</div>
            </li> -->
            <li class="bui-btn bui-box-vertical"><i class="icon-setting"><span class="bui-badges"></i>
                <div class="span1">设置</div>
            </li>
        </ul>
    </footer>
</div>
<script>
bui.ready(function() {

    // 底部菜单TAB
    var uiSlideTab = bui.slide({
        id: "#uiSlideTab",
        menu: "#uiSlideTabNav",
        children: ".bui-tab-main > ul",
        scroll: true
    })

    // 第1屏的TAB
    var uiSlideTabChild = bui.slide({
        id: "#uiSlideTabChild",
        menu: ".bui-nav",
        children: ".bui-tab-main > ul",
        scroll: true
    })
})
//tab
// var tab = bui.slide({
//     id:"#tabNews",
//     menu:"#tabNav",
//     children:".bui-tab-main > ul",
//     scroll: true
// })         
//请选择课程
var pageview = {};
bui.ready(function() {
    levelSelect();

    function levelSelect() {
        var uiMask = bui.mask();
        var provinceSelect = bui.select({
            trigger: "#provinceSelect",
            title: "请选择课程",
            type: "radio",
            height: 300,
            autoClose: true,
            data: []
        });
        var data = {
            "data": [
            <?php 
            foreach ($co_info as $key => $value) :
                 $name = $value['name'];
                 echo " { \"name\": \"$name\" },"; 
            endforeach;
          
               echo "],
            \"info\": \"获取成功\",
            \"status\": 0";
            ?>
           
        }
        provinceSelect.option("data", data.data);
    }

    var template = {
        // ,{
        //     "id": 2,
        //     "name": "10月11日上午数据库",
        //     "describe": "应到几人，实到几人"
        // }
        "list": [
        //       {
        //     "id": 1,
        //     "name": "10月11日上午数据库",
        //     "describe": "应到几人，实到几人"
        // },
        <?php
        foreach ($sl_info as $key => $value):
            $date = json_encode($value['date']);
            // $describe = json_encode('应到'.$unpresent.'人,实到'.$value['num'].'人');
             echo  "{
            id: 1,
            name:  $date,
            describe:' ',
        },";

        //   echo  '{
        //     "id": 1,
        //     "name": "10月11日上午数据库",
        //     "describe": "应到几人，实到几人"
        // },';
        endforeach;
        ?>
         // {
        //     "id": 1,
        //     "name": "10月11日上午数据库",
        //     "describe": "应到几人，实到几人"
        // }
        ]
    };
    console.log(JSON.stringify(template));
    var uiList = bui.list({
        id: "#uiScroll",
        // 测试的接口及传参
        url: "https://data.jianshukeji.com/mock",
        data: {
            template: JSON.stringify(template)
        },
        children:".bui-listview",
        handle:"li",
        pageSize: 9,
        height: 0,
        template: templateList,
        method: "POST",
        //如果分页的字段名不一样,通过field重新定义
        field: {
            page: "page",
            size: "pageSize",
            data: "list"
        },
        onRefresh: function(scroll) {
            //刷新的时候执行
        },
        onLoad: function(scroll) {
            // console.log( this.option("page") );
        }
    })
    ;
    //生成列表的模板
    function templateList(data) {
        var html = "";
        $.each(data, function(index, el) {
            console.log(index);
            html += '<li status="0" style="height:46px;">';
            html += '    <a href="record.php?date='+el.name+'">';
            html += '<div class="bui-btn bui-box" >';
            html += '        <div class="span1">';
            html += '           <h3 class="item-title">' + el.name + '</h3>';
            html += '           <p class="item-text">' + el.describe + '</p>';
            html += '        </div>';
            html += '        <i class="icon-listright"></i>';
            html += '    </div>';
            html += '    </a>';
            html += '</li>';
        });
        return html;
    };
})
</script>
<script>
//周次
var uiNumber = bui.number({
    id: '#week',
    value: <?php echo $sign_config['week']; ?>,
    min: 1,
    max: 18
})
//星期几
var uiNumber1 = bui.number({
    id: '#day',
    value: <?php echo $sign_config['day']; ?>,
    min: 1,
    max: 7
})
// 第几节 
var uiNumber2 = bui.number({
    id: '#section',
    value: <?php echo $sign_config['section']; ?>,
    min: 1,
    max: 5
})
// 有效时间
var uiNumber3 = bui.number({
    id: '#time',
    value: <?php echo $sign_config['time']; ?>,
    min: 1,
    max: 10
})

$('#config-form').submit(function (e) {
    var week = $('#week').find('input[type=text]').val();
    var day = $('#day').find('input[type=text]').val();
    var section = $('#section').find('input[type=text]').val();
    var time = $('#time').find('input[type=text]').val();
    var college = $('#college').text();
    var id =0;
    var end =1516234088;
    var password = <?php echo $sign_config['password']; ?>;
    var open = <?php if($sign_config['open']) echo "true";
    else echo "false"; ?>;
    var people = {
            open:open,
            name :college,
            week :week,
            day:day,
            section:section,
            time:time,
            password:password,
            id:id,
            end:end
        };
        console.log(JSON.stringify(people));
         // return false;
    $.ajax({
                type: 'post',
                // dataType: 'json',
                // contentType: 'application/json;charset=utf-8',
                url: './admin.php',
                data: {data: JSON.stringify(people)},
                // async:false,
                success: function (r){
                    // vm.peoples.push(r);
                    bui.alert('保存成功！');
                    console.log(r);
                    // setTimeout("location.reload()",1000);
                },
                error: function (jqXHR, textStatus){
                    // Not 200:
                    console.log('Error: ' + jqXHR.status);
                  }
}); 
    return false;
    });
 

</script>
<?php include ('../views/layouts/footer.html.php'); ?>