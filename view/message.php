<?php
  $sysMsg = Session::getObj(Session::SYSMSG);
?>

<div class="boxmessage" >
  <div class="boxlogin shadow" >
    <div style="padding-top: 50px;">
      <img src="<?php echo $sysMsg->getIconUrl();?>" class="img_48_48" />  
      <?php echo $sysMsg->getMessage();?>
    </div>
    <div style="padding:80px; opacity:{SNIPPET::opacity}">
        <a href="./home" class="button">home</a>
    </div>
  </div>
</div>