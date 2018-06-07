<table class="listTable" >
{foreach from=$tbl_dishesinfo.paired_dishes_details item=tbl_paired_dishesitem}
{if $tbl_paired_dishesitem.dish_is_drink eq 1}
    <tr>
    <td class="bigListItem" >
    <table>
       <tr>
         <td width="40" height="40" style="border-bottom:none !important;">
             {if $tbl_paired_dishesitem.dish_img neq ""}
            <a target="_blank" href="{$website}/uploads/dish/{$tbl_paired_dishesitem.dish_img}"><img width="40" height="40" src="{$website}/uploads/dish/{$tbl_paired_dishesitem.dish_img}" /></a>
             {/if}
         </td>
         <td style="border-bottom:none !important;">
            <table >
                <tr>
                    <td style="border-bottom:none !important;">
                        <a href="{$website}/user/tbl_dishes.php?mode={$smarty.const.MODE_VIEW}&dish_id={$tbl_paired_dishesitem.dish_id}" style='color:black !important;'>{$tbl_paired_dishesitem.dish_name}</a> &nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom:none !important;">
                    <small style='color:black !important;'>
    			    {$tbl_paired_dishesitem.dish_notes|truncate :50}
                	</small>
                    </td>
                </tr>
            </table>
         </td>
       </tr>
    </table>
   </td>
  </tr>
  {/if}
{/foreach}
 </table>
