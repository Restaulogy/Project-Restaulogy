{*****************************************

       Edit Listing Template
          phpDirectorySource

******************************************}

{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edlist'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/header.tpl"}
{*****************************************

   Page Display

******************************************}
  {include file="$deftpl/promotion/script.tpl"}
 {if $elgg_user_acct_type ==  "business" || $elgg_user_acct_type =="social/business organization"}
    {if $elgg_user_allow_to_free_post}

	{else}
         {if $elgg_remaining_itm_to_post < 10}
            <div class="attention">
				<b># Allowed Posts</b>:
                {$elgg_remaining_itm_to_post}
		  </div>
         {/if}
    {/if}

    
	{if $isowner eq 0}
	    	<div class="fail">Not Authorized Owner! Access Denied.</div>
	{else}

        {if $is_incomplete_list eq 1}
                 <!-- The Business id is missing / Incomplete Profile / Not Created Profile -->
            	{include file="$deftpl/promotion/incomplete_business_listing_msg.tpl"}
    	{else}

            {if $show_info eq 1}
                <!-- Regular Promotion Info -->
                {include file="$deftpl/promotion/promotion_detail.tpl"}

    	    {else}
    			<!-- If More Than One Business User have -->
                {include file="$deftpl/promotion/multiple_business_promotions.tpl"}

    	    {/if}<!-- end of $show_info-->
        {/if}<!-- end of $is_incomplete_list-->
	{/if}<!-- end of $isowner -->
{else}
	<div class="alert">Only Business Account Are Eligible To Post Promotions.</div>
{/if}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
