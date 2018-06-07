{*****************************************

       Change Membership Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='upgrade'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
{if !$show_final}
<a href=show.php?lid={$vs_current_listing.id}>
  {assign var=list_lvl value=$vs_current_listing.level}
     <table class="job_detail_view">
      <tr>
       <th colspan="2">
         {$vs_current_listing.firm}
		</th>
	  </tr>
   	  <tr>
	    	<td class="right_td">{lang->desc p1='upgrade' p2=$lang_set p3='current_level'}</td>
			<td class="left_td">{$vs_level[$list_lvl].title}</td>
   	 </tr>
         <tr>
	    	<td class="right_td"> {lang->desc p1='upgrade' p2=$lang_set p3='days_left'}</td>
			<td class="left_td">{$days_left}</td>
   	 </tr>
         <tr>
	    	<td class="right_td"> {lang->desc p1='upgrade' p2=$lang_set p3='value_left'}</td>
			<td class="left_td"> {$value_left}</td>
   	 </tr>

  {section name=itm loop=$vs_level_ct}
    {assign var=level_id value=$vs_level_ct[itm]}
      <tr>
       <th colspan="2" style="font-size:12px;">
        
    {if $vs_level[$level_id].action == "same_level"}
         {lang->desc p1='upgrade' p2=$lang_set p3='same_level'}
    {elseif $vs_level[$level_id].action == "same_exp"}
         {lang->desc p1='upgrade' p2=$lang_set p3='same_exp'}
    {elseif $vs_level[$level_id].action == "dif_exp"}
         {lang->desc p1='upgrade' p2=$lang_set p3='dif_exp'}
    {else}
         {lang->desc p1='upgrade' p2=$lang_set p3='no_exp'}
    {/if}
        </th>
    </tr>
   	   <tr>
	    	<td class="right_td"> {lang->desc p1='upgrade' p2=$lang_set p3='new_level'}</td>
			<td class="left_td"> {$vs_level[$level_id].title}</td>
   	 </tr>
        <tr>
	    	<td class="right_td">  {lang->desc p1='upgrade' p2=$lang_set p3='new_cost'}</td>
			<td class="left_td"> {$vs_level[$level_id].new_cost}</td>
   	 </tr>
        <tr>
	    	<td class="right_td">  {lang->desc p1='upgrade' p2=$lang_set p3='new_exp'}</td>
			<td class="left_td"> {$vs_level[$level_id].new_exp}</td>
   	 </tr>
        </td>
       <td colspan="2" align="center">
        <font style="color:{#table_std_font_color#}; font-size:{#table_std_font_size#}; font-weight:{#table_std_font_weight#}; background-color:{#table_std_font_bgcolor#};">
    {if $vs_level[$level_id].new_cost > 0}
         <table width="100%">
          <tr>
           <td width="50%">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
             <input type="hidden" name="cmd" value="_xclick">
             <input type="hidden" name="business" value="{$vs_config.paypal_email}">
             <input type="hidden" name="return" value="{$vs_config.mainurl}/upgrade.php">
             <input type="hidden" name="notify_url" value="{$vs_config.mainurl}/upgrade.php">
             <input type="hidden" name="cancel_return" value="{$vs_config.mainurl}"> 
             <input type="hidden" name="custom" value="{$vs_current_listing.id}">
             <input type="hidden" name="currency_code" value="{$vs_config.paypal_currency}">
             <input type="hidden" name="item_number" value="{$level_id}">
             <input type="hidden" name="item_name" value="{$vs_level[$level_id].title} Membership - Upgrade">
             <input type="hidden" name="quantity" value="1">
             <input type="hidden" name="amount" value="{$vs_level[$level_id].new_cost}">
             <input type="hidden" name="no_shipping" value="0">
             <input type=submit value="{lang->desc p1='upgrade' p2=$lang_set p3='btn_paypal'}" class="blackbutton"  style="width:100px;">
            </form>
           </td>
           <td width="50%">
            <form action="upgrade.php?lid={$vs_current_listing.id}" method="post">
             <input type=hidden name=request_level value="{$level_id}">
             <input type="hidden" name="amount" value="{$vs_level[$level_id].new_cost}">
             <input type="submit" name="btn_billing" value="{lang->desc p1='upgrade' p2=$lang_set p3='btn_billing'}" class="blackbutton"  style="width:100px;">
            </form>
           </td>
          </tr>
         </table>
    {else}
        <table width="100%">
          <tr>
          <td>
         <form action="upgrade.php?lid={$vs_current_listing.id}" method="post">
          <input type=hidden name=new_level value={$level_id}>
          <input type=hidden name=new_exp value={$vs_level[$level_id].new_exp}>
          <input type=submit name=btn_change value="{lang->desc p1='upgrade' p2=$lang_set p3='btn_change'} " class="blackbutton"  style="width:100px;" >
         </form>
          </td>
          </tr>
         </table>
    {/if}
        </font>
       </td>
      </tr>
  {/section}
	 </table>
{else}
	<br>
     <div class="attention">
            {$notice}
            </div>
{/if}
<center><button class="blackbutton" value="Back" onclick="document.location.href='javascript:history.go(-1)'">Back</button></center>
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
