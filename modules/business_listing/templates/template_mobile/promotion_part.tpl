{if $is_view_promotion eq 1}
     {assign var="promo_id" value=1}
{else}
    {assign var="promo_id" value=$smarty.section.citm.iteration}
{/if}

{if $promotion.isExpired eq 1}
    {assign var='req_cls' value=''}
{else}
    {assign var='req_cls' value='class="required"'}
{/if}
    

 {if $promotion.id|trim|strlen eq 0}
    {assign var="ALLOW_TO_POST" value=0}
    {if $elgg_user_allow_to_post eq 1}
        {if $elgg_user_subscription_id && $elgg_remaining_itm_to_post }
            {assign var="ALLOW_TO_POST" value=1}
        {else}
            {if $elgg_user_allow_to_free_post eq 1}
                {assign var="ALLOW_TO_POST" value=1}
            {/if}
        {/if}
    {/if}
 {else}
     {assign var="ALLOW_TO_POST" value="1"}
 {/if}
 {assign var="ALLOW_TO_POST" value="4"}
 {if $ALLOW_TO_POST eq 0}
    <div class="fail">Not Allowed To Post Promotion.</div>
 {else}

<form id="promotion_form{$promo_id}" name="promotion_form{$promo_id}" action="promotion.php?list_id={$promotion.list_id}" method="post" enctype="multipart/form-data">
   <input type="hidden" id="id"  name="id" value="{$promotion.id}"/>
	<div data-role="page" id="promotion_{$promo_id}_form">
		<div data-role="header">
		    <h4>ss</h4>
		</div>
		<div data-role="content">
		    dddd
		</div>
		<div data-role="footer">
		    <h4>ss</h4>
		</div>
	</div>
	<div data-role="page" id="promotion_{$promo_id}_view">
		<div data-role="header">
		    <h4>ss</h4>
		</div>
		<div data-role="content">
		    dddd
		</div>
		<div data-role="footer">
		    <h4></h4>
		</div>
	</div>

</form>
{/if}




