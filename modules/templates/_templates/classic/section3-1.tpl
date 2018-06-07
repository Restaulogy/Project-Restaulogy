<table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td valign="top">
    <h1 style="font-size: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333333; margin-top: 0px; margin-bottom: 12px;">User Message</h1>
    <p style="font-size: 16px; line-height: 22px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;"> 
		<?php echo $info['user']['message']; ?>
	</p>
    
	<table>
		<td  valign="top">
			<a target="_blank" href="<?php echo $info['user']['url']; ?>"><img height="50" width="50"/></a>
		</td>
		<td valign="top">
			<table>
				<tr>
					<td><?php echo $info['user']['name']; ?></td>
				</tr>
				<tr>
					<td><a href="mailto:<?php echo $info['user']['email']; ?>"><?php echo $info['user']['email']; ?></a></td>
				</tr>
				 
			</table>
		</td>
	</table> 
	 
	</td>
  </tr>
</table>
