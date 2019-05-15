<section class="stats" style="margin-top: 10px">
  <p>
    <a href="<?php echo VIEWFOLLOW_PATH . $user['id'] ?>&f=following" title="我关注">
      <span class="glyphicon glyphicon-retweet"></span>&nbsp;
    </a>
    <span id="following" class="badge"><?php echo $follwing ?></span>
    <span>&nbsp;&nbsp;&nbsp;</span>
    <a href="<?php echo VIEWFOLLOW_PATH . $user['id'] ?>&f=followers" title="关注我">
      <span class="glyphicon glyphicon-heart"></span>&nbsp;      
    </a>
    <span id="followers" class="badge"><?php echo $follwers ?></span>
  </p>
</section>