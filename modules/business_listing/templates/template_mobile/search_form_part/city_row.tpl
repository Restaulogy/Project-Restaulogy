<table style="width:770px;border:none;">
	<tr>
		<td style="width:40px;border-bottom:none;">
		 	<b style="font-size:12px;">&nbsp;City</b>
		</td>
		<td style="width:120px;border-bottom:none;">
			        <input name="location" id="search_location" type="text" style="width:120px;" value="{$smarty.post.location|escape}" />
		</td>
        <!--
        <td style="width:60px;border-bottom:none;">
 			<b style="font-size:12px;">&nbsp;Country</b>
		</td>
		<td style="width:120px;border-bottom:none;">
 			<select name="country" style="width:120px;padding:0px !important;font-size:12px;" onchange="return dropdown(this);" id="country">
                <option value="">Select Country</option>
                  {if $vs_country}
                        {section name=citm loop=$vs_country}
                            <option value="{$vs_country[citm].iso}" {if $vs_country[citm].iso == $smarty.post.country|escape}selected="selected"{/if}>{$vs_country[citm].name}</option>
                        {/section}
                  {/if}
            </select>
		</td>
		-->
		<td style="width:60px;border-bottom:none;">
 			<b style="font-size:12px;">&nbsp;States</b>
		</td>
		<td style="width:120px;border-bottom:none;">
  		   <select id="search_states" style="width:160px;padding:0px !important;font-size:12px;"  name="states">
          		{if $vs_states}
                {section name=sitm loop=$vs_states}
                    <option  value="{$vs_states[sitm].id}" {if $vs_states[sitm].id == $smarty.post.states || $vs_states[sitm].id == $vs_user_prof_state_id}selected="selected"{/if}>{$vs_states[sitm].name}</option>
                {/section}
            {/if}
          </select>
        </td>
        <td style="width:100px;border-bottom:none;">
            <b style="font-size:12px;">&nbsp; Metro Area</b>
        </td>
        <td style="width:150px;border-bottom:none;">
           <div id='search_metro_area_box'>
          		<select name="metro_area" style="width:140px;padding:0px !important;"  id="search_metro_area">
          		<option value="">Select Metro Area</option>
                {if $vs_user_prof_metro_area_list}
                    {assign var="current_metro_area_list" value=$vs_user_prof_metro_area_list}
                {/if}
          		
                  {if $current_metro_area_list}
                    {section name=sitm loop=$current_metro_area_list}
                    <option  value="{$current_metro_area_list[sitm].metro_id}" {if  $current_metro_area_list[sitm].metro_id== $smarty.post.metro_area || $current_metro_area_list[sitm].metro_id == $vs_user_prof_metro_area }selected="selected"{/if}>{$current_metro_area_list[sitm].metro_name}</option>
                    {/section}
                  {/if}
            	</select>
            </div>
        </td>
	</tr>
</table>

{literal}
  <script type="text/javascript">
	function dropdown(sel){
	     if (sel.value == "US"){
             document.top_search.states.disabled = false;
             document.top_search.metro_area.disabled = false;
		 }else{
             document.top_search.states.value = "";
             document.top_search.states.disabled = true;
             document.top_search.metro_area.value = "";
             document.top_search.metro_area.disabled = true;
		}
    }
	</script>
{/literal}
