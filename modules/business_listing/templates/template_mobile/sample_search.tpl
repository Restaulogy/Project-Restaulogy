<tr>
		<td style="	background: -webkit-gradient(linear, left top, left bottom, from(#79dfff), to(#1177aa));background: -moz-linear-gradient(top,  #79dfff,  #1177aa);filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#79dfff', endColorstr='#1177aa');-ms-filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#79dfff', endColorstr='#1177aa');">
		    <table class="job_detail_view">
		        <tr>
					<td><b style="font-size:12px;">&nbsp;Keywords</b> </td>
					<td>
					<small style="font-size:10px;color:#ccc;">[<b>Must be seprated By either space or (,).</b>]</small>
					</td>
					<td> <input class="searchfield"  type="text" style="width:280px;" id="search_keywords" name="sk" value="{$search_key}" ></td>
					<td>
                         {if $search_type == "any"}
		                     <input type="radio" style="width:15px;" name="st" value="all"><b>All</b>
		                     <input type="radio" style="width:15px;" name="st" value="any" checked><b>Any</b>
		                {else}
		                     <input type="radio" style="width:15px;" name="st" value="all" checked><b>All</b>
		                     <input type="radio" style="width:15px;" name="st" value="any"><b>Any</b>
		                {/if}
		                <input type="hidden" name="sa" value="site">
					</td>

				</tr>
		    </table>
		    <table class="job_detail_view">
             <tr>
                 <td >
                    <b style="font-size:12px;">Category </b>
                 </td>
                 <td>
                    <input type="text" name="categories" id="categories" value="{$smarty.post.categories|escape}"/>{$tree_cate}
                 </td>
             </tr>
             </table>
			<table class="job_detail_view">
				<tr>
				    <td><b style="font-size:12px;">City</b></td>
				    <td>
						<input name="location" id="search_location" type="text" style="width:140px;" value="{$smarty.post.location|escape}" />
					</td>
				    <td><b style="font-size:12px;">Country</b></td>
				    <td>
						<select name="country" style="width:130px;font-size:12px;" onchange="return dropdown(this);" id="country">
                            <option value="">Select Country</option>
                              {if $vs_country}
                                    {section name=citm loop=$vs_country}
                                        <option value="{$vs_country[citm].iso}" {if $vs_country[citm].iso == $smarty.post.country|escape}selected="selected"{/if}>{$vs_country[citm].name}</option>
                                    {/section}
                              {/if}
                        </select>
		  			</td>
				    <td><b style="font-size:12px;">States</b></td>
				    <td>
                        <select id="search_states" style="width:130px;font-size:12px;"  name="states" {if $country eq 'US'} {elseif $smarty.post.country eq  'US'} {else}DISABLED{/if} >
                        <option value="">Select States</option>
                		{if $vs_states}
                            {section name=sitm loop=$vs_states}
                                <option  value="{$vs_states[sitm].id}" {if $vs_states[sitm].id ==  $smarty.post.states|escape}selected="selected"{/if}>{$vs_states[sitm].name}</option>
                            {/section}
                        {/if}
                      </select>
					</td>
				    <td><b style="font-size:12px;">Metro Area</b></td>
				    <td>
                        <div id='metro_area_box'>
                      		<select name="metro_area" id="search_metro_area" style="width:140px;">
                      		<option value="">Select Metro Area</option>
                              {if $current_metro_area_list}
                                {section name=sitm loop=$current_metro_area_list}
                                <option  value="{$current_metro_area_list[sitm].metro_id}" {if  $current_metro_area_list[sitm].metro_id == $metro_area ||  $current_metro_area_list[sitm].metro_id== $smarty.post.metro_area }selected="selected"{/if}>{$current_metro_area_list[sitm].metro_name}</option>
                                {/section}
                              {/if}
                        	</select>
                        </div>
					</td>
				</tr>
			</table>




			<table class="job_detail_view">
			    <tr>
			    <td><b style="font-size:12px;">&nbsp;Search Location</b></td>
                <td>
					{if $limit_range == "on"}
	                     <input type="checkbox" style="width:15px;" name="limit_range" id="limit_range" value="on" checked>
	                {else}
	                     <input type="checkbox" style="width:15px;" name="limit_range" id="limit_range" value="on">
	                {/if}
				</td>
                <td>
                Within
				</td>
				<td>
				<input type="text" id="search_range" name="search_range" style="width:30px;" value="{$search_range}">
				</td>
				<td>
				{lang->desc p1='sitesearch' p2=$lang_set p3='search_zip'}
				</td>
				<td>
				 <input type="text" id="search_zip" style="width:50px;" name="search_zip" size="8" value="{$search_zip}">
				</td>
                <td>
                [<b>Promotions :</b>
                 <a style="color:white;font-weight:bold;" href="{$elgg_main_url}mod/UniversalCalendar/MockupPlanner/MockupPlanner.php?promotion=true&evtype=p&state_p=&all_search_keywords=&search_keywords=&category=&prom_today=true" target="_blank" >Today</a>
                 &nbsp;|
                 <a style="color:white;font-weight:bold;" href="{$elgg_main_url}mod/UniversalCalendar/MockupPlanner/MockupPlanner.php?promotion=true&evtype=p&state_p=&all_search_keywords=&search_keywords=&category=&prom_this_week=true" target="_blank" >This Week </a>
                 &nbsp;|
                 <a style="color:white;font-weight:bold;" href="{$elgg_main_url}mod/UniversalCalendar/MockupPlanner/MockupPlanner.php?promotion=true&evtype=p&state_p=&all_search_keywords=&search_keywords=&category=&prom_next_week=true" target="_blank" >Next Week</a>
                 ]
				</td>
				</tr>
			</table>
		</td>
	</tr>
