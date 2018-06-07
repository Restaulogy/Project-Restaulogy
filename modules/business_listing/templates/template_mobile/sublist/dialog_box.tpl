<div id="dialog-message{$user_promotion[pitm].id}_{$smarty.section.pitm.iteration}">
<div id="dialog_tab{$user_promotion[pitm].id}_{$smarty.section.pitm.iteration}" style="width:580px; border:none !important;">
<ul style="width:580px;">
	<li><a href="#promotion_info{$user_promotion[pitm].id}_{$smarty.section.pitm.iteration}" style="padding:2px;font-size:11px;">Detail</a></li>
	<li><a href="#listing_info{$user_promotion[pitm].id}_{$smarty.section.pitm.iteration}"  style="padding:2px;font-size:11px;">Business Information</a></li>
</ul>
	<div id="promotion_info{$user_promotion[pitm].id}_{$smarty.section.pitm.iteration}">
     <table style="width:570px;font-size:10px;">
		<tr>
			<td style='text-align:justify;'>
			  <img align="left" style="width:170px; border:4px solid #FFFFFF;" src="{$promo_img_src}"/> <b>Valid From</b>&nbsp;{$user_promotion[pitm].start_date|date_format:"%B %d, %Y"}&nbsp;&nbsp;&nbsp;&nbsp;<b>upto</b>&nbsp;{$user_promotion[pitm].end_date|date_format:"%B %d, %Y"}<br/><br/>
               {$user_promotion[pitm].comments}
            </td>
        </tr>
        <tr>
            <td>
            <center>
            {if $user_promotion[pitm].pdf != "" }
                                   <a style="width:80px;" href="{$elgg_main_url}chkIfPrinted.php?promoid={$user_promotion[pitm].id}&amp;pdfFile={$user_promotion[pitm].pdf}" target="_blank"><img style="border:none;width:15px;height:15px;" src='{$elgg_small_icon_url}print.png' alt="print"/>View/Print</a>
			 {/if}

            </center>
            </td>
        </tr>

    </table>
	</div>
	<div id="listing_info{$user_promotion[pitm].id}_{$smarty.section.pitm.iteration}">
      <table style="width:570px;font-size:10px;margin-left:-10px;">
       <tr>
        <td style="width:100px;"><b>Company</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4">{$list[itm].firm}</td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>State</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$list[itm].states}</td>
        <td style="width:100px;"><b>Metro Area</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$list[itm].metro_area_name}</td>
       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>Address</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"> {$list[itm].strip_address}</td>

       </tr>
        <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>Website</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"><a href="{$list[itm].website}" target="_blank">{$list[itm].website}</a></td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
       <td colspan="6">
        <table style="width:570px;font-size:10px;margin-left:-3px;">
            <tr>
                <td style="width:40px;"><b>Phone</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list[itm].phone}</td>
                <td style="width:40px;"><b>Cell</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list[itm].mobile}</td>
                <td style="width:40px;"><b>Fax</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list[itm].fax}</td>
            </tr>
        </table>
       </td>

       </tr>
     </table>
	</div>
</div>
 </div>
