<table style="width:770px;border:none;">
	<tr>
		<td style="width:120px;border-bottom:none;">
 			<b style="font-size:12px;">&nbsp;Search Location</b>
		</td>
		<td style="width:20px;veritcal-align:middle;border-bottom:none;">
			<input type="checkbox" name="limit_range" id="limit_range" value="on" {if $limit_range == "on"}checked{else}{/if} style="width:20px;">
            
		</td>
		<td style="width:45px;border-bottom:none;">
 			<b style="font-size:12px;">&nbsp;within</b>
		</td>
		<td style="width:30px;border-bottom:none;">
        <input type="text" id="search_range" name="search_range"style="width:30px;" value="{$search_range}"/>
		</td>
		
		<td style="width:140px;border-bottom:none;">
 			<b style="font-size:12px;">{lang->desc p1='sitesearch' p2=$lang_set p3='search_zip'}</b>
		</td>
		<td style="width:50px;border-bottom:none;">
 			<input type="text" id="search_zip" style="width:50px;" name="search_zip" size="8" value="{$search_zip}"/>
		</td>
		<td style="width:5px;font-size:21px;border-bottom:none;">[</td>
		<td style="width:90px;border-bottom:none;">
		 <b style="font-size:12px;border-bottom:none;">Promotions :</b>
		</td>
		<td style="width:65px;border-bottom:none;">
		<a href="{$elgg_main_url}mod/UniversalCalendar/MockupPlanner/MockupPlanner.php?promotion=true&evtype=p&state_p=&all_search_keywords=&search_keywords=&category=&prom_today=true" target="_blank" ><b style="font-size:11px;">Today</b></a>&nbsp;|
		</td>
		<td style="width:100px;border-bottom:none;">
			<a href="{$elgg_main_url}mod/UniversalCalendar/MockupPlanner/MockupPlanner.php?promotion=true&evtype=p&state_p=&all_search_keywords=&search_keywords=&category=&prom_this_week=true" target="_blank" ><b style="font-size:11px;">This Week</b></a>&nbsp;|
		</td>
		<td style="width:75px;border-bottom:none;">
			<a href="{$elgg_main_url}mod/UniversalCalendar/MockupPlanner/MockupPlanner.php?promotion=true&evtype=p&state_p=&all_search_keywords=&search_keywords=&category=&prom_next_week=true" target="_blank" ><b style="font-size:11px;">Next Week</b></a>
		</td>
		<td style="width:5px;font-size:21px;border-bottom:none;">]</td>

	</tr>
</table>
