
<html>
<head>
<title>Very Helvetica</title>
     {include file="css.tpl"}
</head>
<body>

<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        {include file="header.tpl"}
        </center>
         </td>
    </tr>
</table>
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        {include file="middle/biz_info.tpl"}
        </center>
         </td>
    </tr>
</table>
{if $info.template_content.image && $info.template_content.image neq ""}
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
         {$info.template_content.image_box}
        </center>
         </td>
    </tr>
</table>
{/if}
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        {include file="middle/description.tpl"}
        </center>
         </td>
    </tr>
</table>
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        {include file="footer.tpl"}
        </center>
         </td>
    </tr>
</table>
</body>
</html>
