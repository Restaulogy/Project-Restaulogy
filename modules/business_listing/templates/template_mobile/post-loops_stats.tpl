
{if $list}
 
	<table class="biz_data_grid">
	<tr> 
		<th colspan="2" class="{if $smarty.get.sort_on eq 'pds_list_promotions.title'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=pds_list_promotions.title&sort_by={$new_sort}">Name</a></th>
		<th ><a href="{$page_url}&sort_on=pds_list_promotions.end_date&sort_by={$new_sort}">Avg. Party size</a></th>
		<th ><a href="{$page_url}&sort_on=pds_list_promotions.end_date&sort_by={$new_sort}">Avg. Bill </a></th>
		<th ><a href="{$page_url}&sort_on=pds_list_promotions.end_date&sort_by={$new_sort}">Avg. Discount </a></th>
		<th class="{if $smarty.get.sort_on eq 'pds_list_promotions.redimed_cupons'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=pds_list_promotions.redimed_cupons&sort_by={$new_sort}">No.of Claims</a></th>
	</tr>
	{section name=itm loop=$list}
	{if $ispromotion eq 1} 
	{assign var=user_promotion value=$list[itm].user_promotion}
	{section name=pitm  loop=$user_promotion} 
		{assign var="promo_img_src" value=""}
		 {if !($user_promotion[pitm].img_ext)||($user_promotion[pitm].img_ext eq '0')}
		    {if $list[itm].logo !=""}
		         {assign var="promo_img_src" value=$promo_img_src|cat:"logo/"|cat:$list[itm].logo}
			{else}
		         {assign var="promo_img_src" value=$promo_img_src|cat:"templates/"|cat:$deftpl|cat:"/images/nologo.jpg"}
		    {/if}
		{else}
		    {assign var="promo_img_src" value=$promo_img_src|cat:"promotion_images/"|cat:$user_promotion[pitm].id|cat:"."|cat:$user_promotion[pitm].img_ext}
		{/if}
		 <tr class="{cycle values="odd,even"}">
		 	<td style="width:10%;">
             <a href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}" target="_blank"  rel="external"><img src="{$promo_img_src}" style='width:100%;position:relative;'/></a>
             </td>
			<td style="width:40%;"><a href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}">{$user_promotion[pitm].title|truncate:40}</a>           {if $user_promotion[pitm].cupon_type eq 'survey'}
                    <br><b style='font-style:Italic;'>Feedback Promotion</b></b>
             {/if}
            </td>
			<td style="width:20%;">{$user_promotion[pitm].avgs.party_size|string_format:"%.2f"}</td>
			<td style="width:20%;">{$user_promotion[pitm].avgs.bill_amount|string_format:"%.2f"}</td>
			<td style="width:20%;">{$user_promotion[pitm].avgs.total_discount|string_format:"%.2f"}</td>
			<td style="width:5%;">{$user_promotion[pitm].redimed_cupons}</td>
		 </tr> 
	 {/section} 
	 {/if} 
    {/section}
	<tfoot>
		<tr>
			<td colspan="6">
			 #&nbsp;{$result_found}&nbsp;&nbsp;&nbsp; 
			<div class="pagination">{if $paginate.total gt $vs_config.search_page}{paginate_prev}{paginate_middle format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next}{/if}</div>
			</td>
		</tr>
	</tfoot>
	 
	
	</table>
     
  
{else}
    {if $byconnections}
        <div class="error">
            There are no promotions posted by Connections.
        </div>
    {elseif $bygroupmem}
        <div class="error">
            There are no promotions posted by Group Members.
        </div>
    {else}
        <div class="error">
		    {lang->desc p1='search' p2=$lang_set p3='not_found'}
        </div>
    {/if}

{/if}<!--$List-->




