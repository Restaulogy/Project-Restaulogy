{assign var=listing_level value=$list[itm].level}
 <div class="sublist_table">
 <div class="sublist_item">
 <div class="top_line" style="text-align:left;">
 	<a style="font-size:16px;text-transform:uppercase;font-weight:bolder;" title="{$list[itm].firm}" target="_blank" href="edlist.php?lid={$list[itm].id}">{$list[itm].firm|truncate:25}</a>
       {if $list[itm].country}<small style="font-size:10px; font-weight:bold;">({$list[itm].country}{if $list[itm].states}&nbsp;|&nbsp;{$list[itm].states}{/if})</small>{/if}
 </div>

 {if $ishistory eq 1}
    {assign var=user_promotion value=$list[itm].user_promotion}
    <table style="border-collapse: collapse;margin:5px;">
    <tr>
    {assign var=th_style value="font-size:12px;font-weight:bolder;color:#17a;border-bottom:2px solid #ccc;border-top:2px solid #ccc;background:#fffff0;padding:4px 4px 4px 8px;"}

        <td style="width:250px;{$th_style}">Title</td>
        <td style="width:150px;{$th_style}">Metro Area</td>
        <td style="width:150px;{$th_style}">State</td>
        <td style="width:150px;{$th_style}">Start Date</td>
        <td style="width:150px;{$th_style}">End Date</td>
        <td style="width:50px;{$th_style}">View</td>
    </tr>
    {section name=pitm loop=$user_promotion}
      {if $smarty.section.pitm.iteration%2}
        <tr style='background:#efefef;'>
      {else}
          <tr style='background:#fff;'>
      {/if}
      {assign var=td_style value="font-size:11px;padding:2px;border-bottom:1px solid #ccc;"}

        <td style="width:250px;{$td_style}">{$user_promotion[pitm].title}</td>
        <td style="width:150px;{$td_style}">{$user_promotion[pitm].metro_area_name}</td>
        <td style="width:150px;{$td_style}">{$user_promotion[pitm].states_name}</td>
        <td style="width:150px;{$td_style}">{$user_promotion[pitm].start_date|date_format:"%A, %B %e, %Y"}</td>
        <td style="width:150px;{$td_style}">{$user_promotion[pitm].end_date|date_format:"%A, %B %e, %Y"}</td>
        <td style="width:50px;{$td_style}"><center><a style='color:#fc6300;font-size:10px;font-weight:normal;' target="_blank" href='promotion.php?view_promotion_id={$user_promotion[pitm].id}'>View</a></center></td>
        </tr>
        <tr>
        </tr>



    {/section}
    <table>
{else}
   <table>
	<tr>
       {include file="$deftpl/sublist/sublist_common_part.tpl"}
    <td style="width:110px;" valign="top">
        {if $ispromotion eq 1}
          <a  target="_blank" href="promotion.php?list_id={$list[itm].id}">
        {else}
          <a  target="_blank" href="edlist.php?lid={$list[itm].id}">
        {/if}

         {if $list[itm].logo != "" AND $vs_level[$listing_level].listmail}
        		<img class="myimage" src="logo/{$list[itm].logo}" />
         {else}
        	    <img class="myimage" src="templates/{$deftpl}/images/nologo.jpg" />
         {/if}
        </a>
    </td>

</table>
 {/if}
<div class="bottom_line"></div>
</div>
 </center>

</div>

