{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_role_functionality.create_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmcreatetbl_role_functionality" id="frmcreatetbl_role_functionality" onsubmit="return validatetbl_role_functionality();" method="POST" action="{$page_url}">	<input type="hidden" name="Array" id="Array" value="0"/>	<div style="display:none;" class="error" id="Array_err"></div>	<div class="field-row">		<label for="rl_fn_role">{$_lang.tbl_role_functionality.label.rl_fn_role}</label>		<input maxlength="11" id="rl_fn_role" type="text" value="{$smarty.post.rl_fn_role}" name="rl_fn_role"/> 		<div class="error" id="rl_fn_role_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_tablests_live">{$_lang.tbl_role_functionality.label.rl_fn_tablests_live}</label>		<input maxlength="1" id="rl_fn_tablests_live" type="text" value="{$smarty.post.rl_fn_tablests_live}" name="rl_fn_tablests_live"/> 		<div class="error" id="rl_fn_tablests_live_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_tablests_expired">{$_lang.tbl_role_functionality.label.rl_fn_tablests_expired}</label>		<input maxlength="1" id="rl_fn_tablests_expired" type="text" value="{$smarty.post.rl_fn_tablests_expired}" name="rl_fn_tablests_expired"/> 		<div class="error" id="rl_fn_tablests_expired_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_request_live">{$_lang.tbl_role_functionality.label.rl_fn_request_live}</label>		<input maxlength="1" id="rl_fn_request_live" type="text" value="{$smarty.post.rl_fn_request_live}" name="rl_fn_request_live"/> 		<div class="error" id="rl_fn_request_live_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_request_expired">{$_lang.tbl_role_functionality.label.rl_fn_request_expired}</label>		<input maxlength="1" id="rl_fn_request_expired" type="text" value="{$smarty.post.rl_fn_request_expired}" name="rl_fn_request_expired"/> 		<div class="error" id="rl_fn_request_expired_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_order_live">{$_lang.tbl_role_functionality.label.rl_fn_order_live}</label>		<input maxlength="1" id="rl_fn_order_live" type="text" value="{$smarty.post.rl_fn_order_live}" name="rl_fn_order_live"/> 		<div class="error" id="rl_fn_order_live_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_order_expired">{$_lang.tbl_role_functionality.label.rl_fn_order_expired}</label>		<input maxlength="1" id="rl_fn_order_expired" type="text" value="{$smarty.post.rl_fn_order_expired}" name="rl_fn_order_expired"/> 		<div class="error" id="rl_fn_order_expired_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_promotion_live">{$_lang.tbl_role_functionality.label.rl_fn_promotion_live}</label>		<input maxlength="1" id="rl_fn_promotion_live" type="text" value="{$smarty.post.rl_fn_promotion_live}" name="rl_fn_promotion_live"/> 		<div class="error" id="rl_fn_promotion_live_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_promotion_expired">{$_lang.tbl_role_functionality.label.rl_fn_promotion_expired}</label>		<input maxlength="1" id="rl_fn_promotion_expired" type="text" value="{$smarty.post.rl_fn_promotion_expired}" name="rl_fn_promotion_expired"/> 		<div class="error" id="rl_fn_promotion_expired_err"></div>	</div>	<div class="field-row">		<label for="rl_fn_payment_process">{$_lang.tbl_role_functionality.label.rl_fn_payment_process}</label>		<input maxlength="1" id="rl_fn_payment_process" type="text" value="{$smarty.post.rl_fn_payment_process}" name="rl_fn_payment_process"/> 		<div class="error" id="rl_fn_payment_process_err"></div>	</div>	<!--	<div class="field-row">		<label for="rl_fn_start_date">{$_lang.tbl_role_functionality.label.rl_fn_start_date}</label>		<input  id="rl_fn_start_date" type="text" value="{$smarty.post.rl_fn_start_date}" name="rl_fn_start_date"/> 		<div class="error" id="rl_fn_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="rl_fn_end_date">{$_lang.tbl_role_functionality.label.rl_fn_end_date}</label>		<input  id="rl_fn_end_date" type="text" value="{$smarty.post.rl_fn_end_date}" name="rl_fn_end_date"/> 		<div class="error" id="rl_fn_end_date_err"></div>	</div>	-->	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center></form>{include file="tbl_role_functionality/js.tpl"}</div>{include file="footer.tpl"}