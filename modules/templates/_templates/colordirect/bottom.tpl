<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Courier, 'Monaco', monospace; line-height: 10px;" class="footer">
    <tr>
		<td align="center" valign="top" colspan="3">
             <br>
             <img src="{$info.template_content.image}" alt="decoration"  width="500"/>
             <br><br>
        </td>
	</tr>
    <tr>
          <td align="left"  height="20" valign="top" colspan="3">
             <table style="width:590px;">
                <tr>
                    <td style="width:470px;">
                        {$info.template_content.description|replace:'\r\n':'<BR>'|replace:"'":"'"|replace:'"':'"'}
                    </td>
                    <td style="width:120px;vertical-align:bottom !important;">
                        <img src="{$elgg_theme_url}/images/img_deco_2.png" alt="decoration" width="114" height="96">
                    </td>
                </tr>
             </table>
        </td>
	</tr>
    <tr>
		<td align="left" style="height:20px; font-size: 1px; line-height: 1px; background:#000" height="20" valign="top" colspan="3">&nbsp;</td>
	</tr>
			 <tr>
					<td style="padding: 0; line-height: 1;" width="135" valign="top">
						<img src="{$elgg_theme_url}/images/img_deco_bottom.png" alt="decoration" width="60" height="72">
					</td>
			        <td style="padding: 0 0 10px 0px; font-size: 11px; color:#000; margin: 0; font-family: Courier, 'Monaco', monospace; " valign="top" align="left" width="465" colspan="2">
						<table cellpadding="0" cellspacing="0" border="0" align="left" width="406" style="font-family: Courier, 'Monaco', monospace; line-height: 10px;">
							<tr>
								<td style="padding: 17px 0 0 0">
									<p style="font-size: 15px;  line-height: 28px; color:#000; margin: 0; padding: 0;font-family: Courier, 'Monaco', monospace; letter-spacing: -1px">{$translations.copyright}</p>

								</td>
							</tr>
						</table>
			        </td>
				 </tr>
				</table><!-- footer-->
