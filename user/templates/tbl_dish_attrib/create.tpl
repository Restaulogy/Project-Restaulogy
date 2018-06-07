{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_dish_attrib.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_dish_attrib" id="frmcreatetbl_dish_attrib" onsubmit="return validatetbl_dish_attrib();" method="POST" action="{$page_url}" enctype="multipart/form-data">
	<input type="hidden" name="dish_attrib_id" id="dish_attrib_id" value="0"/>
	<div style="display:none;" class="error" id="dish_attrib_id_err"></div>

	<div class="field-row">
		<label for="dish_attrib_name">{$_lang.tbl_dish_attrib.label.dish_attrib_name}</label>
		<input maxlength="200" id="dish_attrib_name" type="text" value="{$smarty.post.dish_attrib_name}" name="dish_attrib_name"/> 
		<div class="error" id="dish_attrib_name_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_attrib_desc">{$_lang.tbl_dish_attrib.label.dish_attrib_desc}</label>
		<textarea name="dish_attrib_desc" id="dish_attrib_desc">{$smarty.post.dish_attrib_desc}</textarea>

		<div class="error" id="dish_attrib_desc_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_attrib_img">{$_lang.tbl_dish_attrib.label.dish_attrib_img}</label>
		<input type="file" name="dish_attrib_img" id="dish_attrib_img" value="{$smarty.post.dish_attrib_img}"/>

		<div class="error" id="dish_attrib_img_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="dish_attrib_start_date">{$_lang.tbl_dish_attrib.label.dish_attrib_start_date}</label>
		<input  id="dish_attrib_start_date" type="text" value="{$smarty.post.dish_attrib_start_date}" name="dish_attrib_start_date"/> 
		<div class="error" id="dish_attrib_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="dish_attrib_end_date">{$_lang.tbl_dish_attrib.label.dish_attrib_end_date}</label>
		<input  id="dish_attrib_end_date" type="text" value="{$smarty.post.dish_attrib_end_date}" name="dish_attrib_end_date"/> 
		<div class="error" id="dish_attrib_end_date_err"></div>
	</div>
	-->

	<div class="biz_center">
    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
    <input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/>
    <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>
    </div>
</form>
{include file="tbl_dish_attrib/js.tpl"}

</div>

{include file="footer.tpl"}


