{*****************************************

       Online Mailbox Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='mailbox'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
<center>
	<br>
	 <div style="width:90%; color:#17a; border:1px solid #e4e9ee; background:#f4f9fe; line-height:30px;	text-transform: capitalize;" ><b>{lang->desc p1='mailbox' p2=$lang_set p3='mailbox'}</b> {lang->desc p1='mailbox' p2=$lang_set p3='for'} &nbsp;{php} echo $_SESSION['user']->name; {/php} <!-- {lang->desc p1='mailbox' p2=$lang_set p3='for'}{$vs_current_user.login} -->
	</div>
  {if $notice != ""}
    <div class="fail">
	  {$notice}
	</div>
  {/if}
	<br>
{if $page == 'view'}
   <table class="myTABLE"    cellspacing="0" cellpadding="2" border="1" width="100%">
    <tr style="background:#b1d8fe;"  class="column1">
     <td align="left" width="70px"><b>{lang->desc p1='mailbox' p2=$lang_set p3='from'}</b></td>
     <td align="left" width="200px"><b>{lang->desc p1='mailbox' p2=$lang_set p3='subject'}</b></td>
     <td align="left" width="105px"><b>{lang->desc p1='mailbox' p2=$lang_set p3='date'}</b></td>
     <td align="left" width="85px"><b>{lang->desc p1='mailbox' p2=$lang_set p3='action'}</b></td>
	</tr>
    <tr>
      <td class="column1" align="left" width="70px"><a href="mailto:{$message.surfer_from}<{$message.email}>">{$message.surfer_from}</a></td>
     <td class="column1" align="left" width="200px">{$message.subject}</td>
     <td class="column1" align="left" width="105px">{$message.date_sent}</td>
     <td class="column1" align="center" width="85px"><a href="#" onclick="window.open('mailprint.php?mid={$message.id}','printWindow','width=500,height=500,toolbar=no,location=no,resizable=yes,left=80,screenx=80,top=80,screeny=80')"><img src="templates/{$deftpl}/images/printer.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='print'}" border="0"></a>&nbsp;<a href="mailbox.php?req=del&amp;mid={$message.id}&amp;o={$order}"><img src="templates/{$deftpl}/images/bin_empty.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='remove_message'}" border="0"></a>&nbsp;<a href="mailbox.php?req=spam&amp;mid={$message.id}&amp;o={$order}"><img src="templates/{$deftpl}/images/email_error.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='report_abuse'}" border="0"></a></td>
	</tr>
	<tr>
     <td class="column1" colspan="4" >{$message.body}</td>
	</tr>
	<tr class="odd">
     <td class="column1" colspan="4" align="left">{lang->desc p1='mailbox' p2=$lang_set p3='from_listing'}: ({$message.listing_id}) {$message.firmname}</td>
	</tr>
   </table>
   <center><input class="blackbutton" type="button" value="Mailbox"  onclick="document.location.href='mailbox.php?req=browse&amp;o={$order}'"></center>

{else}
   <table class="myTABLE" cellspacing="0" cellpadding="2" border="0" width="100%">
  {if count($list)}
    <tr style="background:#b1d8fe;" class="column1">
     <td align="left" width="5px">&nbsp;</td>
     <td align="left" width="70px">{$sort_from}</td>
     <td align="left" width="200px">{$sort_subj}</td>
     <td align="left" width="105px">{$sort_date}</td>
     <td align="left" width="85px"><b>{lang->desc p1='mailbox' p2=$lang_set p3='action'}</b></td>
	</tr>
    {section name=itm loop=$list}
    <tr >
     <td class="column1"  align="center" width="5px">{$list[itm].mail_type}</td>
     <td class="column1"  align="left" width="70px"><a href="mailto:{$list[itm].surfer_from}<{$list[itm].email}>">{$list[itm].surfer_from}</a></td>
     <td class="column1" align="left" width="200px"><a href="mailbox.php?req=view&amp;mid={$list[itm].id}&amp;o={$order}">{$list[itm].subject}</a></td>
     <td class="column1" align="left" width="105px">{$list[itm].date_sent}</td>
     <td class="column1" align="center" width="85px"><a href="mailbox.php?req=view&amp;mid={$list[itm].id}&amp;o={$order}"><img src="templates/{$deftpl}/images/view.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='view_message'}" border="0"></a>&nbsp;<a href="#" onclick="window.open('mailprint.php?mid={$list[itm].id}','printWindow','width=500,height=500,toolbar=no,location=no,resizable=yes,left=80,screenx=80,top=80,screeny=80')"><img src="templates/{$deftpl}/images/printer.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='print'}" border="0"></a>&nbsp;<a href="mailbox.php?req=del&amp;mid={$list[itm].id}&amp;o={$order}"><img src="templates/{$deftpl}/images/bin_empty.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='remove_message'}" border="0"></a></td>
	</tr>
    {/section}
    <tr>
     <td  width="100%" class="column1"  colspan="5">
		<center>
	  <b>{lang->desc p1='mailbox' p2=$lang_set p3='key'}</b><br><img src="templates/{$deftpl}/images/email.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='unread'}" border="0"> {lang->desc p1='mailbox' p2=$lang_set p3='unread'} &nbsp; &nbsp; <img src="templates/{$deftpl}/images/email_open.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='read'}" border="0"> {lang->desc p1='mailbox' p2=$lang_set p3='read'}&nbsp; &nbsp; <img src="templates/{$deftpl}/images/email_error.png" alt="{lang->desc p1='mailbox' p2=$lang_set p3='reported'}" border="0"> {lang->desc p1='mailbox' p2=$lang_set p3='reported'}
	    </center>
	 </td>
	</tr>
    
  {else}
    <div class="fail">
      {lang->desc p1='mailbox' p2=$lang_set p3='no_mail'}
	</div>
  {/if}
  </table>
{/if}
</center>
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
