{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_restaurent.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}
 
<form id="frmRedirectRegister" method="POST" action="register.php">
	<input type="hidden" name="isManager" value="1">
	<input type="hidden" name="restaurant" value="{$restaurant_id}"/>
</form>
<a href="#" onclick="elemById('frmRedirectRegister').submit();">{$_lang.tbl_restaurent.create_manager_link}</a>


</div>

{include file="footer.tpl"}