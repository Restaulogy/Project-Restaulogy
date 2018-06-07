{if $title_tag eq "Add New Business Listing"}
	{assign var="is_new" value ="1"}
{else}
	{assign var="is_new" value ="0"}
{/if}
<table class="job_detail_panal_table">
<tr>
	<td class="detail_right_td">
        <label for="firmname"><font color="red">*</font> {lang->desc p1='pds_list' p2=$lang_set p3='firm'}</label>
	</td>
	<td class="detail_left_td">
        <input type=text id="firm"  class="required" name="firm" value="{if $firm}{$firm}{else}{$smarty.post.firm}{/if}">
        <div class="extra_info">eg.'Phoenix Finacial Company'</div>
	</td>
</tr>
<tr><td colspan="2"><span id="firm_error" class="form_error"></span></td></tr>

 <tr style="display:none;">
 <td class="detail_right_td"><font color="red">*</font> Categories</td>
 <td class="detail_left_td"> <button type="button" onclick='show_category_dialog("category_listing","cat_list", ":");' data-theme="a">...</button>
     </td>
   </tr>
   <tr style="display:none;">
		<td colspan="2">
        {$list_categories}
            {if $list_category|strlen eq 0}
                {assign var="cat_display" value="none"}
            {else}
                {assign var="cat_display" value="block"}
            {/if}
               <textarea id="cat_list" name="cat_list" style='display:{$cat_display};font-size:10px !important;line-height:12px !important;height:28px !important;' READONLY>{if $list_category}{$list_category}{else}{$smarty.post.cat_list}{/if}</textarea>
               <input type = "text" name="categories" id="category_listing" style="display:none;"  class="required"  value ="{if $cat_str}{$cat_str}{else}{$smarty.post.categories}{/if}" />
		</td>
   </tr>
   <tr><td colspan="2"><span id="category_listing_error" class="form_error"></span></td></tr>

    <tr>
          <td class="detail_right_td" colspan="2"> {lang->desc p1='pds_list' p2=$lang_set p3='description'}
          </td>
	</tr>
	<tr>
         <td class="detail_left_td" colspan="2">

{literal}

<script language="javascript" type="text/javascript" src="../../tinymce/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script language="javascript" type="text/javascript">
   tinyMCE.init({
	mode : "exact",
	elements : "description,xtra_1",
	theme :"advanced",
	width :"200",
	relative_urls : false,
	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,bullist,numlist,undo,redo,link,unlink,image,blockquote,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	extended_valid_elements : "a[name|href|target=_blank|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	onchange_callback: function (editor)     {
      tinyMCE.triggerSave();
    }
});
function toggleEditor(id) {
if (!tinyMCE.get(id))
	tinyMCE.execCommand('mceAddControl', false, id);
else
	tinyMCE.execCommand('mceRemoveControl', false, id);
}

</script>

{/literal}
 <div style="width:250px;overflow-x:scroll !important">
<textarea style="width:95%;" rows="5" class="required" id="description" name="description">{if $description}{$description}{else}{$smarty.post.description}{/if}</textarea><div class="toggle_editor_container" onchange="tinyMCE.triggerSave();"><a class="toggle_editor" href="javascript:toggleEditor('description');">Add/Remove editor</a></div>
</div>
</td>
 </tr>
 <tr><td colspan="2"><span id="description_error" class="form_error"></span></td></tr>
 <tr>
         <td class="detail_right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='website'}

    {if $required.website}
           <font color={#required_field_color#}>
            {#required_field_ind#}
           </font>
    {/if}
          </td>
          <td class="detail_left_td">
            <input type="text" id="website" name="website" value="{if $website}{$website}{else}{$smarty.post.website}{/if}">
            <div class="extra_info">eg.'http://websitename.com'</div>
          </td>
          </tr>
          <tr><td colspan="2"><span id="website_error" class="form_error"></span></td></tr>
          <tr style="display:none;">
       
    	<td class="detail_right_td">
			<font color="red">*</font> Country
   		 </td>
          {literal}
          <script type="text/javascript">
			function dropdown(sel)
			{
	             if (sel.value == "US"){
	                document.getElementById('states').disabled = false;
                    document.getElementById('metro_area').disabled = false;
	             }else{
	                 document.getElementById('states').value = "0";
	                 document.getElementById('states').disabled = true;
                  	 document.getElementById('metro_area').value = "";
	                 document.getElementById('metro_area').disabled = true;
				 }
			}
			</script>
			{/literal}
          <td class="detail_left_td">
          <div style="width:180px">
          <input type="hidden" name="country" id = "country" class="required" value="US"/>
          <!--
          <select name="country" class="required" onchange="return dropdown(this)"   id = "country">

            <option value="">Select Country</option>
          {if $vs_country}
     		{section name=citm loop=$vs_country}

                    <option  value="{$vs_country[citm].iso}" {if $is_new}{if $vs_country[citm].iso == "US"}selected="selected"{/if} {else}{if $vs_country[citm].iso == $country || $vs_country[citm].iso == $smarty.post.country }selected="selected"{/if}{/if}>{$vs_country[citm].name}</option>
                {/section}

          {/if}
          </select>
          -->
          </div>
          <div class="extra_info" id="country_extra_info">eg.'United States'</div>
	</td>
	</tr>
	<tr><td colspan="2"><span id="country_error" class="form_error"></span></td></tr>

         <tr>
	 <td class="detail_right_td">
		<font color="red">*</font> States<Br>
        <small style="font-size:9px;">(For US Only)</small>
    </td>
    <td class="detail_left_td">
        <div style="width:180px;">
		   <select id="states"  name="states" {if $is_new}{else}{if $country eq 'US' || $country eq 'IN'}{else}DISABLED{/if}{/if} >
            <option value="">Select States</option>
  	{if $current_states_list}
                {section name=sitm loop=$current_states_list}
                    <option value="{$current_states_list[sitm].id}" {if  $current_states_list[sitm].id == $states || $current_states_list[sitm].id== $smarty.post.states}selected="selected"{/if}>{$current_states_list[sitm].name}</option>
                {/section}

          {/if}
                </select>
        </div>
               <div class="extra_info"  id="state_extra_info">eg.'Arizona'</div>
          </td>
	</tr>
	<tr><td colspan="2"><span id="states_error" class="form_error"></span></td></tr>
	<tr>
         <span id="show_sub_categories" >
         	<td class="detail_right_td">
                <font color="red">*</font> Metro Area
                <Br>
	           <small style="font-size:9px;">(For US Only)</small>
            </td>
         <td class="detail_left_td" colspan=2>
            <div style="width:180px;" id="metro_area_box" >
            <select name="metro_area"  id="metro_area" {if $is_new}{else}{if $country eq 'US' || $country eq 'IN'}{else}DISABLED{/if}{/if}>
                <option value="">Select Metro Area</option>
                 {if  $current_metro_area_list}
                    {section name=sitm loop=$current_metro_area_list}
                    <option  value="{$current_metro_area_list[sitm].metro_id}" {if  $current_metro_area_list[sitm].metro_id == $metro_area || $current_metro_area_list[sitm].metro_id== $smarty.post.metro_area}selected="selected"{/if}>{$current_metro_area_list[sitm].metro_name}</option>
                    {/section}
                 {/if}
            </select>
            </div>
            <div class="extra_info"  id="metro_area_extra_info">eg.'Phoenix'</div>
         </td>
         </span>
		</tr>
		<tr><td colspan="2"><span id="metro_area_error" class="form_error"></span></td></tr>
</table>
