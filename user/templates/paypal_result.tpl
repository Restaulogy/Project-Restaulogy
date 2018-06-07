{include file='header.tpl'}
<div class="wrapper"> 
<h1>{$_lang.paypal[$result].header}</h1> 
<div class="biz_center">  
		<p>{$_lang.paypal[$result].desc}</p>
 		<br /> 
 		{jqmbutton onclick="window.location.href='{$website}/user/tbl_orders.php'" value="{$_lang.click_here}"}
 </div>
</div> 
{include file='footer.tpl'} 