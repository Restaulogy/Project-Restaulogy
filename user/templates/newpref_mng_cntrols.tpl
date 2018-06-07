{include file='header.tpl'}
<div class="wrapper">
 <h1>{$_lang.main.pref_mng_cntrls}</h1>
  
 <center>
<ul data-role="listview">
           
			<li><a href="{$website}/user/tbl_dining_table.php">
				<img src="{$website}/images/table.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.mng_table}</a>
		 </li>
      <li><a href="{$website}/user/tbl_services_code.php">
				<img src="{$website}/images/services.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.mng_services}</a></li>
				<li><a href="{$website}/user/tbl_restaurent.php?{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}"><img src="{$website}/images/restaurant.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.mng_rest_prof}</a></li>
         <li><a href="{$website}/user/tbl_staff.php"><img src="{$website}/images/employee.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.mng_emps}</a></li>
     
				{if $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
	    		<li><a href="{$website}/user/tbl_table_status.php"><img src="{$website}/images/status .png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.mng_tbl_sts}</a></li>
				{/if}
			 <li><a href="{$website}/user/tbl_feedback.php"><img src="{$website}/images/feedback.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">
				{$_lang.main.pref_mng_cntrols.mng_feedbk}
			</a></li> 
    <li><a href="{$website}/user/prom_stats.php"><img src="{$website}/images/stats.png" alt="{$_lang.main.pref_mng_cntrols.stats}" height="36" class="ui-li-icon" width="36"/>{$_lang.main.pref_mng_cntrols.stats}</a></li> 
		<li><a href="{$website}/user/tbl_shift.php"><img src="{$website}/images/profile.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.tbl_table_shift_assignment.short_title}</a></li> 
	{if $Global_member.member_role_id eq $smarty.const.ROLE_DEV} <li><a target="_blank" href="{$website}/user/member_role.php"><img src="{$website}/images/profile.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.member_role}</a></li>
  <li><a href="{$website}/user/tbl_role_functionality.php"><img src="{$website}/images/status .png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.role_functioanlity}</a></li> 
	{/if}
	<li><a href="{$website}/user/tbl_discounts.php"><img src="{$website}/images/tag.png" alt="{$_lang.main.customer_dashboard_menu.service_requests}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.discounts}</a></li>		   
	<li><a href="{$website}/user/tbl_tip.php"><img src="{$website}/images/menu.png" alt="{$_lang.main.pref_mng_cntrols.tip_manage}" height="36" class="ui-li-icon" width="36">{$_lang.main.pref_mng_cntrols.tip_manage}</a></li>
</ul> 
</center> 
 
</div> <!--/#wrapper-->
<style type="text/css"> 
.ui-listview .ui-li-icon {
			max-height		: 30px;
			max-width 		: 30px;
			top						: 0.1em; 
			margin-right	:	10px;
	}
</style>
{include file='footer.tpl'}
