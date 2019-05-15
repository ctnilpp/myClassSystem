<?php include('../views/layouts/application.html.php'); ?>
<div class="bui-page">
    <!--固定在顶部结构 header-->
    <header class="bui-bar">
        <div class="bui-bar-left">
            <a class="bui-btn" onclick="bui.back();"><i class="icon-back"></i></a>
        </div>
        <div class="bui-bar-main">
            班干考勤界面
        </div>
        <div class="bui-bar-right">
        </div>
    </header>
    <main>
        <div class="section-title">考勤记录</div>
        <?php
        foreach ($record_info as $key => $value) :
            $id = $value['id'];
          $info ="第".$value['week']."周 "."星期".$value['day']." 第".$value['section']."节 ";
          $unpresent = $value['cnum']-$value['num'];
          
         echo ' 
        <div id="panel" class="bui-panel">
            <div class="bui-panel-head">'.$info.$value['name'].'</div>
            <div class="bui-panel-main" style="padding: 10px;">
                <h2>应签到人数:'.$value['cnum'].'人</h2>
                <h2>未签到人数:'.$unpresent.'人</h2>
                <div ';if($unpresent<=0)echo'hidden'; echo ' class="section-title">请选择未签到的考勤人员</div>
                <form id="selectform'.$id.'">
                    <div id="selectList'.$id.'" class="bui-list">';
                    foreach ($value[0] as $key => $value2) :
                        $name = $value2['name'];
                        $vid = $value2['id'];
                        echo "
                        <div class='bui-btn bui-box'>
                            <div class='span1'>$name</div>
                            <div class='bui-value'>
                                <input type='checkbox' class='bui-checkbox' text='$name'  value='$vid'>
                            </div>
                        </div>";
                    endforeach;
                    echo "
                    <div ";if($unpresent<=0)echo'hidden'; echo ">
                    <button type='submit' class='bui-btn success'>签到</button>
                    </div>
                </form>
            </div>
        </div>
        ";
        endforeach;
        ?>
    </main>
</div>
<script>
bui.ready(function() {
    var uiAccordion = bui.accordion({
        id: "#panel",
        handle: ".bui-panel-head",
        target: ".bui-panel-main"
    });
    // 兴趣多选列表, 初始化可以通过点击整行选中列表
    <?php 
    foreach ($record_info as $key => $value) :
        $id = $value['id'];
    echo "
        var selectList".$id." = bui.select({
        id: '#selectList".$id."',
        type: 'checkbox',
        popup: false
    });";
    endforeach;
    
    ?>
    
})

<?php 
foreach ($record_info as $key => $value) :
        echo "$('#selectform".$value['id']."').submit(function (e) {
  
    var person = $('#selectList".$value['id']."').attr('value');
    var id = ".$value['id']."
    var people = {
            slid : id,
            signid:person
        };
        console.log(JSON.stringify(people));
    $.ajax({
                type: 'post',
                url: './record.php',
                data: {data: JSON.stringify(people)},
                success: function (r){
                    bui.hint('签到成功！');
                    setTimeout('location.reload()',800);

                },
                error: function (jqXHR, textStatus){
                    // Not 200:
                    console.log('Error: ' + jqXHR.status);
                  }
}); 
    return false;
    });";
endforeach;
?>
</script>
<?php include ('../views/layouts/footer.html.php'); ?>