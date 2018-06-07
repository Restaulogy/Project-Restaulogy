<table style="width:600px;margin-left:10px;background-color:#F5F5F5;border-collapse:collapse;font-family:Verdana;font-size:12px;text-align:center !important;border:1px solid #EAEAEA;">
    <tr>
        <td style="background:#E4E4E4;border-bottom:#D4D4D4 1px ridge;">
                        {$header_img}
			<br>
            <div style='color:gray;font-weight:bolder;font-size:10px;'>{$vdate}</div>
        </td>
	</tr>
		<tr>
			<td >
				<table style="font-family:Verdana;font-size:12px !important;text-align:center !important;width:600px;">

                    <tr>
						<td>
                        <h3 style='color:Green;'>You are cordially invited by</h3>
                        </td>
					</tr>
					<tr>
                        <td>
                        <center>
                        <table>
                            <tr>
                                <td>
                                    <img style='width:50px;height:50px;' src='{$sel_user->getIcon('large')}'/>
                                </td>
                                <td>
                                 <span style='font-size:16px;color:Orange;'>{$sel_user->name}</span><br>       <span style='font-size:10px;color:Gray;'>{$sel_user->location},{$sel_user->user_state}</span><br>
                                 <span style='font-size:10px;color:Gray;'>{$sel_user->email}</span>
                                </td>
                            </tr>
                        </table>
                        </center>
                        </td>
					</tr>
				</table>
			</td>
		</tr>
        <tr>
			<td><center>
                  {$content}
                </center>
			</td>
		</tr>
		<tr>
            <td style="padding:10px;">
                {$tpl_img}
			</td>
		</tr>
		<tr>
			<td style="height:10px;"></td>
		</tr>
		<tr>
			<td style="background:#E4E4E4;border-top:#D4D4D4 1px ridge;"><h3 style='color:green;'>....Event Invitation....</h3> <br><small style='color:gray;font-weight:bolder;font-size:10px;'>Be sure to add {$elgg_site_mail} to your address book or safe sender list so our emails get to your inbox.</small>
            </td>
		</tr>
	</table>
<br/>
