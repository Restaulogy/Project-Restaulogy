{include file="header.tpl"}
		<table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('{$elgg_theme_url}/images/bg_email.png') repeat;color:#000" class="case" width="591">
                   <!-- <a href="{$elgg_main_url}" style="background:transparent !important;"><img src="{$elgg_site_logo}" alt="logo" style="border:none;"/></a>-->
										<a href="{$elgg_main_url}" target="_blank" style="vertical-align:top !important;font-size:40px;font-weight: bold;line-height: 80px;background:transparent !important;"><img src="{$elgg_site_logo}" style="width:80px;height:80px;border:none;" />{$elgg_site_name}</a>
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>
		
		<table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('{$elgg_theme_url}/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    <img src="{$elgg_theme_url}/images/bg_divider_top.png" alt="divider" width="600" height="21"/>
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>

        <table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('{$elgg_theme_url}/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    {include file="container.tpl"}
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>
		
		{if $info.template_content.image && $info.template_content.image neq ""}
	     <table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('{$elgg_theme_url}/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    {$info.template_content.image_box}
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>
		{/if}
		
		<table>
		    
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('{$elgg_theme_url}/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    <table width="590">
                    <tr>

					<td colspan="2" style="padding: 0 0 10px 0px; font-size: 16px; color:#000; margin: 0; font-family: Courier; " valign="top" align="left" width="590">
                    <u style="line-height:30px;font-size:20px;font-weight:bold;">Description:</u><br>
                    {$info.template_content.description|replace:'\r\n':'<BR>'|replace:"'":"'"|replace:'"':'"'}
					</td></tr>
                    <tr>
						<td colspan="2" align="left" style="height:20px; font-size: 1px; line-height: 1px; background:#000" height="20" valign="top">&nbsp;</td>
					</tr>
                    <tr>
						<td style="padding: 0; line-height: 1;" width="135" valign="top">
							<img src="{$elgg_theme_url}/images/img_deco_bottom.png" alt="decoration" width="60" height="72">
						</td>
						<td style="padding: 0 0 10px 0px; font-size: 11px; color:#000; margin: 0; font-family: Courier, 'Monaco', monospace; " valign="top" align="left" width="465">
							<p style="font-size: 15px;  line-height: 28px; color:#000; margin: 0; padding: 0;font-family: Courier, 'Monaco', monospace; letter-spacing: -1px">{$translations.copyright}</p>
						</td>
					</tr>
					</table>
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>


{include file="footer.tpl"}
