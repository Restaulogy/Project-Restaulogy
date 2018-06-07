<div data-role="popup" id="popupFavList" data-dismissible="false" data-overlay-theme="g" data-theme="a" style="width:250px;">
	<div data-role="header">
			<h1>Rating</h1>
	</div>
	<div data-role="content" style="padding:5px;">
    {if $ratingcount gt 0 && $allrating}
        <table class="biz_data_grid">
            <tr>
                <th>Customer Name</th>
                <th>Rating</th>
            </tr>
        {foreach $allrating as $rate}
            <tr class="{cycle values="odd,even"}">
                <td class="no_hover">{$rate.customer_name}</td>
                <td class="no_hover"><img src="{$website}/images/rating/{$rate.rate}.gif"/></td>
            </tr>
        {/foreach}
        </table>
     {else}
        <div class="error">{$_lang.tbl_feedback.no_record_found}</div>
     {/if}
     <div class="biz_center">
        {jqmbutton mini="true" type="close" onclick="$('#popupFavList').popup('close');"}
     </div>
	</div>
</div>
