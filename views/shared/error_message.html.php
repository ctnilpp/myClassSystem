<?php if (isset($errors) && !empty($errors)) { ?>
  <div id="error_explanation">
    <!-- <div class="alert alert-info">此表单包含 
      <?php echo count($errors) ?>个错误！
    </div> -->
    <!--   <?php $i=1; foreach($errors as $v) { echo '<li class="list-group-item list-group-item-danger">' . $i . '. ' . $v . '</li>'; $i++; } ?> -->
    <?php $i=1;$content=''; foreach($errors as $v) { $content .=$v."<br>";$i++;
     } ?>
       <script type="text/javascript">
    	bui.ready(function(){
    		bui.hint({ appendTo:"#main", <?php echo "content:\"$content\""; ?>, position:"top" , close:true, autoClose: false});
    	})
    </script>
    <ul class="list-group">
    	
    </ul>
  </div>
<?php } ?>