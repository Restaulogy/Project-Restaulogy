
<table class="legend_Table full_width">
    <tr>
        <td colspan="4" width="100%">
            <strong>LEGEND :</strong>
        </td>
    </tr>
    <tr>
        <td width="10%">
            <img src="{$smarty.const.ICN_INITIATE}" height="12"/>
        </td>
        <td width="40%">
             {$smarty.const.LBL_INITIATE}
        </td>
        <td width="10%">
            <img src="{$smarty.const.ICN_IN_PROCESS}" height="12"/>
        </td>
        <td width="40%">
            {$smarty.const.LBL_IN_PROCESS}
        </td>
    </tr>
    <tr>
				<td>
            <img src="{$smarty.const.ICN_CANCELLED}" height="12"/>
        </td>
        <td>
             {$smarty.const.LBL_CANCELLED}
        </td> 
        <td width="10%">
            <img src="{$smarty.const.ICN_COMPLETE}" height="12"/>
        </td width="40%">
        <td>
            {$smarty.const.LBL_COMPLETE}
        </td>
    </tr>
	{if !$isCustomer}
    <tr>
        <td width="10%">
            <img src="{$smarty.const.ICN_NOT_IN_TIME}" height="12"/>
        </td>
        <td width="40%">
             {$smarty.const.LBL_NOT_IN_TIME}
        </td>
        <td>
            &nbsp;
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
  {/if}
</table> 
