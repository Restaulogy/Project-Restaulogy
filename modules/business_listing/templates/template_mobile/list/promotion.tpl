{if $showing_promotion}
    <div data-role="page" id="promotion">
        {include file="$deftpl/common_header.tpl"}
		<div data-role="content">
		{include file="$deftpl/breadcrumb.tpl"}
      {assign var="vPromotion" value=$showing_promotion}
      	{if $vPromotion}
		    {include file="$deftpl/viewpromotions_display.tpl"}
    	{else}
            No Promotion.
     	{/if}
    </div><!--content-->
        {include file="$deftpl/common_footer.tpl"}
 </div><!--page-->
{else}

    {if $user_promotion}
       {section name=pitm loop=$user_promotion}
        <div data-role="page" id="promotion{$user_promotion[pitm].id}">
            {include file="$deftpl/common_header.tpl"}
            <div data-role="content">
            	{assign var="vPromotion" value=$user_promotion[pitm]}
                {if $vPromotion}
		         	{include file="$deftpl/viewpromotions_display.tpl"}
                {else}
                    No Promotion.
                {/if}
            </div>
            {include file="$deftpl/common_footer.tpl"}
    	</div>
      {/section}
    {/if}
    
{/if}
