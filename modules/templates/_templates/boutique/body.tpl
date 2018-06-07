<table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Georgia, serif;" >
  <tr>
    <td width="599" valign="top" align="left" bgcolor="#ffffff" style="font-family: Georgia, serif; background: #fff; border-top: 5px solid #e5bd5f">
		<table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;" width="599">
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 15px 0 5px; font-family: Georgia, serif;" valign="top" align="center" width="569">
				<img src="{$elgg_theme_url}/images/divider_top_full.png" alt="divider"><br>
			</td>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
		</tr>
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="left">
				<h2 id="header_title">{$info.template_content.title}</h2>
                <span style="font-size: 14px;">  Deal for <b>{$info.template_content.metro_area}</b> Valid upto <b>{$info.template_content.end_date|date_format:"%e, %B"}</b>
                </span>
			</td>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
		</tr>

		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 15px 0 5px; font-family: Georgia, serif;" valign="top" align="center" width="569">
              {include file="biz_info.tpl"}
			</td>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
		</tr>
	</table>
   </td>
  </tr> 
  {if $info.template_content.image && $info.template_content.image neq ""}
  <tr>
    <td width="599" valign="top" align="left" bgcolor="#ffffff" style="font-family: Georgia, serif; background: #fff; ">
	<table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;" width="599">
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="center">
            {$info.template_content.image_box}
			</td>
		</tr>
    </table>
  </td>
 </tr>
 {/if}
 
 <tr>
    <td width="599" valign="top" align="left" bgcolor="#ffffff" style="font-family: Georgia, serif; background: #fff; ">
	<table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;" width="599">
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="left">
	<b style="font-size:18px;line-height:30px;">Description:</b>
    <p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px;">
                {$info.template_content.description|replace:'\r\n':'<BR>'|replace:"'":"'"|replace:'"':'"'}
    </p>
			</td>
		</tr>
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="left">
				<img src="{$elgg_theme_url}/images/divider_full.png" alt="divider">
			</td>
		</tr>
		<tr>
				<td colspan="2" style="padding: 10px 0 0;  border-bottom:4px solid #c89c22;"></td>
		</tr>
		</table>
	</td>
  </tr>
 <tr>
	  <td style="font-size: 1px; height: 10px; line-height: 1px;" height="10"><img src="{$elgg_theme_url}/images/spacer.gif" alt="space" width="15"></td>
  </tr>
  <tr>
   <td align="center" >
    <table class="footer">
			      <tr>
			        <td>
                       {$translations.copyright}
					</td>
			      </tr>
	</table><!-- footer-->
	<br/>
	</td>
  </tr>
</table><!-- body -->
