
{include file="$deftpl/header.tpl"}
{assign var="list" value=$promotion.listing}
{literal}
<script type="text/javascript">
	$(document).ready(function(){

         $( "#dialog_tab" ).tabs();

     });

</script>
{/literal}

<div id="dialog_tab" style="width:580px; border:none !important;">
<ul style="width:580px;">
	<li><a href="#promotion_info" style="padding:2px;font-size:11px;">Detail</a></li>
	<li><a href="#listing_info"  style="padding:2px;font-size:11px;">Business Information</a></li>
</ul>
	<div id="promotion_info">
     <table style="width:570px;font-size:10px;">
		<tr>
			<td style='text-align:justify;'>
			  <img align="left" style="width:170px; border:4px solid #FFFFFF;" src="{$promotion.img_src}"/> <b>Valid From</b>&nbsp;{$promotion.start_date|date_format:"%B %d, %Y"}&nbsp;&nbsp;&nbsp;&nbsp;<b>upto</b>&nbsp;{$promotion.end_date|date_format:"%B %d, %Y"}<br/><br/>
               {$promotion.comments}
            </td>
        </tr>
        <tr>
            <td>
            <center>
            {if $user_promotion[pitm].pdf != "" }
                                   <a style="width:70px;" href="{$elgg_main_url}chkIfPrinted.php?promoid={$promotion.id}&amp;pdfFile={$promotion.pdf}" target="_blank"><img style="border:none;width:15px;height:15px;" src='{$elgg_small_icon_url}print.png' alt="print"/>View/Print</a>
			 {/if}

            </center>
            </td>
        </tr>

    </table>
	</div>
	<div id="listing_info">

	  <table style="width:570px;font-size:10px;margin-left:-10px;">
       <tr>
        <td style="width:100px;"><b>Company</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4">{$list.firm}</td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>State</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$list.states}</td>
        <td style="width:100px;"><b>Metro Area</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$list.metro_area_name}</td>
       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>Address</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"> {$list.strip_address}</td>

       </tr>
        <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>Website</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"><a href="{$list.website}" target="_blank">{$list.website}</a></td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
       <td colspan="6">
        <table style="width:570px;font-size:10px;margin-left:-3px;">
            <tr>
                <td style="width:40px;"><b>Phone</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list.phone}</td>
                <td style="width:40px;"><b>Cell</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list.mobile}</td>
                <td style="width:40px;"><b>Fax</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list.fax}</td>
            </tr>
        </table>
       </td>

       </tr>
     </table>
	</div>
</div>

 {include file="$deftpl/sitefoot.tpl"}
