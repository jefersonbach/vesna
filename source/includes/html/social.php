<meta property="og:title" content="<?php echo $xtitle; ?>" />
<meta property="og:description" content="<?php echo $xdescription; ?>" />
<meta property="og:image" content="<?php echo $ximage; ?>" />
<? if($store['fb_pixel'] != '') { ?>
<meta property="fb:app_id" content="<?=$store['fb_pixel']?>"/>
<? } ?>