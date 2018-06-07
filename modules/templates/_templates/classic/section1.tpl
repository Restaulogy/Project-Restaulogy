<!--section 1-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td valign="top">
	{if $info.template_content.image && $info.template_content.image neq ""}
    <img src="{$info.template_content.image}" alt="image dsc" style="border: solid 1px #FFF; box-shadow: 2px 2px 6px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 2px 2px 6px #333; -moz-box-shadow: 2px 2px 6px #333;" width="622" />
    {/if}
	<center><h1 style="font-size: 36px; font-weight: normal; color: #333333; font-family: Georgia, 'Times New Roman', Times, serif; margin-top: 0px; margin-bottom: 20px;">Description</h1></center>
    <p style="font-size: 16px; line-height: 22px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"> 
	{$info.template_content.description|replace:'\r\n':'<BR>'|replace:"'":"'"|replace:'"':'"'}</p>

    {include file="line_break.tpl"}
    </td>
  </tr>
</table><!--/section 1-->
