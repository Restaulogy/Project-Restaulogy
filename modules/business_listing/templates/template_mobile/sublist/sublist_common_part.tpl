<td style="width:700px;" valign="top">
	{if $prefix_tab}
     {else}
        {assign var="prefix_tab" value="listing"}
     {/if}
    <ul>
{if $ispromotion eq 0}
       <li class="UItabs"><a  style="font-size:11px;font-weight:bold;" href="#list{$list[itm].id}">Basic Information</a></li>
{/if}

    {assign var=user_promotion value=$list[itm].user_promotion}
    {section name=pitm max=2 loop=$user_promotion}
        <li class="UItabs"><a style="font-size:11px;font-weight:bold;" href="#{$prefix_tab}promo{$list[itm].id}-{$smarty.section.pitm.iteration}">Promotion{$smarty.section.pitm.iteration}</a></li>
    {/section}
    </ul>
{if $ispromotion eq 0}
    <div id="list{$list[itm].id}" class="sublist_itm_div">
	<span style="line-height:15px;font-weight:bold;font-size:11px;text-align:justify;">
	&nbsp;&nbsp;&nbsp;&nbsp;{$list[itm].desc_elipsis}
	</span>
	{if $list[itm].website}<br><img src="templates/{$deftpl}/images/website.png"/><a href="{$list[itm].website}" target="_blank" >{$list[itm].website}</a>{/if}
	{if $list[itm].phone || $list[itm].fax || $list[itm].mobile }
	<br>
	<span style="line-height:15px;font-weight:bolder;">
	 	{if $list[itm].phone && $list[itm].show_field_on_form.fld_phone}<img src="templates/{$deftpl}/images/phone.png"/>&nbsp;{$list[itm].phone}{/if}
		{if $list[itm].mobile && $list[itm].show_field_on_form.fld_mobile}<img src="templates/{$deftpl}/images/mobile.png"/>&nbsp;{$list[itm].mobile}{/if}
		{if $list[itm].fax && $list[itm].show_field_on_form.fld_fax}<img src="templates/{$deftpl}/images/fax.png"/>{$list[itm].fax}{/if}
	</span>
	{/if}
	<br><br>
      {if $vs_current_user.id}
		<div style="position:absolute;bottom:5px;">
		{if $list[itm].favorites eq 0}
	     <input type="button" style="width:150px;font-size:10px;height:18px;" class="blackbutton" onclick='document.location.href="favorite.php?new=1&lid={$list[itm].id}&uid={$vs_current_user.id}"' value="Add Business As Favorite"/>
		{else}
	    <input type="button" style="width:180px;font-size:10px;height:18px;" class="blackbutton" onclick='document.location.href="favorite.php?new=-1&lid={$list[itm].id}&uid={$vs_current_user.id}"' value="Remove Business From Favorite"/>
		{/if}
		 &nbsp;<input type="button" class="blackbutton" style="width:120px;font-size:10px;height:18px;" onClick="window.open('contact.php?lid={$list[itm].id}');" value="{lang->desc p1='contact' p2=$lang_set p3='contact_link'}" />&nbsp;
		<input type="button" style="width:180px;font-size:10px;height:18px;" class="blackbutton" onClick="window.open('contact.php?lid={$list[itm].id}&act=refer');"   value="{lang->desc p1='contact' p2=$lang_set p3='refer_link'}" />&nbsp;

	    <input type="button" style="width:50px;font-size:10px;height:18px;" class="blackbutton"  onClick="window.open('show.php?lid={$list[itm].id}');" value="more"/>
	    </div>
	  {/if}
    </div>
 {/if}
     
     {section name=pitm max=2 loop=$user_promotion}
     <div id="{$prefix_tab}promo{$list[itm].id}-{$smarty.section.pitm.iteration}" class="sublist_itm_div">
     <!-- for promotion favorites-->

        &nbsp;&nbsp;&nbsp;&nbsp;&bull;
        {if $user_promotion[pitm].pdf != "" }
            <a href="pdf/{$user_promotion[pitm].pdf}" target="_blank">{$user_promotion[pitm].title}</a>
        {else}
            {$user_promotion[pitm].title}
        {/if}
        {if $user_promotion[pitm].comments != "" }
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$user_promotion[pitm].comments|truncate:200}&nbsp;
        {/if}
        <br><br>
        {if $vs_current_user.id}
		<div style="position:absolute;bottom:5px;">
		  {if $user_promotion[pitm].is_promo_fav eq 0}
	   		<input type="button" style="width:100px;font-size:10px;height:18px;" class="blackbutton" onclick='document.location.href="favorite.php?new=1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$vs_current_user.id}"' value="Add To Saved"/>
		 {else}
         	<input type="button" style="width:130px;font-size:10px;height:18px;" class="blackbutton" onclick='document.location.href="favorite.php?new=-1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$vs_current_user.id}"' value="Remove From Saved"/>
    	 {/if}
     	 &nbsp;
		  	<button class="blackbutton" style="width:120px;font-size:10px;height:18px;" onClick="window.open('contact.php?lid={$list[itm].id}');">{lang->desc p1='contact' p2=$lang_set p3='contact_link'}</button>&nbsp;
	 		<button style="width:170px;font-size:10px;height:18px;" class="blackbutton" onClick="window.open('contact.php?lid={$list[itm].id}&act=refer');"> {lang->desc p1='contact' p2=$lang_set p3='refer_link'}</button> &nbsp;
	 		<button style="width:170px;font-size:10px;height:18px;" class="blackbutton" onClick="window.open('sharewith.php?promotion_id={$list[itm].id}&promotion_title={$user_promotion[pitm].title}');"> Share With Connections</button> &nbsp;
        	<button style="width:50px;font-size:10px;height:18px;" class="blackbutton" onClick="window.open('show.php?lid={$list[itm].id}');" >more</button>
        </div>
        {/if}
     </div>
    {/section}
</td>
