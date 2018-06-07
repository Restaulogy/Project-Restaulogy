{include file="$deftpl/header.tpl"}
 <div data-role="page" id="set_filter">
    <div data-role="header">

		<h4>Set Alert</h4>
	</div>

	<div data-role="content">
  {if $msgs != ""}
      {$msgs}
  {/if}
    {if $notice != ""}
    	<div class="fail">
        	{$notice}
        </div><br />
	{/if}
{if $operation != ""}
    	<div class="approved">
        	{$operation}
        </div><br />
{/if}

        <form id="intersted_in_form" name="intersted_in_form" method="post" action="filter.php" data-ajax="false" onsubmit="return chk_filter();">
    <div class="extra_info" style="text-align:left;">

*Fill Your Filter Criteria To Find Your Type Of Promotions
</div>
    <table class="job_detail_panal_table">
         <tr>
             {if $interested_ppl.id}
	          	<th colspan="2">Update Criteria</th>
			 {else}
			    <th colspan="2">Insert Criteria</th>
	         {/if}

		 </tr>
		 <tr>
		    <td class="detail_right_td">Title
		    </td>
            <td class="detail_left_td">
			<input type="text" name="title" id="filter_title" value="{if $interested_ppl.title}{$interested_ppl.title}{else}{$smarty.post.title}{/if}" />
		    </td>
		 </tr>
		 <tr>
		    <td class="detail_right_td">Keywords
		    </td>
            <td class="detail_left_td">
			<input type="text" name="keywords" id="filter_keywords" value="{if $interested_ppl.keywords}{$interested_ppl.keywords}{else}{$smarty.post.keywords}{/if}" />
		    </td>
		 </tr>
		 <tr>
		    <td class="detail_right_td">Business Title
		    </td>
            <td class="detail_left_td">
			<input type="text" name="business_title" id="business_title" value="{if $interested_ppl.business_title}{$interested_ppl.business_title}{else}{$smarty.post.business_title}{/if}" />
		    </td>
		 </tr>
         <tr>
         <td class="detail_right_td">
             Select Categories
         </td>
         <td class="detail_left_td">
                       <a href="#" data-role="button"  onclick='show_category_dialog("my_categories","my_cat_list", ",");' style="height:90%;width:50%;"  value="Save" name="filter_save"    data-inline="true" data-theme="a">...</a>

        </td>
     </tr>
     <tr>
	 	<td colspan="2">
            {if $interested_ppl.list_categories|strlen eq 0}
                    {assign var="cat_display" value="none"}
                {else}
                    {assign var="cat_display" value="block"}
                {/if}
                   <textarea id="my_cat_list" name="my_cat_list" style='display:{$cat_display};height:20px;width:95%;background:transparent !important;border:none !important; height:28px !important;' READONLY>{if $interested_ppl.list_categories}{$interested_ppl.list_categories}{else}{$smarty.post.my_cat_list}{/if}</textarea>
                   <input type="text" name="categories" id="my_categories" style="display:none;" value ="{if $interested_ppl.categories_str}{$interested_ppl.categories_str}{else}{$smarty.post.categories}{/if}"/>
		 </td>
	 </tr>
	<tr>
 <td class="detail_right_td">
		Select States <Br>
	<small style="font-size:9px;">(For US Only)</small>
    </td>
    <td class="detail_left_td">
        <div style="width:170px;">
		   <select id="intrested_states"  name="states">
            <option  value="0">Select State</option>
		 {if $current_states_list}

                {section name=sitm loop=$current_states_list}

                    <option  value="{$current_states_list[sitm].id}" {if $interested_ppl.states==$current_states_list[sitm].id || $smarty.post.states==$current_states_list[sitm].id}selected="selected"{/if}>{$current_states_list[sitm].name}</option>

                {/section}

          {/if}
          </select>
          </div>
          </td>
         </tr>
         <tr>
         <td class="detail_right_td" style="border-bottom:none;">
		      Select Metro Area<br>
	           <small style="font-size:9px;">(For US Only)</small>
        </td>
            <td class="detail_left_td" id="intrested_metro_area_box" style="border-bottom:none;">
            <div style="width:170px;">
            {assign var="current_metro_area_list" value=$interested_ppl.metro_area_list}
            <select id="intrested_metro_area"  name="metro_area">
                <option value="">Select Metro Area</option>
                 {if $current_metro_area_list}
                    {section name=sitm loop=$current_metro_area_list}
                        <option  value="{$current_metro_area_list[sitm].metro_id}" {if  $current_metro_area_list[sitm].metro_id == $interested_ppl.metro_area ||  $current_metro_area_list[sitm].metro_id== $smarty.post.metro_area }selected="selected"{/if}>{$current_metro_area_list[sitm].metro_name}</option>
                    {/section}
                 {/if}
            </select>
            </div>
         </td>
         </tr>
        <tr>
        <td colspan="2" align="center" class="bottom_line">
            <input type="hidden" name="show_type" value="{$show_type}"/>
            <input type="hidden" name="id" value="{$interested_ppl.id}"/>
            <center>
           <input type="submit" data-icon="save"  value="Save" name="filter_save"  data-inline="true" data-theme="a" value="Save"/>
           <input type="button" data-icon="back"  id="reset" value="Reset" onclick="filter_reset();" data-inline="true" data-theme="a"/>
        </center>

          </td>
         </tr>
         </table>

 {literal}
	<script type="text/javascript">
			function filter_reset(){
/*					document.forms.intersted_in_form.states.value=0;
					document.forms.intersted_in_form.metro_area.value='';
					document.forms.intersted_in_form.keywords.value='';
					document.forms.intersted_in_form.business_title.value='';
					document.forms.intersted_in_form.my_cat_list.innerHTML = '';*/
				/*	document.forms.intersted_in_form.keywords.value='';
					document.forms.intersted_in_form.business_title.value='';
					//document.forms.intersted_in_form.states.value=0;
					$('#set_filter #intrested_states').val(0);
					 $('#set_filter #intrested_states').selectmenu('refresh', true);
                     $('#set_filter #intrested_metro_area').empty();
                     $('#set_filter #intrested_metro_area').html('<option value="">Select Metro Area</option>');
					 $('#set_filter #intrested_metro_area').selectmenu('refresh', true);
				 	document.forms.intersted_in_form.my_categories.value='';
					document.forms.intersted_in_form.my_cat_list.innerHTML = '';*/
                     $('#set_filter #filter_title').val('');
                     $('#set_filter #filter_keywords').val('');
                     $('#set_filter #business_title').val('');
                     $('#set_filter #intrested_states').val(0);
					 $('#set_filter #intrested_states').selectmenu('refresh', true);
                     $('#set_filter #intrested_metro_area').empty();
                     $('#set_filter #intrested_metro_area').html('<option value="">Select Metro Area</option>');
					 $('#set_filter #intrested_metro_area').selectmenu('refresh', true);
					 $('#set_filter #my_categories').val('');
	                 $('#set_filter #my_cat_list').html('');
    	 			$('#set_filter #my_cat_list').hide();
 	   			}

        function chk_filter(){
         var vtitle = $("#set_filter #filter_title").val();

            if(vtitle == ""){
                alert("Please Enter title");
                return false;
           }else{
              return true;
           }

        }

  $('#intrested_states').change(function(){
        change_metro_area_by_state('intrested_states','intrested_metro_area');
    });
 </script>
 {/literal}
	</div><!--Content-->

   <div data-role="footer">
             <center>
        <a href="#" onclick="self.close();" data-role="button" data-icon="delete">Close</a>   </center>
	</div><!--footer-->
   </form>
</div><!--Page-->

{include file="$deftpl/sitefoot.tpl"}
