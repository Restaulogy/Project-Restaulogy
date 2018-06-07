{*****************************************

         Print mail Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='empty'}
{*****************************************

   Page Display

******************************************}
<html>
 <head>
  <title>{lang->desc p1='mailbox' p2=$lang_set p3='print_message'}</title>
 </head>
 <body style="font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif">
   <table cellspacing="0" cellpadding="2" border="0" width="100%">
{if count($message)}
    <tr>
     <td colspan="2" align="left" width="100%">
	  <font style="font-size: 8pt">
	   <b>{lang->desc p1='mailbox' p2=$lang_set p3='from'}:</b> {$message.surfer_from} <{$message.email}><br>
	   <b>{lang->desc p1='mailbox' p2=$lang_set p3='subject'}:</b> {$message.subject}<br>
	   <b>{lang->desc p1='mailbox' p2=$lang_set p3='date'}:</b> {$message.date_sent}
      </font>
	 </td>
	</tr>
    <tr>
     <td colspan="2" align="left" width="100%">&nbsp;</td>
	</tr>
	<tr>
     <td colspan="2" align="left" width="100%">
	  <font style="font-size: 8pt">
       {$message.body}
      </font>
     </td>
	</tr>
    <tr>
     <td colspan="2" align="left" width="100%">&nbsp;</td>
	</tr>
	<tr>
     <td align="left" width="100%">
	  <font style="font-size: 8pt">
       <a href=# onclick="window.print()" style="text-decoration: none"><img src="templates/{$deftpl}/images/printer.png" border="0">{lang->desc p1='mailbox' p2=$lang_set p3='print_message'}</a>
      </font>
     </td>
	 <td align="right">
      <button type="button" onClick="window.close()"><font style="font-size: 8pt">{lang->desc p1='mailbox' p2=$lang_set p3='close_window'}</font></button>
	 </td>
	</tr>
{else}
	<tr>
     <td align="center" width="100%">
	  <font style="font-size: 8pt">
       {lang->desc p1='mailbox' p2=$lang_set p3='not_found'}
      </font>
     </td>
	</tr>
{/if}
   </table>
 </body>
</html>