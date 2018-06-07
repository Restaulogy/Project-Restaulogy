<table id="tbl_middle">
      <tr>
            <th>
                {$theme_lang.biz_info_lable}
            </th>
      </tr>
      <tr>
            <td id="sepertor">&nbsp;</td>
      </tr>
      <tr>
            <td>
                 <table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td valign="top" width="378">



    <p>
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
    <td valign="top" width="246"><a href="{$info.template_content.promotion_link}" target="_blank"><img src="{$info.template_content.firm_logo}" align="right" alt="logo" style="border: solid 1px #FFF;float: right;max-height:150px;max-width:180px;display:block;" /></a></td>
  </tr>
</table>
            </td>
      </tr>
      <tr>
            <td id="sepertor">&nbsp;</td>
      </tr>
</table>

