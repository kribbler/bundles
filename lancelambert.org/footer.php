</td>
  </tr>
<? if ($numrows>$maxperpage && $normal) {
$pages=ceil($numrows/$maxperpage);
?>
  <tr><td align="right"><div id="pageNav">Page&nbsp;&nbsp;&nbsp;<?
  for ($i=1;$i<=$pages;$i++) {
  ?><a href="products.php??Category_Id=<? echo $category_id?>&pagenum=<? echo $i ?>"><? echo $i ?></a>&nbsp;&nbsp;&nbsp;<?
  }
  ?>
</div></td></tr>
<? } ?>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td><img src="media/spacer.gif" width="800" height="15" class="img-block" /></td></tr>
	<tr><td><span class="copyright">&copy; 2007 - <?=date(Y)?> Lance Lambert Ministries Inc. All rights reserved. <a href="terms.php" style="color:#333333;">Terms of Use</a></span></td></tr>
</table>

<script type="text/javascript" src="jquery.fancybox/custom.js"></script>
<script type="text/javascript" src="jquery.fancybox/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="jquery.fancybox/jquery.fancybox-1.2.1.pack.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
  // Reset Font Size
  var originalFontSize = $('#main').css('font-size');
  $(".resetFont").click(function(){
  $('#main').css('font-size', originalFontSize);
  });
  // Increase Font Size
  $(".increaseFont").click(function(){
  	var currentFontSize = $('#main').css('font-size');
 	var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*1.2;
	$('#main').css('font-size', newFontSize);
	return false;
  });
  // Decrease Font Size
  $(".decreaseFont").click(function(){
  	var currentFontSize = $('#main').css('font-size');
 	var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*0.8;
	$('#main').css('font-size', newFontSize);
	return false;
  });
});
</script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-48849022-1', 'lancelambert.org');
ga('send', 'pageview');

</script>

</body>
</html>
