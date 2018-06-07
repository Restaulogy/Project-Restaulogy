
{if $smarty.request.with_notification neq 1}
{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER}
<div class="navTable_border">
<table class="navTable" style="width:350px;">
	<tr>
        {if $smarty.request.pst_table_id > 0 || $smarty.request.table_id > 0}
            <th><a href="{$website}/user/tbl_table_status_link.php?latestOnly=1">{$_lang.tbl_table_status_link.listing_title}</a></th>
            <th><a href="{$website}/user/dining_table_layout.php">{$_lang.tbl_dining_table.layout}</a></th>
            <th><b>{$_lang._details}</b></th>
        {else}
            <th><b>{$_lang.tbl_table_status_link.listing_title}</b></th>
            <th><a href="{$website}/user/dining_table_layout.php">{$_lang.tbl_dining_table.layout}</a></th>
        {/if}
        
        <!--
        <th><b>{$_lang.tbl_table_status_link.listing_title}</b></th>
        <th><a href="{$website}/user/dining_table_layout.php">{$_lang.tbl_dining_table.layout}</a></th>
        -->
        
	</tr>
</table> 
</div>
{/if}
{/if}

