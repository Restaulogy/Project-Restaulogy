<div data-role="popup" id="popupOrderRate" data-dismissible="false" data-overlay-theme="g" data-theme="a" style="width:250px;">
	<div data-role="header">
			<h1>{if $is_rated gt 0 && $rate_info}My Rating{else}Rate{/if}</h1>
	</div>
	<div data-role="content" style="padding:5px;">
	 
	{if $tmporder_details}
	 <form name="frmcreatetbl_feedback" id="frmcreatetbl_feedback" onsubmit="return validatebulk_feedback();" method="POST" action="{$website}/user/tbl_feedback.php">
 
	<div style="display:none;"> 

	<label for="post_type">{$_lang.tbl_feedback.label.post_type}</label>
	<input type="text" name="post_type" id="post_type" value="SubMenuDish"/>
	<div class="error" id="post_type_err"></div> 
	</div>
	{assign var='ordered_dish_items' value="0"}
	<table class="biz_data_grid">
	  <tr>
			<th>Item</th>
			<th>{$_lang.tbl_feedback.label.recomm_rating}</th>
		</tr>
		{foreach from=$tmporder_details item=ord_detail} 
		{cycle assign=vcycle values="odd,even"}
		<tr class="{$vcycle}"> 
			<td>
				{$ord_detail.title}
				{if $ord_detail.rate gt 0}{else}
				<input type="hidden" name="post_id[]" id="post_id{$ord_detail.submenu_dish}" value="{$ord_detail.submenu_dish}"/>
				<input type="hidden" name="post_title[]" id="post_title{$ord_detail.submenu_dish}" value="{$ord_detail.title}"/>
				{/if}
			</td>
			<td>
				{if $ord_detail.rate gt 0}
					<img src="{$website}/images/rating/{$ord_detail.rate}.gif"/>
				{else}
				{math assign='ordered_dish_items' equation='x + 1' x=$ordered_dish_items}
				<select data-mini="true" name="recomm_rating[]" id="recomm_rating{$ord_detail.submenu_dish}"> 
					{foreach $Enum_Overall_Rating as $val}
						<option value="{$val@key}" {if $smarty.post.recomm_rating eq $val@key}selected="selected"{/if}>{$val}</option>
					{/foreach}
				</select>
				{/if}
			</td>
		</tr>
		<tr class="{$vcycle}"> 
			<td colspan="2">
				<div id="recomm_rating_err{$ord_detail.submenu_dish}" class="error"></div>
			</td>
		</tr>
		{/foreach}
	</table>
	{if $ordered_dish_items gt 0}
	<label for="recomm_title">{$_lang.tbl_feedback.label.recomm_title}</label>
	<input type="text" name="recomm_title" id="recomm_title" value="{$smarty.post.recomm_title}"/>
	<div class="error" id="recomm_title_err"></div>

	<label for="recomm_desc">{$_lang.tbl_feedback.label.recomm_desc}</label>
	<textarea name="recomm_desc" id="recomm_desc">{$smarty.post.recomm_desc}</textarea>
	<div class="error" id="recomm_desc_err"></div> 
		<input type="hidden" name="recomm_QOS_rating" id="recomm_QOS_rating" value="0"/>
	<div class="error" id="recomm_QOS_rating_err"></div>
 
	<input type="hidden" name="recomm_QOF_rating" id="recomm_QOF_rating" value="0"/>
	 
	<div class="error" id="recomm_QOF_rating_err"></div>
 
	<input type="hidden" name="recomm_ambience_rating" id="recomm_ambience_rating" value="0"/>
	<div class="error" id="recomm_ambience_rating_err"></div>
	{/if} 
	<div class="biz_center">
	 {if $ordered_dish_items gt 0}
		<input type="hidden" id="action" name="action" value="BULK_CREATE"/>
		<input data-icon="save" data-inline="true" type="submit"  value="{$_lang.tbl_feedback.new_btn_lbl}"/>
	 {/if}
		<input data-icon="delete" data-inline="true" type="button" onclick="$('#popupOrderRate').popup('close');" value="{$_lang.close_lbl}"/> 
	   
	</div>
	
	</form>
	{/if} 
	</div>
</div>


{literal}
<script type="text/javascript">
	function validatebulk_feedback(){ 
	$("#recomm_title_err").html("");
	$("#recomm_desc_err").html("");
	$("#recomm_rating_err").html("");  
	var isErr = true;
  $("input[name='post_id[]']").each(function(){ 
		$("#recomm_rating_err" + this.value ).html(""); 
	});  
	
	
	if(IsNonEmpty(elemById("post_type").value)==false){
		$("#post_type_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.post_type}{literal}");
		isErr = false;
	}
 
	if(IsNonEmpty(elemById("recomm_title").value)==false){
		$("#recomm_title_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_title}{literal}");
		isErr = false;
	}
	if(IsNonEmpty($("#recomm_desc").val())==false){
		$("#recomm_desc_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_desc}{literal}");
		isErr = false;
	}
	 
	$("input[name='post_id[]']").each(function(){
    if(is_gt_zero_num(elemById("recomm_rating" + this.value ).value)==false){
		$("#recomm_rating_err" + this.value ).html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_rating}{literal}");
		isErr = false;
	} 
	}); 
	//isErr = false;
	/*if(is_gt_zero_num(elemById("recomm_rating").value)==false){
		$("#recomm_rating_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_rating}{literal}");
		isErr = false;
	}*/
 
 
	if(isErr == false){
		alert("{/literal}{$_lang.messages.revise_form}{literal}");
	}
	return isErr;
} 
	
</script>
{/literal}

