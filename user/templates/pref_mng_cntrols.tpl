{include file='header.tpl'}
<div class="wrapper">
 <h1>{$_lang.main.pref_mng_cntrls}</h1>

<table class="cnf">
		<tr>
         <td>
			<a href="{$website}/user/tbl_menu.php">
				<img src="{$website}/css/jqm_extra_icon/green/addressbook.png" alt="{$_lang.main.set_up_menu.sum_menu}"/>
				<span>{$_lang.main.set_up_menu.sum_menu}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            <a href="{$website}/user/tbl_dishes.php">
				<img src="{$website}/css/jqm_extra_icon/green/disc.png" alt="{$_lang.main.set_up_menu.sum_dish}"/>
				<span>{$_lang.main.set_up_menu.sum_dish}</span>
			</a>
         </td>
    </tr>
    <tr>
         <td>
            
			<a href="{$website}/user/tbl_dining_table.php">
				<img src="{$website}/css/jqm_extra_icon/green/full-screen.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.mng_table}</span>
			</a>
			
		 </td>
         <th>&nbsp;</th>
         <td>
             <a href="{$website}/user/tbl_staff.php">
				<img src="{$website}/css/jqm_extra_icon/green/group.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.mng_emps}</span>
			</a>
         </td>
    </tr>
    
    {*
    <tr>
         <td>
            <!--<a href="{$website}/user/tbl_shift.php">
				<img src="{$website}/css/jqm_extra_icon/green/table.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.tbl_shift.title}</span>
			</a>-->
		 </td>
         <th>&nbsp;</th>
         <td>
            <!-- shift
            <a href="{$website}/user/tbl_shift.php">
				<img src="{$website}/css/jqm_extra_icon/green/arrow-round.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.tbl_table_shift_assignment.short_title}</span>
			</a>
			-->
		 </td>
    </tr>
    
	<tr>
         <td>
        <!-- discounts
        <a href="{$website}/user/tbl_discounts.php">
				<img src="{$website}/css/jqm_extra_icon/green/tag.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.discounts}</span>
			</a>
		-->
		 </td>
         <th>&nbsp;</th>
         <td>
            <!--
            <a href="{$website}/user/tbl_tip.php">
				<img src="{$website}/css/jqm_extra_icon/green/dollar.png" alt="{$_lang.main.pref_mng_cntrols.tip_manage}"/>
				<span>{$_lang.main.pref_mng_cntrols.tip_manage}</span>
			</a>
			-->
 		</td>
    </tr>
    *}
		<tr>
        <td>
			<a href="{$website}/user/tbl_feedback.php">
				<img src="{$website}/css/jqm_extra_icon/green/edit.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.mng_feedbk}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            <a href="{$website}/user/tbl_qrcode_log.php">
				<img src="{$website}/css/jqm_extra_icon/green/bar-chart-02.png" alt="{$_lang.tbl_qrcode_log.title}"/>
				<span>{$_lang.tbl_qrcode_log.title}</span>
			</a>
         
         <!-- sattuses
            <a href="{$website}/user/tbl_statuses.php">
				<img src="{$website}/css/jqm_extra_icon/green/database.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.status_manage}</span>
			</a>
           
           {if $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
	    		<a href="{$website}/user/tbl_table_status.php">
					<img src="{$website}/css/jqm_extra_icon/green/glasses.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
					<span>{$_lang.main.pref_mng_cntrols.mng_tbl_sts}</span>
				</a>
		   {/if}
		   -->

         </td>
    </tr>
    
    <tr>
        <td>
			<!--<a href="{$website}/user/tbl_crm_list.php">
				<img src="{$website}/css/jqm_extra_icon/green/connected.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.navbar.crm}</span>
			</a>-->
			<a href="{$website}/user/tbl_qrcode_log.php">
				<img src="{$website}/css/jqm_extra_icon/green/pie-chart.png" alt="{$_lang.main.pref_mng_cntrols.stats}" height="136" width="136"/>
				<span>{$_lang.main.pref_mng_cntrols.stats}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td> 
             <a href="{$website}/user/biz_rewards.php">
				<img src="{$website}/css/jqm_extra_icon/green/pie-chart.png" alt="{$_lang.main.pref_mng_cntrols.rewards}"/>
				<span>{$_lang.main.pref_mng_cntrols.rewards}</span>
			</a>
         </td>
    </tr>
	<tr>
         <td></td>
         <th>&nbsp;</th>
         <td></td>
    </tr>
    
    <tr>
        <td>
			<a href="{$website}/user/tbl_dish_attrib.php">
				<img src="{$website}/css/jqm_extra_icon/green/ID.png" alt="{$_lang.tbl_dish_attrib.title}"/>
				<span>{$_lang.tbl_dish_attrib.title}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
             <a href="{$website}/user/tbl_server_pin.php">
				<img src="{$website}/css/jqm_extra_icon/green/cassette.png" alt="{$_lang.tbl_server_pin.title}"/>
				<span>{$_lang.tbl_server_pin.title}</span>
			</a>
         </td>
    </tr>
    
    <tr>
         <td>
            <a href="{$website}/user/tbl_restaurent.php?{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}">
				<img src="{$website}/css/jqm_extra_icon/green/configuration.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.mng_rest_prof}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
             <a target="_blank" href="{$website}/user/tbl_food_notes.php">
				<img src="{$website}/css/jqm_extra_icon/green/edit.png" alt="{$_lang.tbl_rest_menu_opt.title}"/>
				<span>{$_lang.tbl_food_notes.title}</span>
			</a>
         <!--
           <a href="{$website}/user/prom_stats.php">
				<img src="{$website}/css/jqm_extra_icon/green/pie-chart.png" alt="{$_lang.main.pref_mng_cntrols.stats}" height="136" width="136"/>
				<span>{$_lang.main.pref_mng_cntrols.stats}</span>
			</a>
         -->
         </td>
    </tr>
    
    <!--
    <tr>
         <td>
            
		 </td>
         <th>&nbsp;</th>
         <td>
         	<a href="{$website}/user/prom_stats.php">
				<img src="{$website}/css/jqm_extra_icon/green/pie-chart.png" alt="{$_lang.main.pref_mng_cntrols.stats}" height="136" width="136"/>
				<span>{$_lang.main.pref_mng_cntrols.stats_order}</span>
			</a>	
            
         </td>
    </tr>
    -->
    <tr>
         <td>
            <a href="{$website}/user/tbl_banned_users.php">
				<img src="{$website}/css/jqm_extra_icon/green/group.png" alt="{$_lang.tbl_staff.banned_users}"/>
				<span>{$_lang.tbl_staff.banned_users}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            <a href="{$website}/user/tbl_cust_filter_email.php">
				<img src="{$website}/css/jqm_extra_icon/green/ID.png" alt="{$_lang.tbl_cust_filter_email.title}"/>
				<span>{$_lang.tbl_cust_filter_email.title}</span>
			</a>
			</a>
         </td>
    </tr>
    
    <tr>
         <td>
            <a href="{$website}/user/tbl_landing_page.php">
				<img src="{$website}/css/jqm_extra_icon/green/next-item.png" alt="{$_lang.tbl_landing_page.title}"/>
				<span>{$_lang.tbl_landing_page.title}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            <!--<a href="{$website}/user/ethor_menu.php">
				<img src="{$website}/css/jqm_extra_icon/green/edit.png" alt="{$_lang.main.ethor.import}"/>
				<span>{$_lang.main.ethor.import}</span>
			</a>-->
			<a href="{$website}/user/tbl_daily_report.php">
				<img src="{$website}/css/jqm_extra_icon/green/bookmark.png" alt="{$_lang.main.prom_stats.daily_report}"/>
				<span>{$_lang.main.prom_stats.daily_report}</span>
			</a>
         </td>
    </tr>
    
     <tr>
         <td>
            <a href="{$website}/user/tbl_loyalty_level.php">
				<img src="{$website}/css/jqm_extra_icon/green/next-item.png" alt="{$_lang.tbl_loyalty_level.title}"/>
				<span>{$_lang.tbl_loyalty_level.title}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            <a href="{$website}/user/csv_menu_import.php">
				<img src="{$website}/css/jqm_extra_icon/green/next-item.png" alt="Menu CSV Import"/>
				<span>Menu CSV Import</span>
			</a>
         </td>
    </tr>
    
     <tr>
         <td>
             <a href="{$website}/user/csv_prom_sent_import.php">
				<img src="{$website}/css/jqm_extra_icon/green/bookmark.png" alt="Prom Sent CSV Import"/>
				<span>Prom Sent CSV Import</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
           &nbsp;
         </td>
    </tr>

	{if $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
	<tr>
         <td>
&nbsp;
            <a target="_blank" href="{$website}/user/member_role.php">
				<img src="{$website}/css/jqm_extra_icon/green/ID.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.member_role}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            <a href="{$website}/user/tbl_role_functionality.php">
				<img src="{$website}/css/jqm_extra_icon/green/database.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}"/>
				<span>{$_lang.main.pref_mng_cntrols.role_functioanlity}</span>
			</a>
		 </td>
    </tr>
    
    <tr>
         <td>
&nbsp;
            <a target="_blank" href="{$website}/user/tbl_rest_menu_opt.php">
				<img src="{$website}/css/jqm_extra_icon/green/briefcase.png" alt="{$_lang.tbl_rest_menu_opt.title}"/>
				<span>{$_lang.tbl_rest_menu_opt.title}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            &nbsp;
            <a target="_blank" href="{$website}/user/tbl_allergy_list.php">
				<img src="{$website}/css/jqm_extra_icon/green/shield.png" alt="{$_lang.tbl_allergy_list.title}"/>
				<span>{$_lang.tbl_allergy_list.title}</span>
			</a>
		 </td>
    </tr>
    <tr>
         <td>
&nbsp;
		 <a target="_blank" href="{$website}/user/tbl_rest_groups.php">
				<img src="{$website}/css/jqm_extra_icon/green/briefcase.png" alt="{$_lang.tbl_rest_groups.title}"/>
				<span>{$_lang.tbl_rest_groups.title}</span>
			</a>
		 </td>
		 </td>
         <th>&nbsp;</th>
         <td>

		 </td>
    </tr>
	{/if}
    <tr>
         <td></td>
         <th>&nbsp;</th>
         <td></td>
    </tr>
</table>  
</div> <!--/#wrapper-->
 
{include file='footer.tpl'}
