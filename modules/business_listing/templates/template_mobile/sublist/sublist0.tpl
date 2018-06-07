

{if $ispromotion eq 1}

{assign var=user_promotion value=$list[itm].user_promotion}
{section name=pitm  loop=$user_promotion}
{if $is_history}
    {include file="$deftpl/sublist/promotion_history_part.tpl"}
{else}
    {include file="$deftpl/sublist/promotion_part.tpl"}
{/if}
{/section}


{else}
<!--  Go to Listing -->
{include file="$deftpl/sublist/sublist_part.tpl"}

{/if}
