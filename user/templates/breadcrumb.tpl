
<div class="biz_breadcrumbs">
{* if $smarty.request.web_redt and $smarty.request.web_redt eq 1 *}
{if $smarty.session[$smarty.const.SES_ONLINE_STORE] gt 0}
    <a href="{$website}/user/tbl_menu.php?is_preview=1" >{$_lang.main.landing_page_title}</a>
{else}
    {if $sesslife}
         {if $Global_member.member_role_id eq $smarty.const.ROLE_CUSTOMER}
         	<a href="{$website}/user/dashboard.php">{$_lang.main.landing_page_title}</a>
         {else}
         	<a href="{$website}">{$_lang.main.landing_page_title}</a>
         {/if}
    {else}
    	{if $smarty.session[$smarty.const.SES_TABLE] gt 0}
    		<a href="{$website}/user/dashboard.php" >{$_lang.main.landing_page_title}</a>
    		<!--
    		{if $isCustomer}
    	     	{if $custTableInfo}<a href="{$website}/user/dashboard.php">{$custTableInfo.table_number}</a>
    	     	{/if}
    		{/if}
    		-->
    	{else}
    		<a href="{$website}" >{$_lang.main.landing_page_title}</a>
    	{/if}
    {/if}
    
{/if}
  	{if $breadcrumbs}
		{foreach $breadcrumbs as $crumb}
		<span class="bigSymbol">&raquo;</span><a href="{$crumb.link}">{$crumb.title}</a>
		{/foreach} 
	{/if} 
	<!--<button onclick="location.href='{$page_url}'" data-icon="arrow-r">{if $page_title neq ""}{$page_title}{else}Home{/if}</button>-->
</div> 

