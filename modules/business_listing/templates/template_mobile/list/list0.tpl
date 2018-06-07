{*****************************************
      Listing Template - Default
          phpDirectorySource
******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='list0'}
{*****************************************

   Listing Display

******************************************}

{if $showing_promotion || $ispromotion eq 1}
	{include file="$deftpl/list/promotion.tpl"}
	{include file="$deftpl/list/list.tpl"}
    {include file="$deftpl/list/vote.tpl"}
    {include file="$deftpl/list/rating.tpl"}
	{include file="$deftpl/list/recommendation.tpl"}
	{include file="$deftpl/list/comment.tpl"}
{else}
	{include file="$deftpl/list/list.tpl"}
	{include file="$deftpl/list/promotion.tpl"}
	{include file="$deftpl/list/vote.tpl"}
	{include file="$deftpl/list/rating.tpl"}
	{include file="$deftpl/list/recommendation.tpl"}
	{include file="$deftpl/list/comment.tpl"}
	{include file="$deftpl/list/contact.tpl"}
	{include file="$deftpl/list/product.tpl"}
	{include file="$deftpl/list/promotions.tpl"}
{/if}
<div id='other_promo_asc' data-role="page">
    <div data-role="header">
        <h4>Similar Deals</h4>
    </div>
    <div data-role="content" data-theme="b">
          {if $user_promotion}
               <ul>
                 {assign var='curr_prom_counter' value="0"}
                 {section name=pitm loop=$user_promotion}
                  {if $showing_promotion.id eq $user_promotion[pitm].id}
                       <!-- Not Show the Link -->
                  {else}
                  <li style='margin-left:30px;'><a href='{$elgg_main_url}pg/business_listing/main/show_promotion/{$user_promotion[pitm].list_id}/{$user_promotion[pitm].id}?view=mobile' target='_blank'>{$user_promotion[pitm].title}</a></li>
                  {math assign="curr_prom_counter" equation="x + 1" x=$curr_prom_counter}
                  {/if}
                 {/section}
                 {if $curr_prom_counter eq 0}
                    <br/><b>There is no Current Promotion posted by this Business.</b>
                 {/if}
                </ul>

        {else}
                    <br/><b >There is no Current Promotion posted by this Business.</b>
        {/if}
        </div>
</div>



{if $rwd gt 0 && $reward.rwd_id gt 0}
      <div id="reward_coupon" data-role="dialog">
        <div data-role="header">
            <h4>Reward Coupon</h4>
        </div>
        <div data-role="content" data-theme="b">
             <br/>
             <center style="font-weight:bold;font-size:16px;">{$reward.rwd_cup_id}</center>
             <br/>
        </div>
    </div>
    <a  id="reward_id" href="#reward_coupon" data-role="button" data-rel="dialog" data-transition="slideup"></a>
{literal}
  <script type="text/javascript">
   function popup_reward(){
       $('#reward_id').click();
   }
    $(function(){
        setTimeout( 'popup_reward()',2000);
    });
  </script>
{/literal}
   
{/if}



