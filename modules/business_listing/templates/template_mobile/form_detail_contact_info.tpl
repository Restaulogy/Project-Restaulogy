<table class="job_detail_panal_table">
<tr>
		<td class="detail_right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='contact'}
		    {if $required.contact}
		           <font color={#required_field_color#}>
		            {#required_field_ind#}
		           </font>
		     {/if}
		</td>
		<td class="detail_left_td">
            <input type=text id="contact" name="contact" value="{if $contact}{$contact}{else}{$smarty.post.contact}{/if}">
            <div class="extra_info">eg.'Your Name'</div>
		</td>
</tr>
<tr><td colspan="2"><span id="contact_error" class="form_error"></span></td></tr>
 <tr>
		<td class="detail_right_td" style='width:120px;'>
            Address : <br>
            c/o, Street address, PO Box, apartment, unit, building, floor, etc
		    {if $required.address1}
		           <font color={#required_field_color#}>
		            {#required_field_ind#}
		           </font>
		     {/if}
        </td>
        <td class="detail_left_td" colspan="5">
        	<textarea cols="75" rows="3" id="addr1" name="addr1">{if $addr1}{$addr1}{else}{$smarty.post.addr1}{/if}</textarea>
	        <br/>
        </td>
	</tr>
	<tr><td colspan="2"><span id="addr1_error" class="form_error"></span></td></tr>
 	<tr>
		<td class="detail_right_td" style='width:120px;'>
        	*City
        </td>
		<td class="detail_left_td" colspan="2">
			<input type=text id="loc1" class="required" name="loc1" value="{if $loc1}{$loc1}{else}{$smarty.post.loc1}{/if}">
		 	<div class="extra_info"  id="loc1_extra_info">eg.'Phoenix'</div>
		</td>
	</tr>
	<tr><td colspan="2"><span id="loc1_error" class="form_error"></span></td></tr>
	
	<tr>
        <td class="detail_right_td" style='width:120px;'>
    		*States <Br>
        </td>
        <td class="detail_left_td" id="states_box" colspan="2">
    		<select id="xtra_4" name="xtra_4">
                <option value="0">Select States</option>
                {if $current_states_list}
                    {section name=sitm loop=$current_states_list}
                        <option value="{$current_states_list[sitm].id}" {if  $current_states_list[sitm].id == $xtra_4 || $current_states_list[sitm].id== $smarty.post.xtra_4}selected="selected"{/if}>{$current_states_list[sitm].name}</option>
                    {/section}
                {/if}
            </select>
            <div class="extra_info">eg.'Arizona'</div>
        </td>
	</tr>
	<tr>
	 <td class="detail_right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='zip'}
		</td>
		<td class="detail_left_td">
			<input type=text id="zip" name="zip" maxLength="10" style="width:120px;" value="{if $zip}{$zip}{else}{$smarty.post.zip}{/if}">
			<div class="extra_info" id="zip_extra_info"> eg.'XXXXX' Or 'XXXXX-XXXX'</div>
        </td>
	</tr>
	<tr><td colspan="2"><span id="zip_error" class="form_error"></span></td></tr>

	<tr style="display:none;">
		<td class="detail_right_td">
            Country :
		</td>
		<td class="detail_left_td" >
            {$country_name}
		</td>
	</tr>
	<tr><td colspan="2"><span id="country_error" class="form_error"></span></td></tr>
	<tr>
		<td class="detail_right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='phone'}
		    {if $required.phone}
		           <font color={#required_field_color#}>
		            {#required_field_ind#}
		           </font>
		     {/if}
		</td>
		<td class="detail_left_td">
            <input type=text align="left" id="phone" style="width:120px;" name="phone" value="{if $phone}{$phone}{else}{$smarty.post.phone}{/if}"/>
			<div class='extra_info'  id="phone_extra_info"> eg. 'XXX-XXX-XXXX'</div>
		</td>
	</tr>
	<tr><td colspan="2"><span id="phone_error" class="form_error"></span></td></tr>
	<tr>
		<td class="detail_right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='fax'}
            {if $required.fax}
                   <font color={#required_field_color#}>
                    {#required_field_ind#}
                   </font>
             {/if}
		</td>
		<td class="detail_left_td">
            <input type=text id="fax" name="fax" style="width:120px;" value="{if $fax}{$fax}{else}{$smarty.post.fax}{/if}">
            <div class='extra_info'  id="fax_extra_info"> eg. 'XXX-XXX-XXXX'</div>
		</td>
		</tr>
        <tr><td colspan="2"><span id="fax_error" class="form_error"></span></td></tr>
    	<tr>
		<td class="detail_right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='mobile'}
            </font>
            {if $required.mobile}
                   <font color={#required_field_color#}>
                    {#required_field_ind#}
                   </font>
             {/if}
		</td>
		<td class="detail_left_td">
            <input type=text id="mobile" name="mobile" style="width:120px;" value="{if $mobile}{$mobile}{else}{$smarty.post.mobile}{/if}">
            <div class='extra_info'  id="mobile_extra_info"> eg. 'XXX-XXX-XXXX'</div>
		</td>
    </tr>
    <tr><td colspan="2"><span id="mobile_error" class="form_error"></span></td></tr>
    <tr>
		<td class="detail_right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='email'}
            {if $required.listmail}
               <font color={#required_field_color#}>
                {#required_field_ind#}
               </font>
            {/if}
        </td>
        <td class="detail_left_td">
            <input type=text class="email" id="listmail" name="listmail" value="{if $listmail}{$listmail}{else}{$smarty.post.listmail}{/if}">
             <div class="extra_info">eg.'yourname@mail.com'</div>
        </td>
    </tr>
    <tr><td colspan="2"><span id="listmail_error" class="form_error"></span></td></tr>
</table>
