{* Sub List Membership Default *}


{if $ispromotion eq 1}

 {if $ishistory eq 1}

 {else}
	{assign var=user_promotion value=$list[itm].user_promotion}
	{section name=pitm  loop=$user_promotion}
        {assign var="isuser" value=1}
        {include file="$deftpl/sublist/promotion_part.tpl"}
	{/section}
 {/if}

{else}
{include file="$deftpl/sublist/user_part.tpl"}
{/if}
