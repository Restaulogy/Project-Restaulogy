<!doctype html public "-//W3C//DTD HTML 4.01//EN">
<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
 
 <title>Restaurants</title>
	<META NAME="Description" CONTENT="<?php echo $description;?>">
	<META NAME="Keywords" CONTENT="<?php echo $keywords;?>">	
	
	<link rel="stylesheet" href="<?php echo $website;?>/css/themes/inspired/structure.css" />
 	<link rel="stylesheet" href="<?php echo $website;?>/css/themes/inspired/style.css" />	
	
 	<link rel="stylesheet" href="<?php echo $website;?>/css/jqm-extra-icon.css" />

 	<link rel="stylesheet" href="<?php echo $website;?>/user/templates/css/style.css" />
	<link rel="stylesheet" href="<?php echo $website;?>/css/biz_data_grid.css" />
	 
	</head>
  
	<body>

 	<div datar-role="page" >
		<div data-role="header" data-position='fixed'>
		<header>
		<a data-inline="true" data-role="button" data-icon="smico" data-iconpos="notext" title="Open Menu" href="#mypanel" onclick="$('#mypanel').panel('open',optionsHash);"></a>	  	
		 <div id="user_name">Welcome,<br> Guest</div>
		 <a href="<?php echo $website; ?>" id="logo"><?php echo $webtitle;?></a> 
		</header>
	</div> 
		<div data-role="content">
			<h1>Successful payment transaction</h1> 
			<div class="biz_center" style='font-weight:normal;'>
				Your transaction is successful. <a href="<?php echo $website;?>/user/tbl_orders.php">click here</a>
			</div>
		</div>
		<div data-role="footer" data-position='fixed'>  		
    		<footer><?php echo $webtitle;?> &copy; All rights Reseved</footer>
		</div> 
	</div> 
	 
	 <script type="text/javascript" src="<?php echo $website; ?>/user/templates/js/dateFormat.js"></script>
<script type="text/javascript" src="<?php echo $website; ?>/user/templates/js/simple_validator.js"></script>
<script type="text/javascript" src="<?php echo $website; ?>/user/templates/js/jquery.js"></script>  
<script type="text/javascript">
$(document).bind("mobileinit", function () {
    $.mobile.ajaxEnabled = false;
});
</script> 
<script type="text/javascript" src="<?php echo $website; ?>/user/templates/js/jquery.mobile-1.3.0.js"></script>

   </body>
</html>
