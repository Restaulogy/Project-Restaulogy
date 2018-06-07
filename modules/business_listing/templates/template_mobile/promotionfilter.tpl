 <form id="intersted_in_form" name="intersted_in_form" class="job_detail_view" method="post" action = "" >
    <div class="extra_info" style="text-align:left;">

*Fill Your Filter Criteria To Find Your Type Of {if $isPromotions == 1}Promotions{else}Business Listing{/if}

</div>
    <table width=100% >

         <tr>
             {if $prev_id}
	          	<th colspan="2">Update Criteria</th>
			 {else}
			    <th colspan="2">Insert Criteria</th>
	         {/if}

		 </tr>
		 <tr>
		    <td class="right_td">Keywords
		    </td>
            <td class="left_td">
			<input type="text" value="{if $prev_keywords}{$prev_keywords}{else}{$smarty.post.keywords}{/if}" name="keywords" id="keywords"/>
		    </td>
		 </tr>
		 <tr>
		    <td class="right_td">Business Title
		    </td>
            <td class="left_td">
			<input type="text" value="{if $prev_business_title}{$prev_business_title}{else}{$smarty.post.business_title}{/if}" name="business_title" id="business_title"/>
		    </td>
		 </tr>
         <tr>
         <td class="right_td">
             Select Categories
         </td>
         <td   class="left_td">
         	<div class="new_dTree" style="text-align:left;">


	{literal}
        <script type="text/javascript">

        d1 = new new_dTree('d1');
        d1.add(0,-1,'Categories','','');
        {/literal}

        {section name=citm loop=$vs_all_cat}
            {if ($vs_all_cat[citm].isdisable eq 1) && (($prev_categories) && (in_array($vs_all_cat[citm].id,$prev_categories)) eq false)}
                <!-- Do not Add category -->
            {else}
                    {literal}d1.add({/literal}{$vs_all_cat[citm].id}{literal},{/literal}{$vs_all_cat[citm].pid}{literal},{/literal}'{$vs_all_cat[citm].title}'{literal},'',{/literal}'<input type="checkbox" style="width:25px;" name="nodes"      id="nodes{$vs_all_cat[citm].id}" onClick="cycleCheckboxes(this.form);"  value="{$vs_all_cat[citm].id}" {if (($prev_categories) && (in_array($vs_all_cat[citm].id,$prev_categories)))}checked="checked"{/if}/>'{literal}){/literal}
            {/if}
           {/section}

        {literal}
        document.write(d1);

        </script>
    {/literal}

<input type = "text" name="categories" id="categories" style="display:none;"  class="required"  value ="{if $categories_str}{$categories_str}{/if}"   />
{literal}
<script type='text/javascript'>
function cycleCheckboxes(what) {
    var myStr="";
    for (var i = 0; i<what.elements.length; i++) {
        if ((what.elements[i].name.indexOf('nodes') > -1)) {
            if (what.elements[i].checked) {
                  myStr += what.elements[i].value + ',';
            }
        }
    }

      var strLen = myStr.length;
	  myStr = myStr.slice(0,strLen-1);
	  $("#categories").val(myStr);
	 //document.getElementById("categories").value=myStr;

}
</script>
<script type='text/javascript'>
function uncheck_all(what)
{
    for (var i = 0; i<what.elements.length; i++) {
        if ((what.elements[i].name.indexOf('nodes') > -1)) {
            if (what.elements[i].checked) {
                 what.elements[i].checked = false;
            }
        }
    }
	// document.getElementById("categories").value='';
     $("#categories").val('');
     }
</script>

{/literal}
    </div>
     </td>
     </tr>
      <tr>
      <td class="right_td">
      Select Countries
      </td>
        <td class="left_td">
          <select name="country[]" id = "country" size="5" multiple="multiple"  >

          {if $vs_country}

                {section name=citm loop=$vs_country}
                {if $prev_country}
                    <option  value="{$vs_country[citm].iso}" {if in_array($vs_country[citm].iso,$prev_country)} selected="selected"{/if}>{$vs_country[citm].name}</option>
                {else}
                    <option  value="{$vs_country[citm].iso}">{$vs_country[citm].name}</option>
                {/if}
                {/section}

          {/if}
          </select>
	</td>
	</tr>
	<tr>
 <td class="right_td">
		Select States <Br>
	<small style="font-size:9px;">(For US Only)</small>
    </td>
    <td class="left_td">
		   <select id="intrested_states"  name="states">
            <option  value="0">Select State</option>
		{if $vs_states}

                {section name=sitm loop=$vs_states}

                    <option  value="{$vs_states[sitm].id}" {if $prev_states==$vs_states[sitm].id || $smarty.post.states==$vs_states[sitm].id}selected="selected"{/if}>{$vs_states[sitm].name}</option>

                {/section}

          {/if}


          </td>
         </tr>
         <tr>
         <td class="right_td">
		      Select Metro Area<br>
	           <small style="font-size:9px;">(For US Only)</small>
        </td>
            <td class="left_td" id="intrested_metro_area_box">
            {assign var="current_metro_area_list" value=$prev_metro_area_list}
            <select id="intrested_metro_area"  name="metro_area">
                <option value="">Select Metro Area</option>
                 {if $current_metro_area_list}
                    {section name=sitm loop=$current_metro_area_list}
                    <option  value="{$current_metro_area_list[sitm].metro_id}" {if  $current_metro_area_list[sitm].metro_id == $prev_metro_area ||  $current_metro_area_list[sitm].metro_id== $smarty.post.metro_area }selected="selected"{/if}>{$current_metro_area_list[sitm].metro_name}</option>
                    {/section}
                 {/if}
            </select>

         </td>
         </tr>
        <tr>
        <td colspan="2" align="center" class="bottom_line">
         <!-- Commneted Code
            <input type=submit name="save" value="Save"  onclick="cycleCheckboxes(this.form);" class="blackbutton" style="width:100px;" >  &nbsp;&nbsp;&nbsp;&nbsp;
            <input type=submit name="search"  value="Search Listing" class="blackbutton" style="width:100px;" > &nbsp;&nbsp;&nbsp;&nbsp;
         -->
            <input onclick="cycleCheckboxes(this.form); document.intersted_in_form.action ='intrested_in.php?show_type={$show_type}'" type="SUBMIT" value="Save" name="save"  class="blackbutton" style="width:120px;" />
            <input onclick="cycleCheckboxes(this.form); document.intersted_in_form.action ='search.php?sp={$isPromotions}'" name="mychoice_search" type="SUBMIT" value="Search {if $isPromotions == 1}Promotions{else}Listing{/if}" class="blackbutton" style="width:120px;"/>
           <input id="reset" type="button" value="Reset"   onclick="document.intersted_in_form.country.value='';document.intersted_in_form.states.value=0;document.intersted_in_form.metro_area.value='';document.intersted_in_form.categories.value='';uncheck_all(this.form);document.intersted_in_form.keywords.value='';document.intersted_in_form.business_title.value=''; " class="blackbutton" style="width:120px;"  />
           </font>
          </td>
         </tr>
         </table>
      </form>
