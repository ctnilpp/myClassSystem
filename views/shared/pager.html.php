<?php if ($pages > 1) { ?>
<div class="row">
	<nav class="navbar">
		<?php echo $pager_html; ?>
		<form class="navbar-form navbar-left" style="margin-top:20px">
    	<div class="input-group">
      	<span class="input-group-btn">
      		<a id="pageOK" class="btn btn-default" href="#">GO</a>
      	</span>
      	<input class="form-control" type="number" id="pnum" min="1" 
      		max="<?php echo $pages; ?>" value="<?php if (isset($_GET['s'])) 
      		{ echo $_GET['s']; } else { echo "1"; } ?>" />
      	<span id="total" class="input-group-addon">共<?php echo $pages; ?>页</span>
    	</div>
    </form>      
  </nav>
</div>
<script src="../assets/js/slide-pager.js"></script>
<?php } ?>