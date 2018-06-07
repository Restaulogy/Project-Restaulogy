<table style="background-color: #fffdf9;" width="684" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="173">
			<!--ribbon-->
			<table border="0" cellspacing="0" cellpadding="0" style="background:transparent url('{$elgg_theme_url}/images/ribbon.jpg') 40px top  no-repeat;">
			<tr>
				<td height="120" width="35"></td>
				<td  valign="top"   height="120" width="90" style="color:#FFF;font-size:14px;padding-top:5px;">
				    <center>
						<b>Deal</b><br/>
						<b style="font-size:36px;">#</b>

					</center>

				</td>
			</tr>
			</table>
			<!--ribbon-->
		</td>
		<td valign="middle" width="493">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="5"></td>
				</tr>
				<tr>
					<td>
					<h1 style="color: {$ELGG_ORANGE}; margin-top: 0px; margin-bottom: 0px; font-weight: normal; font-size:30px; font-family: Georgia, 'Times New Roman', Times, serif">{$info.template_content.title}</h1>
					
					</td>
				</tr>
				
				<tr>
					<td height="40" style="font-size: 14px;">
						for <b style="color:#281779;">{$info.template_content.metro_area}</b>
					</td>
				</tr>
			</table>
			<!--date-->

			 <table style="background:#312c26 url({$elgg_theme_url}/images/date-bg.jpg);">
			 	<tr>
				<td width="350" height="39" style="font-size: 16px;font-family: Georgia, 'Times New Roman', Times, serif; color: #ffffff; line-height:30px; ">
              		<center>
                 			valid upto {$info.template_content.end_date|date_format:"%e, %B"}
             		</center>
             		</td>
				</tr>
			 </table>
			 
			 <!--/date-->
		</td>
		<td width="18"></td>
	</tr>
	</table>
	 
	</td>
    </tr>
</table><!--/header-->
