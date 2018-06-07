<div data-role="popup" id="popupRate" data-dismissible="false" data-overlay-theme="a" data-theme="a" style="width:250px;">
	<div data-role="header">
			<h1>{if $is_rated gt 0 && $rate_info}My Rating{else}Rate{/if}</h1>
	</div>
	
	<div data-role="content" style="padding:5px;">
	{if $is_rated gt 0 && $rate_info}
	 <div class="field-row">
	 	<!--
         <label>{$rate_info.recomm_title}</label>
		<p>{$rate_info.recomm_desc}</p>
		-->
		<p> <img src="{$website}/images/rating/{if $rate_info.recomm_rating}{$rate_info.recomm_rating}{else}0{/if}.gif"/></p>
	 </div>
	 <div class="biz_center">
			<input data-icon="delete" data-inline="true" type="button" onclick="$('#popupRate').popup('close');" value="{$_lang.close_lbl}"/>
	</div>
	
	{else}

	 <form name="frmcreatetbl_feedback" id="frmcreatetbl_feedback" onsubmit="return validatetbl_feedback();" method="POST" action="{$website}/user/tbl_feedback.php">
	<input type="hidden" name="id" id="id" value="0"/>
	<div style="display:none;" class="error" id="id_err"></div>
	
	<div style="display:none;">
		<label for="post_id">{$_lang.tbl_feedback.label.post_id}</label>
		<input type="text" name="post_id" id="post_id" value="{$tbl_submenu_dishesinfo.sbmnu_dish_id}"/>
		<div class="error" id="post_id_err"></div>

		<label for="post_title">{$_lang.tbl_feedback.label.post_title}</label>
		<input type="text" name="post_title" id="post_title" value="{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_name}"/>
		<div class="error" id="post_title_err"></div>

		<label for="post_type">{$_lang.tbl_feedback.label.post_type}</label>
		<input type="text" name="post_type" id="post_type" value="SubMenuDish"/>
		<div class="error" id="post_type_err"></div> 
	</div>	
	
	<div class="biz_hidden">
    	<label for="recomm_title">{$_lang.tbl_feedback.label.recomm_title}</label>
    	<input type="text" name="recomm_title" id="recomm_title" value="--"/>
    	<div class="error" id="recomm_title_err"></div>

    	<label for="recomm_desc">{$_lang.tbl_feedback.label.recomm_desc}</label>
    	<textarea name="recomm_desc" id="recomm_desc">--</textarea>
    	<div class="error" id="recomm_desc_err"></div>
    </div>
    
	<label for="recomm_rating">{$_lang.tbl_feedback.label.recomm_rating}*</label>
	<select name="recomm_rating" id="recomm_rating"> 
		{foreach $Enum_Overall_Rating as $val}
			<option value="{$val@key}" {if $smarty.post.recomm_rating eq $val@key}selected="selected"{/if}>{$val}</option>
		{/foreach}
	</select>
	
	<div class="error" id="recomm_rating_err"></div> 
		<input type="hidden" name="recomm_QOS_rating" id="recomm_QOS_rating" value="0"/>
	<div class="error" id="recomm_QOS_rating_err"></div>
 
	<input type="hidden" name="recomm_QOF_rating" id="recomm_QOF_rating" value="0"/>
	 
	<div class="error" id="recomm_QOF_rating_err"></div>
 
	<input type="hidden" name="recomm_ambience_rating" id="recomm_ambience_rating" value="0"/>
	<div class="error" id="recomm_ambience_rating_err"></div>
	
	<label for="recomm_title">Email</label>
	<input type="text" name="cust_user_name" id="cust_user_name" value="{if $Global_member.email}{$Global_member.email}{elseif $smarty.session[$smarty.const.SES_CUST_NM] neq 'guest_user'}{$smarty.session[$smarty.const.SES_CUST_NM]}{else}{$smarty.post.cust_user_name}{/if}" />
	<div class="error" id="user_name_err"></div>

	<label for="recomm_title">Phone</label>
	<input type="text" name="cust_user_phone" id="cust_user_phone" value="{if $Global_member.staff_phone}{$Global_member.staff_phone}{else}{$smarty.post.cust_user_phone}{/if}"/>
	<div class="error" id="user_phone_err"></div>

	<div class="info">{$_lang.tbl_complaints.info_msg.complnt_phone_email}</div>
    <br>
	 
	<div class="biz_center">
		<input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
		{html_input type="hidden" name="redirect_type" value="submenu_dish"}
		{html_input type="hidden" name="redirect_value" value="{$tbl_submenu_dishesinfo.sbmnu_dish_id}"}
		<input data-icon="save" data-inline="true" type="submit"  value="{$_lang.tbl_feedback.new_btn_lbl}"/>
		 
		<input data-icon="delete" data-inline="true" type="button" onclick="$('#popupRate').popup('close');" value="{$_lang.close_lbl}"/> 
	   
	</div>
	
	</form> 
 	{/if}
	</div>
</div>
