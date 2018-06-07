 
<div data-role="popup" id="popupAddFavorites" data-dismissible="false" data-overlay-theme="g" data-theme="a1" style="width:270px;">
<div data-role="header">
	<h1>{$_lang.tbl_cust_favorites.create_title}</h1>
</div>
<div data-role="content">
 
		<input maxlength="11" id="cust_fav_post_id" type="hidden" name="cust_fav_post_id"/>  
		 <input type="hidden"  name="cust_fav_post_type" id="cust_fav_post_type"/>   
	<div class="field-row">
		<label for="cust_fav_desc">{$_lang.tbl_cust_favorites.label.cust_fav_desc}</label>
		<textarea name="cust_fav_desc"  id="cust_fav_desc"></textarea>  
		<div class="error" id="cust_fav_desc_err"></div>
	</div> 
	<center><input data-inline="true" data-icon="save" type="button" onclick="saveCustFavorites();" value="{$_lang.save_lbl}"/> <input type="button" data-inline="true" data-icon="delete"  value="{$_lang.cancel_lbl}" onclick="$('#popupAddFavorites').popup('close');"/></center> 
	</div>
</div> 
 