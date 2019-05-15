<div class="container">
<?php 
  if (!empty($_SESSION['msg'])) {
	echo '<div class="alert alert-info">' . $_SESSION['msg'] . '</div>';
    $_SESSION['msg'] = '';
  }
?>
</div>