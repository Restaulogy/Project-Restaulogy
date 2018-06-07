{if $listing_type == 'post'}
<div id="current_post">

	<b>Current Promotion listing</b>
	<br><br>
   {assign var='promo_count' value="0"}
	{section name=itm loop=$list}
        {math assign='promo_count' equation="x+y" x=$promo_count y=$list[itm].promotion_count}
    {/section}
   
   			
    {if !($list) && $promo_count eq 0}
    <br><Br>
     <div class="fail">
        There are no current promotions posted by you.
     </div>
    {else}
        {assign var="isuser" value="1"}
         <ul data-role="listview"  data-filter="true" data-inset="true">
        {section name=itm loop=$list}
    	    {assign var="subfile" value=$list[itm].subfile}
            {include file="$deftpl/sublist/$subfile"}
        {/section}
    	</ul>


        {if $paginate.total > $vs_config.search_page}
        		         <div align=center style="font-size: 10pt; font-weight: normal; color: black;">
        		           {paginate_prev}{paginate_middle format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next}
        		          </div>

        {/if}
    {/if}

<br>
	<input type="button" data-theme="a" value="Past Promotions" onclick="$('#current_post').hide();$('#past_post').show();">
</div>

<div id="past_post" style="display:none;">
	<b>Historical Promotion listing </b><br><br>
	{if !($list_history)  && $list_history_count eq 0}

     <div class="fail">
        There are no previous promotions posted by you.
     </div>
    {else}
        {assign var="list" value=$list_history}
        {assign var="table_id" value="list_history"}
        <ul id="{$table_id}" data-role="listview" data-inset="true">
        {assign var="is_history" value="1"}
        {section name=itm loop=$list}
    	    {assign var="subfile" value=$list[itm].subfile}
            {include file="$deftpl/sublist/$subfile"}
        {/section}
    	</ul>
        {include file="$deftpl/controls/pagination.tpl"}

    {/if}
    <br>
    <input type="button" data-theme="a" value="Current Promotions" onclick="$('#current_post').show();$('#past_post').hide();">
</div>
{/if}
