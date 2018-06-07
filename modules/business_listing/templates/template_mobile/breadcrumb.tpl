{if $smarty.request.web_redt and $smarty.request.web_redt eq 1}
{else}
<div class="biz_breadcrumbs">
{if $sesslife}
 {if $Global_member.member_role_id eq $smarty.const.ROLE_CUSTOMER}
 	<a href="{$website}/user/dashboard.php"> {$_lang.main.landing_page_title}</a>
 {else}
 	<a href="{$website}">{$_lang.main.landing_page_title}</a>
 {/if} 
{else}
	{if $smarty.session[$smarty.const.SES_TABLE] gt 0}
		<a href="{$website}/user/dashboard.php">{$_lang.main.landing_page_title}</a>
	{else}
		<a href="{$website}">{$_lang.main.landing_page_title}</a>
	{/if}	
{/if}    
  	{if $breadcrumbs}
		{foreach  $breadcrumbs as $crumb}
		<span class="bigSymbol">&raquo;</span>
		{if $crumb.link|strlen gt 0}
			<a href="{$crumb.link}" rel="external" data-ajax="false">{$crumb.title}</a>
		{else}
			<b>{$crumb.title}</b>
		{/if} 
		{/foreach} 
	{/if} 
	<!--<button onclick="location.href='{$page_url}'" data-icon="arrow-r">{if $page_title neq ""}{$page_title}{else}Home{/if}</button>-->
</div> 
{/if}
