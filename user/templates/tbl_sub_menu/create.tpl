{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_sub_menu.create_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmcreatetbl_sub_menu" id="frmcreatetbl_sub_menu" onsubmit="return validatetbl_sub_menu();" method="POST" action="{$page_url}">	<input type="hidden" name="submnu_id" id="submnu_id" value="0"/>	<div style="display:none;" class="error" id="submnu_id_err"></div>	<div class="field-row">		<label for="submnu_name">{$_lang.tbl_sub_menu.label.submnu_name}</label>		<input type="text" name="submnu_name" id="submnu_name" value="{$smarty.post.submnu_name}"/>		<div class="error" id="submnu_name_err"></div>	</div>	<div class="field-row">		<label for="submnu_menu">{$_lang.tbl_sub_menu.label.submnu_menu}</label>		 		<select name="submnu_menu" id="submnu_menu">		{assign var="option_caption" value=$_lang.tbl_sub_menu.label.select_submnu_menu} 		{assign var="options" value=$menuList}		{assign var="option_selected" value=$smarty.post.submnu_menu}		{include file="control/optionlist.tpl"} 		</select>		<div class="error" id="submnu_menu_err"></div>	</div>	<div class="field-row">		<label for="submnu_description">{$_lang.tbl_sub_menu.label.submnu_description}</label>		<textarea name="submnu_description" id="submnu_description">{$smarty.post.submnu_description}</textarea>		<div class="error" id="submnu_description_err"></div>	</div>	<div class="field-row">		<label for="submnu_spl_note">{$_lang.tbl_sub_menu.label.submnu_spl_note}</label> 		<textarea name="submnu_spl_note" id="submnu_spl_note">{$smarty.post.submnu_spl_note}</textarea>		<div class="error" id="submnu_spl_note_err"></div>	</div>	<!--	<div class="field-row">		<label for="submnu_start_date">{$_lang.tbl_sub_menu.label.submnu_start_date}</label>		<input type="text" name="submnu_start_date" id="submnu_start_date" value="{$smarty.post.submnu_start_date}"/>		<div class="error" id="submnu_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="submnu_end_date">{$_lang.tbl_sub_menu.label.submnu_end_date}</label>		<input type="text" name="submnu_end_date" id="submnu_end_date" value="{$smarty.post.submnu_end_date}"/>		<div class="error" id="submnu_end_date_err"></div>	</div>	--><center>	<input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>	</center></form>{include file="tbl_sub_menu/js.tpl"}</div>{include file="footer.tpl"}