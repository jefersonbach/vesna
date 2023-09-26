
<?php if($store['google_analytics'] != '') { ?>
<!-- Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $store['google_analytics']; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $store['google_analytics']; ?>');
</script>
<?php }?>