{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_rest_groups.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_rest_groups" id="frmcreatetbl_rest_groups" onsubmit="return validatetbl_rest_groups();" method="POST" action="{$page_url}">
	<input type="hidden" name="rstgrp_id" id="rstgrp_id" value="0"/>
	<div style="display:none;" class="error" id="rstgrp_id_err"></div>

	<div class="field-row">
		<label for="rstgrp_group">{$_lang.tbl_rest_groups.label.rstgrp_group}</label>
		<input id="rstgrp_group" type="text" value="{$smarty.post.rstgrp_group}" name="rstgrp_group"/> 
		<div class="error" id="rstgrp_group_err"></div>
	</div>

	<div class="field-row">
		<label for="rstgrp_desc">{$_lang.tbl_rest_groups.label.rstgrp_desc}</label>
		<textarea name="rstgrp_desc"  id="rstgrp_desc">{$smarty.post.rstgrp_desc}</textarea> 

		<div class="error" id="rstgrp_desc_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="rstgrp_start_date">{$_lang.tbl_rest_groups.label.rstgrp_start_date}</label>
		<input  id="rstgrp_start_date" type="text" value="{$smarty.post.rstgrp_start_date}" name="rstgrp_start_date"/> 
		<div class="error" id="rstgrp_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="rstgrp_end_date">{$_lang.tbl_rest_groups.label.rstgrp_end_date}</label>
		<input  id="rstgrp_end_date" type="text" value="{$smarty.post.rstgrp_end_date}" name="rstgrp_end_date"/> 
		<div class="error" id="rstgrp_end_date_err"></div>
	</div>
	-->

	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="button" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center>
</form>
{include file="tbl_rest_groups/js.tpl"}

</div>

{include file="footer.tpl"}

