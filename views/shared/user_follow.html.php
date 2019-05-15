<div class="col-md-8">
  <div class="page-header"><h2><?php echo $page_title; ?>的用户</h2></div>
  <?php
    if ($ftotal > 0) {
      echo '<ul class="list-group">';
      foreach($rows as $row) {
        echo '<li class="list-group-item">' . gravatar_for($row['qq'],$row['name'],32);
        echo '<a href="' . USERSHOW_PATH . $row['id'] . '">' . $row['name'] . '</a>';
        echo '</li>';
      }
      echo '</ul>';
	  include ('../views/shared/pager.html.php');
    }
  ?>
</div>
