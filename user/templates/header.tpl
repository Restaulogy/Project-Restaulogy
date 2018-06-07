  {include file="script.tpl"}

 	<div datar-role="page" style="background:#fff;">
	     
	<div data-role="header" data-position='fixed'>
		<header>    
{if $smarty.request.web_redt and $smarty.request.web_redt eq 1}
    {* $webtitle|wordwrap:150:'<br/>' *}
{else}
		{if $smarty.session[$smarty.const.SES_TABLE] gt 0 || $sesslife }
			<a data-theme="d2" data-inline="true" data-role="button" data-icon="smico" data-iconpos="notext" title="Open Menu" href="#mypanel" onclick="$('#mypanel').panel('open',optionsHash);"></a>
		{/if}	
		
		{if $smarty.session.rest_menu_opt_det.rst_mnu_add_order eq 1}		
		   {if $active_page eq 'tbl_submenu_dishes' ||  $active_page eq 'tbl_orders' || $active_page eq 'tbl_menu'} 
				
			 	{if ($smarty.session[$smarty.const.SES_ONLINE_STORE] eq 1) && ($smarty.session[$smarty.const.SES_CUST_NM]) && ($smarty.session[$smarty.const.SES_OTP])}					
				    <a href="{$website}/user/tbl_orders.php?ord_online=1" style="float:right;" data-inline="true" data-position-to="window" data-role="button" data-theme="b" data-icon="grid">&nbsp</a>
			 	{/if}
			 	{if $smarty.session[$smarty.const.SES_CART]}
					<a href="#popupCart" class="ui-btn-active" style="float:right;" data-mini="true" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" data-icon="grid" data-theme="b">Cart ({$smarty.session[$smarty.const.SES_CART]|@count}) </a>
			 	{/if}			 	
			{/if}
		{/if}
			 		
 		{if $sesslife}
				<a href="{$website}/user/logout" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="shut-down" data-iconpos="notext">{$_lang.sign_out}</a>
			  {***if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER***}
             {if $Global_member.member_id gt 0}
                {if ($Global_member.member_role_id eq $smarty.const.ROLE_OWNER || $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN)==FALSE}
                        <a href="{$website}/user/tbl_alerts.php" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="notification" id="lnkalerts" title="{$_lang.tbl_alerts.title}"><b style="font-family:'Arial Narrow';">&nbsp;</b></a>
                 {/if}
			  {/if}			

    	  {else}

		   {/if}
           {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER OR $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_DEV}		
         		<a href="{$website}/user/user_loyalty" data-inline="true" data-mini="true" data-role="button" data-transition="pop" data-icon="user" data-theme="b" style="float:right;" data-iconpos="notext"></a>
           {/if}		
		 <div id="user_name">
    		{if $sesslife}    			
                Welcome,<br>
                {if $Global_member && $Global_member.full_name neq ""}
                    {$Global_member.full_name|truncate:30}
                {else}
                    Guest
                {/if}
            {else}
               &nbsp;
            {/if}
		</div>
		
		{if $sesslife}
			 {if $Global_member.member_role_id eq $smarty.const.ROLE_CUSTOMER}
			 	<a href="{$website}/user/dashboard.php" id="logo">{if $smarty.session.curr_restant.restaurent_img_url ne ''} &nbsp;{/if}{$webtitle|wordwrap:150:'<br/>'}</a>
			 {else}
			 	<a href="{$website}" id="logo">{if $smarty.session.curr_restant.restaurent_img_url ne ''} &nbsp;{/if}{$webtitle|wordwrap:150:'<br/>'}</a>
			 {/if}
		{else}
			{if $smarty.session[$smarty.const.SES_TABLE] gt 0}
				<a href="{$website}/user/dashboard.php" id="logo">{if $smarty.session.curr_restant.restaurent_img_url ne ''} &nbsp;{/if}{$webtitle|wordwrap:150:'<br/>'}</a>
			{elseif $smarty.session[$smarty.const.SES_ONLINE_STORE] gt 0}
				<a href="{$website}/user/tbl_menu.php">{if $smarty.session.curr_restant.restaurent_img_url ne ''} &nbsp;{/if}{$webtitle|wordwrap:150:'<br/>'}</a>
			{else}
				<!-- <a href="{$website}" id="logo">{$webtitle|wordwrap:150:'<br/>'}</a> -->
			{/if} 
		{/if}
{/if}



	</header>
	</div>

    <div data-role="content" id="container" class="page-home">
    {if $qr_sess_expired AND $qr_sess_expired eq 1}{else}
        {include file="breadcrumb.tpl"}
    {/if}

 	
 {if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1 && $active_page eq 'tbl_submenu_dishes'}
    	{if $sequence_num neq ""}
    	<!--href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$tbl_submenu_dishesinfo.sbmnu_dish_id}&{$smarty.const.POPUP_WINDOW}=NewOrder"-->
    		<a href="#" onclick="{literal}postForm({{/literal}{$smarty.const.POPUP_WINDOW}{literal}:'NewOrder'},'{/literal}{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$tbl_submenu_dishesinfo.sbmnu_dish_id}&is_preview=1{literal}');{/literal}"  data-inline="true" data-mini="true" data-role="button" data-transition="pop"  data-icon="add-item" data-theme="b">{$_lang.main.order.add_title}</a>
    	{else}
			{if $isUpdate neq 1 && $smarty.request.is_preview eq 1}
	    		<a href="#popupNewOrder" data-mini="true" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" data-icon="add-item" data-theme="b">{$_lang.main.order.add_title}</a>
			{/if}
    	{/if}
	{/if}
	
	{if $sesslife && $Global_member.member_role_id eq $smarty.const.ROLE_WAITER && $curr_shift_waiters}
			<input type="button" data-role="button" data-icon="group" data-inline="true" data-mini="true" value="Change Server" onclick="$('#popupCurrShiftServers').popup('open');" />
  {/if}
	
  {include file="menubar.tpl"}
