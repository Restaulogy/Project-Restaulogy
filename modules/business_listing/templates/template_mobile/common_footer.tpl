<div data-role="footer"  data-position="fixed">
	<footer>{$webtitle} &copy; All rights Reseved</footer>
</div>
{if $sesslife eq false}
	{include file="$deftpl/ask_cust_nm.tpl"}
{/if}

{include file="$deftpl/flash_messages.tpl"}
<div data-role="panel" id="mypanel" data-position="left" data-display="push" data-content-theme="f" class="panel_bg">
            <!-- panel content goes here -->
    {include file="$deftpl/navbar.tpl"}
</div><!-- /panel --> 
 