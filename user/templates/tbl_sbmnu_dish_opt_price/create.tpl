{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_sbmnu_dish_opt_price.create_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmcreatetbl_sbmnu_dish_opt_price" id="frmcreatetbl_sbmnu_dish_opt_price" onsubmit="return validatetbl_sbmnu_dish_opt_price();" method="POST" action="{$page_url}">	<input type="hidden" name="sbmdopt_pr_id" id="sbmdopt_pr_id" value="0"/>	<div style="display:none;" class="error" id="sbmdopt_pr_id_err"></div>	<div class="field-row">		<label for="sbmdopt_pr_sbmnu_dish">{$_lang.tbl_sbmnu_dish_opt_price.label.sbmdopt_pr_sbmnu_dish}</label>		<input type="text" name="sbmdopt_pr_sbmnu_dish" id="sbmdopt_pr_sbmnu_dish" value="{$smarty.post.sbmdopt_pr_sbmnu_dish}"/>		<div class="error" id="sbmdopt_pr_sbmnu_dish_err"></div>	</div>	<div class="field-row">		<label for="sbmdopt_pr_option_value">{$_lang.tbl_sbmnu_dish_opt_price.label.sbmdopt_pr_option_value}</label>		<input type="text" name="sbmdopt_pr_option_value" id="sbmdopt_pr_option_value" value="{$smarty.post.sbmdopt_pr_option_value}"/>		<div class="error" id="sbmdopt_pr_option_value_err"></div>	</div>	<div class="field-row">		<label for="sbmdopt_pr_price">{$_lang.tbl_sbmnu_dish_opt_price.label.sbmdopt_pr_price}</label>		<input type="text" name="sbmdopt_pr_price" id="sbmdopt_pr_price" value="{$smarty.post.sbmdopt_pr_price}"/>		<div class="error" id="sbmdopt_pr_price_err"></div>	</div>	<input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input class="fleft" type="submit" value="{$_lang.save_lbl}"/> <input  class="fright" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></form>{include file="tbl_sbmnu_dish_opt_price/js.tpl"}</div>{include file="footer.tpl"}