 <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Courier, 'Monaco', monospace; ">
	<tr>
	<td width="135" style="font-size: 1px; font-family: Courier, 'Monaco', monospace;padding: 25px 0 0;" align="left" valign="top"><img src="{$elgg_theme_url}/images/img_deco_1.png" alt="decoration" width="114" height="96"></td>
	<td width="465" valign="top" align="left" style="font-family: Courier, 'Monaco', monospace;" class="content">
		<table cellpadding="0" cellspacing="0" border="0"  style="color: #000; font: normal 11px Courier, 'Monaco', monospace; margin: 0; padding: 0;" width="465">

		<tr>
			<td style="padding: 20px 0 25px;" align="left">
				<h2 style="color:{$ELGG_ORANGE} !important; font-weight: bold; line-height: 35px; font-size: 31px;">{$info.template_content.title}</h2>
				<p style="font-size: 16px;">
                    Deal for <b>{$info.template_content.metro_area}</b><br/>
                    Valid Upto <b>{$info.template_content.end_date|date_format:"%e, %B"}</b>
                </p>
			</td>
		</tr>
		</table>
	</td>

  </tr>
  <tr>
    <td width="600" colspan="2">
        <table cellspacing="0" border="0" cellpadding="0" width="100%">

    <tr>
        <th colspan="2" align="left" style="font-size:24px;font-weight:bold;color:{$ELGG_BLUE} !important;padding-bottom:5px;">{$theme_lang.biz_info_lable}</th>
    </tr>
  <tr>
    <td valign="top" width="378">

    <p style="font-size: 16px;">
{if $info.template_content.firm && $info.template_content.firm neq "" && $info.template_content.firm|strlen gt 0}
        {if $info.template_content.firm_link}<a href="{$info.template_content.firm_link}" target="_blank">{/if}
            <b>{$info.template_content.firm}</b>
        {if $info.template_content.firm_link}</a>{/if}
        <br/>
    {/if}

    {if $info.template_content.firm_contact && $info.template_content.firm_address neq "" && $info.template_content.firm_address|strlen gt 0}
        {$info.template_content.firm_contact}<br/>
    {/if}
    {if $info.template_content.firm_address && $info.template_content.firm_address neq "" && $info.template_content.firm_address|strlen gt 0}
        {$info.template_content.firm_address}<br/>
    {/if}
    {if $info.template_content.firm_city && $info.template_content.firm_city neq "" && $info.template_content.firm_city|strlen gt 0}
        {$info.template_content.firm_city}<br/>
    {/if}
    {if $info.template_content.firm_metro_area && $info.template_content.firm_metro_area neq "" && $info.template_content.firm_metro_area|strlen gt 0}
        {$info.template_content.firm_metro_area} -
    {/if}
    {if $info.template_content.firm_state && $info.template_content.firm_state neq "" && $info.template_content.firm_state|strlen gt 0}
        {$info.template_content.firm_state}<br>
    {/if}
    {if $info.template_content.firm_country && $info.template_content.firm_country neq "" && $info.template_content.firm_country|strlen gt 0}
        {$info.template_content.firm_country}
    {/if}
    {if $info.template_content.firm_zip && $info.template_content.firm_zip neq "" && $info.template_content.firm_zip|strlen gt 0}
         {$info.template_content.firm_zip}<br/>
    {/if}

    {if $info.template_content.firm_phone && $info.template_content.firm_country neq "" && $info.template_content.firm_country|strlen gt 0}
        {$info.template_content.firm_phone}<br/>
    {/if}

    {if $info.template_content.firm_email}
        <a href="mailto:{$info.template_content.firm_email}">{$info.template_content.firm_email}</a><br/>
    {/if}

    {if $info.template_content.firm_website}
        <a href="{$info.template_content.firm_website}" target="_blank">{$info.template_content.firm_website}</a><br/>
    {/if}

    {if $info.template_content.firm_map_link}
        <a href="{$info.template_content.firm_map_link}" target="_blank">Map</a><br/>
	{/if}

	 </p>
    </td>
    <td valign="top" width="246"><a href="{$info.template_content.promotion_link}" target="_blank"><img src="{$info.template_content.firm_logo}" align="right" alt="logo" style="border: solid 1px #FFF;float: right;max-height:150px;max-width:180px;display:block;"/></a></td> 
  </tr>
</table>
    </td>
  </tr>
</table><!-- body -->
