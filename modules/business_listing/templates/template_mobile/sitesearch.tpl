{* Site Search *}
<div>
<form name="top_search" action="search.php" method="post">
    <table>
        <tr>
            <td><b style='font-size:10px;'>Keywords</b></td>
            <td><input type="hidden" name="sa" value="site">
                <input class="searchfield"  type="text" style="width:500px;" id="search_keywords" name="sk" value="{$search_key}"/>&nbsp;
            <td>
            <input type="radio" style='width:20px;' name="st" value="all" {if $search_type == "any"}checked{else}{/if}><b style='font-size:10px;'>All</b>
            </td>
            <td>
            <input type="radio" style='width:20px;' name="st" value="any" {if $search_type == "any"}{else}checked{/if}><b style='font-size:10px;'>Any</b>
            </td>
        </tr>
        <tr>
            <td><b style='font-size:10px;'>Search Location</b></td>
            <td><input type="checkbox" name="limit_range" id="limit_range" value="on" {if $limit_range == "on"}checked{else}{/if} style="width:20px;">&nbsp;within</td>
            <td><input type="text" id="search_range" name="search_range"style="width:30px;" value="{$search_range}">{lang->desc p1='sitesearch' p2=$lang_set p3='search_zip'}</td>
            <td><input type="text" id="search_zip" style="width:50px;" name="search_zip" size="8" value="{$search_zip}"></td>
        </tr>
    </table>
</form>
<table class="job_detail_view" style="width:900px;background:#E1F0FA;border:1px solid #fc6300;">
    <tr>
		<td id="blue_gradient_header" style="border-bottom:none;" colspan="2">
        <!--<div style="float:right;"><a href="#" style="color:black;font-weight:bold;text-decoration:none;" onclick="$('#search_top_form_box').slideUp();$('#search_top_form_link').show();" title="Hide Me"><img src="templates/{$deftpl}/images/close.png" border="0" alt="X"/></a></div>
-->
		</td>
	</tr>
	
	<tr >
		<td style="width:770px;border-bottom:none;">
            <table style="width:770px;border:none;">
				<tr>
					<td style="border-bottom:none;">
						{include file="$deftpl/search_form_part/keyword_row.tpl"}
					</td>
				</tr>
				<!--
                <tr>
					<td style="border-bottom:none;">
     						{include file="$deftpl/search_form_part/category_row.tpl"}
					</td>
				</tr>
				-->
				<tr>
					<td style="border-bottom:none;">
						{include file="$deftpl/search_form_part/city_row.tpl"}
					</td>
				</tr>
				<tr>
					<td style="border-bottom:none;">
						{include file="$deftpl/search_form_part/location_row.tpl"}
					</td>
				</tr>
			</table>
		</td>
		<td style="width:120px;border-bottom:none;">
        <center>
		 		<input class="blackbutton" onclick="return check_search_form_validation();" type="submit" style="width:100px;margin:3px;" name="sp" value="Find Deals">
        		<input class="blackbutton" onclick="return check_search_form_validation();" type="submit" style="width:100px;margin:3px;" name="sb" value="Find Listing">
				
				<div style="margin-top:30px;padding-right:10px;height:18px;text-align:right;">
                    <a href="#" style="font-weight:bold;font-size:10px;" name="resetsearch" title="Reset" onclick="clearForm();">Reset</a>
				</div>
        </center>
        		
     	</td>

	</tr>
	<tr>
		<td id="blue_gradient_footer" style="border-bottom:none;" colspan="2"></td>
	</tr>
</table>
</center>
</form>
</div>
{literal}
<script type="text/javascript">
    function clearForm(){
        //$("#search_states").val('');
        //$("#search_metro_area").val('');
        $('#search_keywords').val('');
        $("#search_zip").val('');
        $("#search_range").val('');
        $("#search_location").val('');
        //$("#country").val('');
        //$("#states").val('');
        $('#limit_range').removeAttr('checked');
        $("#categories").val('');
       /*
        var dd = $("#categories").mcDropdown("#categorymenu");
        dd.setValue('');
        $("#categories").val('');
        

		$('#category_span').html('');
		*/
		$('#searchform_categories').val('');
        $('#searchform_cat_list').val('');
        $('#searchform_cat_list').hide();

    }
    
    $('#search_states').change(function(){
        populateSearchLoc();
	});
	
	function populateSearchLoc(){
        if (document.getElementById('search_states').value > 0){
		document.getElementById('search_metro_area_box').innerHTML= '<select Disabled><option>Select Metro Area</option></select>';
		$.post("{/literal}{$website}{literal}/ajax/get_chid_categories.php",
            {
              parent_id: document.getElementById('search_states').value
            },
            function(response){
               finishAjax(escape(response), 'search_metro_area_box', 'metro_area','search_metro_area');
                //setTimeout("finishAjax('"+escape(response)+"', 'search_metro_area_box', 'metro_area','search_metro_area')", 200);
            }
        );
		return false;
        }else{
          alert ("Please Select State");
        }
    }
	
 	$(document).ready(function()
	{
		$('#search_keywords').focus();
	 	$("#search_keywords").alphanumeric({allow:", "});
        $("#search_zip").numeric();
        $("#search_range").numeric();
        $("#search_range").maxLength(3);
        $("#search_zip").maxLength(5);
		/*
	    $('#search_states').val("{/literal}{$vs_user_prof_state_id}{literal}");
        populateSearchLoc();
        $('#search_metro_area').val('{/literal}{$vs_user_prof_metro_area}{literal}');
		*/
	});

	function check_search_form_validation(){
       if (document.getElementById('search_metro_area').value == ""){
         alert("Please Select Metro Area");
         return false;
       }else{
          return true;
       }
    }
	</script>

{/literal}
