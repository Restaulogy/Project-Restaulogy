<!--
<a href="#popupMenu" data-rel="popup" data-role="button" data-transition="slideup" style="width:99.5%;" data-icon="gear" data-theme="b">Open Menu...</a>
<div data-role="popup" id="popupMenu" data-theme="b">
-->
<div id="idsidebrmnu">
    <ul data-role="listview" data-inset="true" data-theme="d2">
        <!--<li data-role="divider" data-theme="b">Choose Menu</li>--> 
 
        				
       {if $sesslife}
			{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER OR $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
                <li><a href="{$website}/user/tbl_menu.php?is_preview=1">{$_lang.main.navbar.menus}</a></li>
				{if $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER OR $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
				<!--<li><a href="{$website}/user/setup_menu">{$_lang.main.navbar.setup}</a></li>-->
				{else}     
				    {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_prom_claimed neq 1}
				    {else}
                       <!-- <li><a href="{$website}/modules/business_listing/promotion.php?list_id={$smarty.session[$smarty.const.SES_RESTAURANT]}&new=1">{$_lang.main.navbar.new_promotion}</a></li>-->
				    {/if}
				{/if}
				
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_serv_req neq 1}					
				{else}
					<li><a href="{$website}/user/employee_requests">{$_lang.services_requests.employee_request.title}</a></li>
				{/if}    
				
                {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_orders neq 1}					
				{else}
					 <li><a href="{$website}/user/tbl_orders.php">{$_lang.main.navbar.mng_order}</a></li>
				{/if}
				
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_tbl_statuses neq 1}					
				{else}
					 <li><a href="{$website}/user/tbl_table_status_link.php?latestOnly={if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER}1{else}0{/if}">{$_lang.tbl_table_status.listing_title}</a></li>
				{/if}
				
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_loyalty_rewards neq 1}					
				{else}
					 <li><a href="{$website}/user/rewrad_point_list.php">{$_lang.biz_rewards.title}</a></li>
				{/if}
				
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_complaints neq 1}					
				{else}
					 <li><a href="{$website}/user/tbl_complaints.php">{$_lang.tbl_complaints.listing_title}</a></li>
				{/if}
					
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_transfer_tbl neq 1}					
				{else}
					<!--<li><a href="{$website}/user/tbl_transfer.php">{$_lang.tbl_transfer.title} {$_lang.tbl_transfer.label.trans_table}</a></li>-->
				{/if}			
								
                {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_online_users neq 1}					
				{else}
					<!--<li><a href="{$website}/user/online_users">{$_lang.main.pref_mng_cntrols.online_users}</a></li>-->
				{/if}			
				<!-- AND $smarty.session.rest_menu_opt_det.rst_mnu_prom_claimed neq 1 -->
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER }					
				{else}
					<li><a href="{$website}/modules/business_listing/promotion.php?list_id={$smarty.session[$smarty.const.SES_RESTAURANT]}&new=1">{$_lang.main.navbar.new_promotion}</a></li>
				{/if}
						
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER AND $smarty.session.rest_menu_opt_det.rst_mnu_configuration neq 1}					
				{else}
					<li><a href="{$website}/user/pref_mng_cntrols">{$_lang.main.navbar.controls}</a></li>
				{/if}
				
				
		{elseif $Global_member.member_role_id eq $smarty.const.ROLE_WAITER}
			
                {if $smarty.session.rest_menu_opt_det.rst_mnu_add_prom eq 1}
                    <li><a href="{$website}/user/tbl_menu.php">{$_lang.main.navbar.menus}</a></li>
				{/if}
				{if $smarty.session.rest_menu_opt_det.rst_mnu_serv_req eq 1}
                    <li><a href="{$website}/user/employee_requests">{$_lang.services_requests.employee_request.title}</a></li>
				{/if}
                {if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1}
                    <li><a href="{$website}/user/tbl_orders.php">{$_lang.main.navbar.mng_order}</a></li>
				{/if}
				{if $smarty.session.rest_menu_opt_det.rst_mnu_tbl_statuses eq 1}
                    <li><a href="{$website}/user/tbl_table_status_link.php?latestOnly={if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER}1{else}0{/if}">{$_lang.tbl_table_status.listing_title}</a></li>
				{/if}
				{if $smarty.session.rest_menu_opt_det.rst_mnu_prom_claimed eq 1}
			     <li><a href="{$website}/modules/business_listing/promotionslisting.php?show_type=PR">{$_lang.main.navbar.promotions}</a></li>
			    {/if}
				{if $smarty.session.rest_menu_opt_det.rst_mnu_loyalty_rewards eq 1}
                    <li><a href="{$website}/user/customer_rewards.php">{$_lang.biz_rewards.title}</a></li>
			    {/if}
			    {if $smarty.session.rest_menu_opt_det.rst_mnu_complaints eq 1}
                    <li><a href="{$website}/user/tbl_complaints.php?mode={$smarty.const.MODE_CREATE}">{$_lang.tbl_complaints.listing_title}</a></li>
			 	{/if}
                <!--<li><a href="{$website}/user/editprofile">{$_lang.update_profile}</a></li>-->
   
		{elseif $Global_member.member_role_id eq $smarty.const.ROLE_KITCHEN || $Global_member.member_role_id eq $smarty.const.ROLE_BAR}
			
                {if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1}
                    <li><a href="{$website}/user/tbl_orders.php">{$_lang.main.navbar.mng_order}</a></li>
                {/if}
                {if $smarty.session.rest_menu_opt_det.rst_mnu_add_order eq 1}
				    <li><a href="{$website}/user/tbl_orders.php?ord_online=1">{$_lang.main.navbar.online_order}</a></li>
				{/if}			
		
   		{else} 
   		  		
            {if $smarty.session[$smarty.const.SES_ONLINE_STORE] neq 1}
                {if $smarty.session.rest_menu_opt_det.rst_mnu_add_prom eq 1}
                    <li><a href="{$website}/user/dashboard.php">{$_lang.main.customer_nav_menu.dashboard} </a></li>
                {/if}
			{/if}
			<li><a href="{$website}/user/tbl_menu.php?is_preview=1">{$_lang.main.navbar.menus}</a></li>
			{if $smarty.session.rest_menu_opt_det.rst_mnu_prom_claimed eq 1}
			     <li><a href="{$website}/modules/business_listing/promotionslisting.php?show_type=PR">{$_lang.main.navbar.promotions}</a></li>
			{/if}
			{if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1}
                    <li><a href="{$website}/user/tbl_orders.php">{$_lang.main.navbar.mng_my_orders}</a></li>
			 {/if}
			 {if $smarty.session.rest_menu_opt_det.rst_mnu_loyalty_rewards eq 1}
                    <li><a href="{$website}/user/customer_rewards.php">{$_lang.biz_rewards.title}</a></li>
			 {/if}
			 {if $smarty.session.rest_menu_opt_det.rst_mnu_complaints eq 1}
                    <li><a href="{$website}/user/tbl_complaints.php?mode={$smarty.const.MODE_CREATE}">{$_lang.tbl_complaints.listing_title}</a></li>
			 {/if}
				<!--<li><a href="{$website}/user/editprofile.php">{$_lang.update_profile}</a></li>-->
              
			{/if}
			{if ($Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_DEV OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER)==FALSE}
				<!--
                <li><a href="{$website}/user/tbl_alerts.php">{$_lang.tbl_alerts.title}</a></li> -->
			{/if}
		 
			<!-- <li><a href="{$website}/user/logout">{$_lang.sign_out}</a></li> -->
	{elseif $smarty.session[$smarty.const.SES_TABLE] gt 0}	
            {if $smarty.session.rest_menu_opt_det.rst_mnu_add_prom eq 1}
                <li><a href="{$website}/user/dashboard.php">{$_lang.main.customer_nav_menu.dashboard}</a></li>
            {/if}                    

			{if $isCustomer && $tmporder_details && $Global_member.rst_mnu_orders eq 1}
				<li><a href="#" onclick="$('#popupOrderRate').popup('open');">Rate Ordered Items</a></li>
  	        {/if}
            
            <li><a href="{$website}/user/tbl_menu.php">{$_lang.main.navbar.menus}</a></li>
            {if $smarty.session.rest_menu_opt_det.rst_mnu_prom_claimed eq 1}
                <li><a href="{$website}/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR">{$_lang.main.navbar.promotion}</a></li>
            {/if}
            <!--
			<li><a href="{$website}/user/services_request.php?table_id={$smarty.session[$smarty.const.SES_TABLE]}">{$_lang.main.customer_nav_menu.send_requests}</a></li>			 -->
			 {if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1}
                    <li><a href="{$website}/user/tbl_orders.php">{$_lang.main.navbar.mng_my_orders}</a></li>
			 {/if}
			 {if $smarty.session.rest_menu_opt_det.rst_mnu_loyalty_rewards eq 1}
                    <li><a href="{$website}/user/customer_rewards.php">{$_lang.biz_rewards.title}</a></li>
			 {/if}
			 {if $smarty.session.rest_menu_opt_det.rst_mnu_complaints eq 1}
                    <li><a href="{$website}/user/tbl_complaints.php?mode={$smarty.const.MODE_CREATE}">{$_lang.tbl_complaints.listing_title}</a></li>
			 {/if}
			 
             {if $smarty.session[$smarty.const.SES_COOKIE_UID] gt 0}
			    <!-- <li><a href="{$website}/user/tbl_alerts.php">{$_lang.tbl_alerts.title}</a></li> -->
			 {/if}
             <!--
			 <li><a href="{$website}/user/tbl_feedback.php">{$_lang.tbl_feedback.listing_title}</a></li>
			 <li><a href="{$website}/user/login">{$_lang.sign_in}</a></li>
             -->
	{elseif $smarty.session[$smarty.const.SES_ONLINE_STORE] gt 0}
            {if $smarty.session.rest_menu_opt_det.rst_mnu_add_order eq 1}
            DDDDDD
                  <li><a href="{$website}/user/online_store.php">Home</a></li>
        		  <li><a href="{$website}/user/tbl_menu.php?online_store=1">{$_lang.main.navbar.menus}</a></li>
                {if $smarty.session.rest_menu_opt_det.rst_mnu_add_prom eq 1}
                    <li><a href="{$website}/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR">{$_lang.main.navbar.promotion}</a></li>
    			{/if}
    			{if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1}
                    <li><a href="{$website}/user/tbl_orders.php">{$_lang.main.navbar.mng_my_orders}</a></li>
    			{/if}
			{/if}

			{if $smarty.session[$smarty.const.SES_COOKIE_UID] gt 0}
				<!-- <li><a href="{$website}/user/tbl_alerts.php">{$_lang.tbl_alerts.title}</a></li>  -->
			{/if}	
	{else}   
		<!--
		<li><a href="{$website}/user/login">{$_lang.sign_in}</a></li>
		<li><a href="{$website}/user/register">{$_lang.sign_up}</a></li>
		<li><a href="{$website}/user/forgot">{$_lang.forgot_password}</a></li> 
		-->
	{/if}
		

		
    </ul>
</div>
