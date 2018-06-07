{include file='header.tpl'} 
<div class="wrapper"> 
	<h1>{$_lang.main.restaurent.select}</h1> 	 
	{if $restaurant_list && $result_found}
	<div class="biz_center" style="width:99%;">
	
	<ul data-role="listview" data-inset="true">
		{foreach $restaurant_list as $restaurant} 
			<li data-icon="cart" {if $restaurant.restaurent_is_online neq 1}class="ui-disabled"{/if}>
                <!--
                <img src="{$restaurant.restaurent_img_url}" width="20" height="20" />
                -->
                {if $restaurant.restaurent_is_online eq 1}
                     <a href="{$website}/user/index.php?restaurant={$restaurant.restaurent_id}">{$restaurant.restaurent_name}</a>
                {else}
                    <a href="#">{$restaurant.restaurent_name}</a>
                {/if} 
                <a href="{$website}/user/index.php?restaurant={$restaurant.restaurent_id}&is_prom=1">{$_lang.main.customer_dashboard_menu.deals}</a>
                
                <small style="font-size: 10px;font-family: Arial;padding-left: 15px;">{$restaurant.restaurent_address|truncate:35}
                </small>
                <small style="font-size: 10px;font-family: Arial;padding-left: 15px;"> [{$restaurant.restaurent_online_ord_start|date_format:"{$smarty.const.HTML5_TIME_AMPMFORMAT}"} - {$restaurant.restaurent_online_ord_end|date_format:"{$smarty.const.HTML5_TIME_AMPMFORMAT}"}]
                </small>
            </li>
		{/foreach}
	</ul>
	</div> 
	{/if}
</div>  
{literal}
<style type="text/css">
	.ui-disabled {
	filter: Alpha(Opacity=70);
	opacity: .70;
	zoom: 1;
} 
</style>

{/literal}
{include file='footer.tpl'}
