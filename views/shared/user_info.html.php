<section class="user_info">  
  <h2>
  	<a href="#">
  		<?php echo gravatar_for($user['qq'],$user['name'],60,'img-rounded'); ?>  		
  	</a>
  	<?php echo $user['name'] ?>
  </h2>
  <p>
  	<a href="<?php echo $myurl; ?>" >查看我的资料</a>
  	<span> | 我的微贴数量：</span><span class="badge"><?php echo $mtotal ?></span>
  </p>
</section>