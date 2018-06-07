<!--
<div id="search" style="width:270px;" data-theme="a1" data-overlay-theme="g">
    <div data-role="header">
		<h4>Search <a class="fleft" href="#" onclick="$('#search').popup('close');" data-role="button" data-iconpos="notext" data-icon="delete"></a></h4>
	</div>
	<div data-role="content" style="padding:5px;">
-->

<div id="search" class="white_border" style="display:none;">
<h1 class="panel_bg">Search</h1>
	{literal}
        <script type="text/javascript">
        function frm_checkemail(str){
            var testresults;
            if((str) && (str!="")){
                //var str=document.validation.emailcheck.value
                var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                if (filter.test(str))
                    testresults=true;
                else{
                    alert("Please input a valid email address!");
                    testresults=false;
                }
            }else{
				
              testresults=true;
            }
			if(testresults){
				 
			  $("#frm_coupon_statistics").submit();
			}

            return (testresults);
        }
        </script>
       {/literal}
       
<form action="{$sorting_url}" method="POST" name="frm_coupon_statistics" id="frm_coupon_statistics" onsubmit="return comparedate();">
<div class="field-row">
	<label>Customer</label>
	<input type="text" value="{if $smarty.request.search_customer}{$smarty.request.search_customer}{else}{/if}" name="search_customer" id="search_customer"/>
</div> 
<div class="field-row">
	<label>Table</label> 
	<select name="search_table" id="search_table">
	 <option value="">Please Select Table</option>
	 {foreach $lst_tables as $table}
		<option value="{$table@key}" {if $smarty.request.search_table eq  $table@key}selected="selected"{/if}>{$table}</option>
	 {/foreach}
	</select>
</div> 
<div class="field-row">
	<label>Server</label> 
	<select name="search_employee" id="search_employee">
	 <option value="">Please Select Server</option>
	 {foreach $lst_servers as $server}
		<option value="{$server@key}" {if $smarty.request.search_employee eq  $server@key}selected="selected"{/if}>{$server}</option>
	 {/foreach}
	</select>
</div> 

<div class="field-row">
	<label>Promotion</label> 
	<select name="promotion_id" id="promotion_id">
	 <option value="">Please Select Promotion</option>
	 {foreach $lst_promotions as $promotion}
		<option value="{$promotion@key}" {if $promotion_id eq $promotion@key}selected="selected"{/if}>{$promotion}</option>
	 {/foreach}
	</select>
</div> 

<div class="field-row">
	<label>Date Range</label>
    <table>
        <tr>
			<td style="width:48%;"><input type="text" id='start_date' placeholder="Start Date" name='start_date' value='{if $start_date}{$start_date}{elseif $smarty.post.start_date}{$smarty.post.start_date}{/if}'/></td>
			<td style="width:4%;">&nbsp;</td>
			<td style="width:48%;"><input type='text' placeholder="End Date"  id='end_date' name='end_date' value='{if $end_date}{$end_date}{elseif $smarty.post.end_date}{$smarty.post.end_date}{/if}'/> </td>
		</tr>
		<tr>
			<td class="error" id="start_date_err"></td>
			<td></td>
			<td class="error" id="end_date_err"></td>
		</tr>
    </table>
</div>


<div class="biz_center"> 
	<input data-inline="true" data-icon="search" type="submit" name="search" value="Search"/> 
	<input  data-inline="true" data-icon="delete" id="reset"  type="button" onclick='$("#promotion_id, #search_employee, #search_table").val("").selectmenu("refresh");$("#search_customer").val("");document.forms["frm_coupon_statistics"].submit();' value="Reset" data-theme="a" data-inline="true"/>

</div>
</form>
		
   <!-- </div>--content-->
</div><!--dialog-->
