 
<div data-role="page" id="promotion_form">
    {include file="$deftpl/common_header.tpl"}	
 {include file="$deftpl/common_header.tpl"}
    <div data-role="content" style="overflow:hidden;">
    {include file="$deftpl/breadcrumb.tpl"}
	<h1>Promotion</h1>
			{include file="$deftpl/promotion/prom_cond_disc_tab.tpl" }
			{if $active_page eq "promotion"}
				{include file="$deftpl/promotion/spec_prom_cond_disc_tab.tpl" }
			{/if}
      {include file="$deftpl/promotion/promotion_form.tpl"}
    </div>
     
    {include file="$deftpl/common_footer.tpl"}
</div>

{if $is_edit_promotion}
<div data-role="page" id="promotion_view">

    {include file="$deftpl/common_header.tpl"}
    <div data-role="content" style="overflow:hidden;">
    {include file="$deftpl/breadcrumb.tpl"}
	<h1>Promotion</h1> 
			{include file="$deftpl/promotion/prom_cond_disc_tab.tpl" }
 	    {include file="$deftpl/promotion/promotion_view.tpl"}
    </div>
    {include file="$deftpl/common_footer.tpl"}
</div>
{/if}
