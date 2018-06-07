<div data-role="page" id="promotions">
 {include file="$deftpl/list/header.tpl"}
	<div data-role="content">	   
	   
	   {if $user_promotion}
        {section name=pitm loop=$user_promotion}
              &bull;&nbsp;<a href="{$list_link}#promotion{$user_promotion[pitm].id}" data-iconpos="top" rel="external">{$user_promotion[pitm].title}</a><br>
        {/section}
	   {else}
	   	No Promotions Posted
       {/if} 
	 </div>
  {include file="$deftpl/list/footer.tpl"}
 </div>