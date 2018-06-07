{assign var=user_promotion value=$list[itm].user_promotion}
<div id="dialog-message{$list[itm].id}">
<div id="dialog_tab{$list[itm].id}" style="width:580px; border:none !important;">
<ul style="width:580px;">
	 <li>
	 	<a href="#listing_info{$list[itm].id}"  style="padding:2px;font-size:11px;">
		 	Business Information
	 	</a>
	 </li>
	 {section name=pitm max=2 loop=$user_promotion}
	 	<li>
		 	<a href="#promotion_info{$user_promotion[pitm].id}"  style="padding:2px;font-size:11px;">
			 	Promotion#{$smarty.section.pitm.iteration}
			 </a>
		 </li>
	 {/section}
	 
</ul>
	<div id="listing_info{$list[itm].id}">
      <table style="width:570px;font-size:10px;margin-left:-10px;">
       <tr>
        <td style="width:100px;"><b>Company</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4">{$list[itm].firm}</td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>State</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$list[itm].states}</td>
        <td style="width:100px;"><b>Metro Area</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$list[itm].metro_area_name}</td>
       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>Address</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"> {$list[itm].strip_address}</td>

       </tr>
        <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>Website</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"><a href="{$list[itm].website}" target="_blank">{$list[itm].website}</a></td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
       <td colspan="6">
        <table style="width:570px;font-size:10px;margin-left:-3px;">
            <tr>
                <td style="width:40px;"><b>Phone</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list[itm].phone}</td>
                <td style="width:40px;"><b>Cell</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list[itm].mobile}</td>
                <td style="width:40px;"><b>Fax</b></td>
                <td style="width:5px;">:</td>
                <td style="width:125px;">{$list[itm].fax}</td>
            </tr>
        </table>
       </td>
       </tr>
     </table>
	</div>
	{section name=pitm max=2 loop=$user_promotion}
	<div id='promotion_info{$user_promotion[pitm].id}'>
        <table style="width:570px;font-size:10px;margin-left:-10px;">
       <tr>
        <td style="width:100px;"><b>Title</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"> {$user_promotion[pitm].title}</td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>State</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].states_name}</td>
        <td style="width:100px;"><b>Metro Area</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].metro_area_name}</td>
       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>From</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].start_date|date_format:"%D"}</td>
        <td style="width:100px;"><b>Until</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].end_date|date_format:"%D"}</td>
       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>

       </tr>
     </table>
	</div>
	{/section}
</div>
 </div>
