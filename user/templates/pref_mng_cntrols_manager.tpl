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
			<a href="{$website}/user/tbl_dish_attrib.php">
				<img src="{$website}/css/jqm_extra_icon/green/ID.png" alt="{$_lang.tbl_dish_attrib.title}"/>
				<span>{$_lang.tbl_dish_attrib.title}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
             <a target="_blank" href="{$website}/user/tbl_food_notes.php">
				<img src="{$website}/css/jqm_extra_icon/green/edit.png" alt="{$_lang.tbl_rest_menu_opt.title}"/>
				<span>{$_lang.tbl_food_notes.title}</span>
			</a>
         </td>
    </tr>
    
    <tr>
        <td>
			<a href="{$website}/user/tbl_cust_filter_email.php">
				<img src="{$website}/css/jqm_extra_icon/green/ID.png" alt="{$_lang.tbl_cust_filter_email.title}"/>
				<span>{$_lang.tbl_cust_filter_email.title}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
             <a href="{$website}/user/tbl_daily_report.php">
				<img src="{$website}/css/jqm_extra_icon/green/bookmark.png" alt="{$_lang.main.prom_stats.daily_report}"/>
				<span>{$_lang.main.prom_stats.daily_report}</span>
			</a>
         </td>
    </tr>
    
    <tr>
        <td>
			<!--<a href="{$website}/user/ethor_menu.php">
				<img src="{$website}/css/jqm_extra_icon/green/edit.png" alt="{$_lang.main.ethor.import}"/>
				<span>{$_lang.main.ethor.import}</span>
			</a>-->
		 </td>
         <th>&nbsp;</th>
         <td>
            &nbsp;
         </td>
    </tr>
{/if}   
</table>  
</div> <!--/#wrapper-->
 
{include file='footer.tpl'}
