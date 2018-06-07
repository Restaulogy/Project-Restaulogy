</div><!--/.container-->

    <div data-role="footer" data-position='fixed' class="no_border">
    {if $non_avail_table neq 1}
		<center>
		{if $isCustomer && $custTableInfo}
			<!--<a data-role='button' data-theme='b' data-icon='line-globe' href="{$website}/user/dashboard.php">{$webtitle} - Table [ {$custTableInfo.table_number} ]</a>-->
			<a data-role='button' data-theme='b' data-icon='line-globe' href="http://restaulogy.com">Check out Restaulogy </a>
		{/if}
		</center> 		
    {/if}
		<footer>
        &copy; 2016 Inforesha Technologies &nbsp;
       <!-- <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=restaulogy.com','SiteLock','width=600,height=600,left=160,top=170');" ><img height="24" class="img-responsive" alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/restaulogy.com" /></a>-->
        </footer>
	</div>
	{if $sesslife eq false && $active_page neq 'login'}
		{include file="ask_cust_nm.tpl"}
	{/if}
	{if $active_page neq 'login'}
        {include file="popupNotification.tpl"}
        {include file="popupfavOrderlist.tpl"}
    {/if}
</div>

<div data-role="panel" id="mypanel" data-position="left" data-display="push" data-content-theme="f" class="panel_bg">
    <!-- panel content goes here -->
    {include file="navbar.tpl"}
</div><!-- /panel -->
<!-- OR $active_page eq 'tbl_menu' OR $active_page eq 'tbl_submenu_dishes' -->
{if ($sesslife eq false) OR (($sesslife eq true) AND ($isCustomer eq true)) }
  {if $smarty.session[$smarty.const.SES_TABLE] gt 0 || $smarty.session[$smarty.const.SES_ONLINE_STORE] gt 0}  	
  {else}
       {if $active_page eq 'services_request' OR $active_page eq 'customer_requests' OR $active_page eq 'feedback' OR $active_page eq 'customer_rewards' OR $active_page eq 'edit_profile'}
	   	 {literal} 
            <script type="text/javascript">
	        	 setTimeout(function(){				   		
					   		alert('{/literal}{$_lang.main.qrcode.empty}{literal}');	
							window.location.href='{/literal}{$website}{literal}/user/dashboard.php';				
					   },1000);
            </script>
         {/literal}
     {/if}
  {/if}
{/if}

{if $smarty.session[$smarty.const.SES_CART]}
    {include file="cart.tpl"}
{/if}

<!--{if $order_popup eq 1}
 {literal}
    <script type="text/javascript">
	   setTimeout(function(){$( "#popupCart" ).popup("open")},1000);
	</script>
 {/literal}
{/if}-->

{if $sesslife && $Global_member.member_role_id eq $smarty.const.ROLE_WAITER && $curr_shift_waiters}

<div data-role="popup" data-dismissible="false" data-overlay-theme="g" data-theme="a1" id='popupCurrShiftServers' style="width:270px;">

<form id="frm_chng_srv" name="frm_chng_srv" method="POST" action="{$website}/user/chnage_server.php" >
<div data-role="header">
<h3><a href="#" onclick="$('#popupCurrShiftServers').popup('close');" data-icon="delete" style="display:inline;float: right;" data-role="button" data-iconpos="notext" data-inline="true"></a>Change Server
</h3>
</div>
<div data-role="content" style="text-align:center;">
	<select name='chng_serv_id' id='chng_serv_id'>
		<!-- <option value=''>Select Server</option> -->
		{foreach from=$curr_shift_waiters key=employee_id item=employee}		
			<option value='{$employee_id}' {if $smarty.session.guid eq $employee_id}disabled="disabled"{/if}>{$employee}</option>
		{/foreach} 
	</select>	
	<input type='submit' data-role="button" data-inline="true" data-icon="group" data-iconpos="left" value="Change" />
</div>
</form>
</div>

{/if} 
 
 

<script type="text/javascript" src="{$website}/user/templates/js/dateFormat.js"></script>
<script type="text/javascript" src="{$website}/user/templates/js/simple_validator.js?2"></script>
<script type="text/javascript" src="{$website}/user/templates/js/jquery.js"></script>  
<script type="text/javascript">
 $(document).bind("mobileinit", function () {
   $.mobile.ajaxEnabled = false;
   $.mobile.fixedtoolbar.prototype.options.tapToggle = false;
   $.mobile.fixedtoolbar.prototype.options.hideDuringFocus = "";
   $.mobile.pushStateEnabled = false;
   $.mobile.popup.prototype.options.history = true;
   $.mobile.touchOverflowEnabled = true; 

});
</script> 
<script type="text/javascript" src="{$website}/user/templates/js/jquery.mobile-1.3.0.js"></script>
 
<script type="text/javascript" src="{$website}/js/jquery.tablednd.0.7.min.js"></script>

<script src="{$website}/user/templates/js/mobiscroll.min.js"></script>
<link href="{$website}/user/templates/css/mobiscroll.min.css" rel="stylesheet" type="text/css" /> 


{include file="common_js.tpl"}
<script src="{$website}/user/templates/js/custom.js"></script>
<script src="{$website}/user/templates/js/jquery.imagefit-0.2.js"></script>

{include file="flash_messages.tpl"}
