
{include file="$deftpl/header.tpl"}
<div data-role="page" style="overflow:hidden">
    <div data-role="header">
        <a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type=PR" data-icon="home" data-iconpos="notext"></a>
		<h4>Search</h4>
	</div>
	<div data-role="content">
        <form name="top_search" id="top_search" action="search.php" method="post" data-ajax="false">
<table>
        <tr>
			<td colspan="2" style="height:5px;"></td>
		</tr>
      <tr>
          <td class="detail_right_td">Keywords</td>
          <td class="detail_left_td">
              <input class="searchfield"  type="text" id="search_keywords" name="sk" value="{$search_key}"/><input type="hidden" name="sa" value="site"/> 
          </td>
      </tr>
		<tr>
			<td class="detail_right_td" VALIGN="TOP">Type</td>
			<td class="detail_left_td">
				<select data-inline="true" data-mini="true" data style="font-size:10px;" name="st" id="st">
					<option value="all">All</option>
					<option value="any">Any</option>
				</select>
			</td>
		</tr>
        <tr>
            <td  class="detail_right_td">Location</td>
            <td class="detail_left_td">
                <input type="checkbox" name="limit_range" id="limit_range" value="on" {if $limit_range == "on"}checked{else}{/if}><label for="limit_range" id="lbl_limit_range" class="no_float">Search Location</label>
            </td>
        </tr>

        <tr>
        <td  class="detail_right_td">Within - Zip</td>
        <td  class="detail_left_td">
			<table>
				<tr>
					<td><input type="text" id="search_range" name="search_range"  size="20" maxlength="20" value="{$search_range}" style='font-size:11px !important;width:100px;height:25px;font-weight:normal !important;' data-inline="true"/></td>
					<td style="vertical-align:middle !important">-</td>
					<td> <input type="text" id="search_zip" name="search_zip" size="8" value="{$search_zip}" style='font-size:11px !important;width:100px;height:25px;font-weight:normal !important;' data-inline="true" maxlength="8"/></td>
				</tr>
			</table> 
        </td>
        </tr>
		<tr style="display:none;" id="err_search_range"><td colspan='2' class="error_td">Please Enter Digits Only</td></tr> 
    <tr>
			<td colspan="2" style="height:5px;"></td>
		</tr>
        <tr>
            <td class="detail_right_td">City</td>
            <td class="detail_left_td">
                <input class="searchfield"  type="text" id="search_city" name="location" value="{$location}"/><input type="hidden" name="sa" value="site">

            </td>
        </tr>
    <tr style="display:none;">
        <td class="detail_right_td">
 		 Country
		</td>
		<td class="detail_left_td">
			<div style="width:170px;">
               <input type="hidden" name="search_country" id="search_country" class="required" value="US"/>
               <!--
	 			<select name="country" id="search_country" data-native-menu="false" >
	                 <option value="">Select Country</option>
	                  {if $vs_country}
                        {section name=citm loop=$vs_country}
                            <option value="{$vs_country[citm].iso}"
                            {if $smarty.post.country}
                                {if $vs_country[citm].iso == $smarty.post.country}selected="selected"{/if}
                            {else}
                                {if $vs_country[citm].iso == $vs_user_prof_country}
                                    selected="selected"
								{/if}
                            {/if}>{$vs_country[citm].name}</option>
                        {/section}
                  	{/if}
	            </select>
	            -->
			</div>
		</td>
    </tr>
    <tr>
        <td class="detail_right_td">
            State
        </td>
        <td class="detail_left_td">
        <div style="width:170px;">
            <select name="states"  id="states_top">
    			{if $current_states_list}
                {section name=sitm loop=$current_states_list}
                    <option value="{$current_states_list[sitm].id}"
                    {if $smarty.post.states}
                        {if $current_states_list[sitm].id== $smarty.post.states}selected="selected"{/if}
                    {else}
                        {if $current_states_list[sitm].id == $vs_user_prof_state_id}selected="selected"{/if}
                    {/if}
					 >{$current_states_list[sitm].name}</option>
               {/section}
               {/if}

        	</select>
		</div>
        </td>
    </tr>
    <tr><td class="detail_right_td"> Metro Area</td>
        <td class="detail_left_td">
        <div style="width:170px;">
        <select name="metro_area"   id="metro_area_top">
    		<option value="">Select Metro Area</option>
                {if $smarty.post.metro_area}
                {else}
                {if $vs_user_prof_metro_area_list}
                    {assign var="current_metro_area_list" value=$vs_user_prof_metro_area_list}
                {/if}
                {/if}
                  {if $current_metro_area_list}
                    {section name=sitm loop=$current_metro_area_list}
                    <option  value="{$current_metro_area_list[sitm].metro_id}"
                    {if $smarty.post.metro_area}
                        {if  $current_metro_area_list[sitm].metro_id eq $smarty.post.metro_area}selected="selected"{/if}
                    {else}
                        {if  $current_metro_area_list[sitm].metro_id eq $vs_user_prof_metro_area}selected="selected"{/if}
                    {/if}>{$current_metro_area_list[sitm].metro_name}</option>
                    {/section}
                  {/if}
    	</select>
		</div>
        </td>
    </tr>
    <tr style="display:none;">
		  <td class="detail_right_td">&nbsp;Category</td>
		<td class="detail_left_td">
 			<input type="button" onclick='show_category_dialog("searchform_categories","searchform_cat_list", ":");' value="..." data-theme="a"/>
	   </td>
		</tr>
		<tr>
			<td colspan="2">
                {if $smarty.post.searchform_cat_list|strlen eq 0}
                        {assign var="search_form_display" value="none"}
                 {else}
                        {assign var="search_form_display" value="block"}
                 {/if}
                    <textarea name="searchform_cat_list" id="searchform_cat_list" style='display:{$search_form_display};max-height:40px;width:100%;background:transparent !important;border:none !important;font-size:10px;line-height:12px !important;height:28px !important;' READONLY>{if $smarty.post.searchform_cat_list}{$smarty.post.searchform_cat_list}{/if}</textarea>
            <input type="text" style='display:none;' name="categories" id="searchform_categories" value="{$smarty.post.categories|escape}"/>
			</td>
		</tr>

		<tr>
            <td colspan="2">
                <input type="checkbox" name="end_this_wk" id="end_this_wk" value="on" onchange="chk_end_this_wk();"  {if $end_this_wk == "on"}checked{else}{/if}><label for="end_this_wk" id="lbl_end_this_wk" class="no_float" >Promotions Ending This Week</label>
            </td>
        </tr>
		<tr style="display:none;">
		  <td class="detail_right_td">Promotion Type</td>
		<td class="detail_left_td">
 			<select type="checkbox" name="cupon_type" id="cupon_type" value="on">
				<option value="all_site" {if $cupon_type eq 'all_site'}selected='selected'{/if}>All site</option>
				<!--<option value="none" {if $cupon_type eq 'none'}selected='selected'{/if}>None</option>
				
				<option value="recommendation"  {if $cupon_type eq 'recommendation'}selected='selected'{/if}>Recommendation</option>
				
				<option value="survey"  {if $cupon_type eq 'survey'}selected='selected'{/if}>Survey</option>
				<option value="reward"  {if $cupon_type eq 'reward'}selected='selected'{/if}>Rewards</option>
				-->
			</select>
	   </td>
		</tr>
     </table>
		<center>
			<input type="hidden" id="sp" name="sp" value=""/>
			<input type="hidden" id="sb" name="sb" value=""/>
			
			<button type="button"  data-inline="true" onclick="validate_search_form('sp');">Deals</button>
			<!--<button type="button"  data-inline="true" onclick="validate_search_form('sb');">Listing</button>-->
			 
		     
            <input title="Reset Search" type="reset"  data-inline="true" value="Reset" onclick="clearForm();" data-theme="a"/>
			
			 
		</center>
</form>

{literal}
 
<script type="text/javascript">
	 
	function validate_search_form(vSearch){
		$('#sp').val("");
		$('#sb').val("");
		if(IsNonEmpty(vSearch)){
		 $('#' + vSearch).val("1");
		var error = false; 
		$('#err_search_range').hide(); 
		if((isNaN($('#search_range').val())) || (isNaN($('#search_zip').val()))){
	  		$('#err_search_range').show(); 
			error = true;
	  }    
   		if(error){
			alert("Please Revise form.");
			return false;
		}else{
			 $('#top_search').submit();
			 return true;
		}
	   }
	   return false;
	}
    function clearForm(){
        //$("#search_states").val('');
        //$("#search_metro_area").val('');
        $('#search_keywords').val('');
        $("#search_zip").val('');
        $("#search_range").val('');
        $("#search_location").val('');
        /*$('#limit_range').prop("checked", false);*/
        $("#categories").val('');
		$('#searchform_categories').val('');
        $('#searchform_cat_list').val('');
        $('#searchform_cat_list').hide();
         $('#filter_keywords').val('');
	   	$('#search_states').val(0);
		$('#search_states').selectmenu('refresh', true);
	   	$('#search_metro_area').empty();
	   	$('#search_metro_area').html('<option value="">Select Metro Area</option>');
		$('#search_metro_area').selectmenu('refresh', true);
		$('#limit_range').attr('checked',false);
		$("#limit_range").checkboxradio("refresh");
    }
        $('#search_country').change(function(){
        change_states_by_country('search_country','states_top','metro_area_top');
         });
        $('#states_top').change(function(){
                change_metro_area_by_state('states_top','metro_area_top');
         });

    function chk_end_this_wk(){
      if($('#end_this_wk').is(":checked")){
            document.getElementById('sb').disabled = true;
      }else{
            document.getElementById('sb').disabled = false;
      }
    }
	</script>
{/literal}

	</div>
    {include file="$deftpl/common_footer.tpl"}
</div>
 
