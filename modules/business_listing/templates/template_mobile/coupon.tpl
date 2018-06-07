{*****************************************

        Search Results Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='search'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
 <div data-role="page" >
    {include file="$deftpl/common_header.tpl"}
{if $cust_login_redirect eq 1}
	<div data-role="content">
{include file="$deftpl/breadcrumb.tpl"}
<h1>{$_lang.lbl_coupon}</h1>
	 	{if $msg}
			{$msg}
			<br/>
		{/if}  
		 <center><input type="button" onclick="window.location.href='{$elgg_site_url}promotionslisting.php?show_type=PR';" value="Promotions" data-inline="true"/></center>  
	</div>
{elseif $choose_order eq 1}
	<h1>Choose Order For {$_lang.lbl_coupon}</h1>
	<div data-role="content">
	{if $all_orders} 
		<form name="frmOrderCoupon" id="frmOrderCoupon" action="{$elgg_site_url}coupon.php" onsubmit="return validateOrderCoupon()">
		<table style="width:100%;"> 
		{foreach $all_orders as $order}
			<tr>
		   	<td><label for="order_{$order}"><input type="radio" value="{$order}" id="order_{$order}" name="order_id">ID-{$order}</label></td>
		   </tr>
		{/foreach}
		</table>
		<input type="hidden" name="cust_sess_id" value="{$smarty.request.cust_sess_id}"/>
		<input type="hidden" name="user_id" value="{if $smarty.request.user_id}{$smarty.request.user_id}{else}{$elgg_current_user}{/if}"/>
		<input type="hidden" name="promotion_id" value="{$smarty.request.promotion_id}"/>
		<input type="hidden" name="cust_login_redirect" value="1"/>
		<input type="hidden"  name="save" value="1"/> 
		<center><input type="submit" data-icon="save" value="Claim Coupon" data-inline="true"/></center>
	 
		</form>
	{else}
		 <div class="error">You have not Created Any Order.Please Create Order to claim coupon.</div>
		 <center><input type="button" onclick="window.location.href='{$website}/user/tbl_menu.php'" value="Place Order" data-inline="true"/> </center>
	{/if}	
		
	</div>
{/if}
	
	{include file="$deftpl/common_footer.tpl"}
 
</div>
{literal}
<script type="text/javascript">
	function validateOrderCoupon(){
		var sVal = $('input[name=order_id]:checked', '#frmOrderCoupon').val();
		if(sVal && IsNonEmpty(sVal)){ 
			return true;
		}else{ 
			alert("Please Select Order.");
			return false;
		}
	}
</script>
{/literal}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
