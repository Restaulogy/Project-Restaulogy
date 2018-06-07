<body>
<center>
<br>
<table width="800">
  <tr>
    <td width="75">&nbsp;</td>
    <td align="left" width="650">
        {include file="header_note.tpl"}
    </td>
    <td width="75">&nbsp;</td>
  </tr>
</table>
<table width="800">
  <tr>
   <td width="75">&nbsp;</td>
    <td align="left"  bgcolor="#fffdf9" width="650">
        {include file="container_top.tpl"}

	   <div style="margin:10px;">
            {include file="section_biz_info.tpl"}
    	<div>

    	<center>{include file="line_break.tpl"}
        	{if $info.template_content.image && $info.template_content.image neq ""}
    		    {$info.template_content.image_box} 
            {/if}
        </center>
        
        <div style="font-size: 16px; line-height: 20px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; text-align:left justify !important; margin:15px;">
        <b style="font-size: 18px;line-height: 30px;">Description:</b><br>
 {$info.template_content.description|replace:'\r\n':'<BR>'|replace:"'":"'"|replace:'"':'"'}

		</div>
 		<center>{include file="line_break.tpl"}</center>
    </td>
    <td width="75">&nbsp;</td>
  </tr>
</table>
<table width="800">
  <tr>
    <td width="75">&nbsp;</td>
    <td align="left" width="650">
        {include file="footer_note.tpl"}
    </td>
    <td width="75">&nbsp;</td>
  </tr>
</table>
</center>
