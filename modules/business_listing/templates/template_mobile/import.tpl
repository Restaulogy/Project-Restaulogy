{*****************************************

         Import Data Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='import'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
      {if $vs_current_admin.f_full}
 <form name="import_form" id="import_form" action="import.php" method="post" class="job_detail_view">
    {if $notice != ""}
	    	<div class="fail">
            {$notice}
            </div>
	{/if}
      <table width="100%">
       <tr>
        <th colspan="2">
          {lang->desc p1='import' p2=$lang_set p3='import_title'}
         </th>
       </tr>
       <tr>
        <td class="right_td">

          {lang->desc p1='import' p2=$lang_set p3='import_type'}
        </td>
        <td class="left_td">
  {if $import_type == "zip"}
          <input type="radio" style="width:25px;" name="import_type" value="list"> {lang->desc p1='import' p2=$lang_set p3='import_list'}
          <input type="radio" style="width:25px;"  name="import_type" value="zip" checked> {lang->desc p1='import' p2=$lang_set p3='import_zip'}
  {else}
          <input type="radio" style="width:25px;" name="import_type" value="list" checked> {lang->desc p1='import' p2=$lang_set p3='import_list'}
          <input type="radio" style="width:25px;" name="import_type" value="zip"> {lang->desc p1='import' p2=$lang_set p3='import_zip'}
  {/if}

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='import' p2=$lang_set p3='import_file'}
         </td>
        <td class="left_td">
          <input type="text" id="import_file" name="import_file" value="{$import_file}" class="required">
        </td>
       </tr>
       <tr>
      <td class="right_td">
          {lang->desc p1='import' p2=$lang_set p3='import_action'}
        </td>
        <td class="left_td">
  {if $import_action == "new"}
          <input type="radio" style="width:25px;" name="import_action" value="update"> {lang->desc p1='import' p2=$lang_set p3='action_update'}
          <input type="radio" style="width:25px;" name="import_action" value="new" checked> {lang->desc p1='import' p2=$lang_set p3='action_new'}
  {else}
          <input type="radio" style="width:25px;" name="import_action" value="update" checked> {lang->desc p1='import' p2=$lang_set p3='action_update'}
          <input type="radio" style="width:25px;" name="import_action" value="new"> {lang->desc p1='import' p2=$lang_set p3='action_new'}
  {/if}
          <br>

         <font style="color:red; font-size:8pt; font-weight:{#table_std_font_weight#}; background-color:{#table_std_font_bgcolor#};">
          {lang->desc p1='import' p2=$lang_set p3='warn_new'}
         </font>
          <br>
        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='import' p2=$lang_set p3='delim'}
        </td>
        <td class="left_td">
          <input type="text" id="delim" name="delim" size="3" value="{$delim}">
        </td>
       </tr>

       <tr>
        <th colspan="2" style="font-size:15px;">
          {lang->desc p1='import' p2=$lang_set p3='assign_list'}
         </th>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='userid'}<font color="red">*</font>
         </td>
        <td class="left_td">
          <input type="text" class="required" id="order_user"  name="order_user" size="3" value="{$user_num}">
        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='firm'}<font color="red">*</font>
        </td>
        <td class="left_td">
          <input  type="text" class="required" id="order_firm" id="order_firm"  name="order_firm" size="3" value="{$firm_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='address1'}
        </td>
        <td class="left_td">
          <input type="text" id="order_addr" name="order_addr" size="3" value="{$addr_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='zip'}
          </td>
            <td class="left_td"><input type="text" id="order_zipcode" name="order_zipcode" size="3" value="{$zipcode_num}">

        </td>
       </tr>
       <tr>
         <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='loc_sel'}
          </td>
           <td class="left_td">
          <input type="text" id="order_locsel"  name="order_locsel" size="3" value="{$loc_num}">
        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='loc1'}</td>
           <td class="left_td">
           <input type="text" id="order_loc1" name="order_loc1" size="3" value="{$loc1_num}">
        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='description'}
        </td>
          <td class="left_td">
          <input type="text" id="order_desc" name="order_desc" size="3" value="{$desc_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='contact'}
        </td>
          <td class="left_td">
          <input type="text" id="order_contact" name="order_contact" size="3" value="{$contact_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='phone'}
        </td>
          <td class="left_td">
          <input type="text" id="order_phone" name="order_phone" size="3" value="{$phone_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='fax'}
        </td>
          <td class="left_td">
          <input type="text" id="order_fax" name="order_fax" size="3" value="{$fax_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='mobile'}
        </td>
          <td class="left_td">
          <input type="text" id="order_mobile" name="order_mobile" size="3" value="{$mobile_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='email'}
         </td>
          <td class="left_td">
          <input type="text" id="order_email" name="order_email" size="3" value="{$email_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='website'}
        </td>
          <td class="left_td">
          <input type="text" id="order_web" name="order_web" size="3" value="{$web_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='state'}
        </td>
          <td class="left_td">
          <input type="text" id="order_state" name="order_state" size="3" value="{$state_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='level'}
        </td>
          <td class="left_td">
          <input type="text" id="order_level" name="order_level" size="3" value="{$level_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='xtra_1'}
        </td>
          <td class="left_td">
          <input type="text" id="order_xtra1" name="order_xtra1" size="3" value="{$xtra1_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='xtra_2'}
         </td>
          <td class="left_td">
          <input type="text" id="order_xtra2" name="order_xtra2" size="3" value="{$xtra2_num}">
         </font>
        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='xtra_3'}
        </td>
          <td class="left_td">
          <input type="text" id="order_xtra3" name="order_xtra3" size="3" value="{$xtra3_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='xtra_4'}
          </td>
          <td class="left_td">
          <input type="text" id="order_xtra4" name="order_xtra4" size="3" value="{$xtra4_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='xtra_5'}
          </td>
          <td class="left_td">
          <input type="text" id="order_xtra5" name="order_xtra5" size="3" value="{$xtra5_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='xtra_6'}
          </td>
          <td class="left_td">
          <input type="text" id="order_xtra6" name="order_xtra6" size="3" value="{$xtra6_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_list' p2=$lang_set p3='premium'}
          </td>
          <td class="left_td">
          <input type="text" id="order_prem" name="order_prem" size="3" value="{$prem_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_listcat' p2=$lang_set p3='cat_id'}</td>
          <td class="left_td">
          <input type="text" id="order_cat" name="order_cat" size="3" value="{$cat_num}">

        </td>
       </tr>
       <tr>
        <th colspan="2" style="font-size:15px;">
          {lang->desc p1='import' p2=$lang_set p3='assign_zip'}
		</th>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_locrelate' p2=$lang_set p3='zip'}<font color="red">*</font></td>
          <td class="left_td">
          <input type="text" class="required" id="order_zip" name="order_zip" size="3" value="{$zip_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_locrelate' p2=$lang_set p3='loc_prim'}<font color="red">*</font></td>
          <td class="left_td">
          <input type="text" class="required" id="order_loc_prim" name="order_loc_prim" size="3" value="{$prim_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_locrelate' p2=$lang_set p3='loc_sec'}</td>
          <td class="left_td">
          <input type="text" id="order_loc_sec" name="order_loc_sec" size="3" value="{$sec_num}">

        </td>
       </tr>
       <tr>
       <td class="right_td">
          {lang->desc p1='pds_locrelate' p2=$lang_set p3='lat'}<font color="red">*</font></td>
          <td class="left_td">
          <input type="text" class="required" id="order_lat" name="order_lat" size="3" value="{$lat_num}">

        </td>
       </tr>
       <tr>
        <td class="right_td">
          {lang->desc p1='pds_locrelate' p2=$lang_set p3='lon'}<font color="red">*</font>
          </td>
          <td class="left_td">
          <input type="text" class="required" id="order_lon" name="order_lon" size="3" value="{$lon_num}">
          </td>
       </tr>
       <tr>
        <td align="center" colspan="2">

          <input type="submit" name="btn_import" value="{lang->desc p1='import' p2=$lang_set p3='btn_import'}"  class="blackbutton" style="width:100px;">

        </td>
       </tr>
      </table>
     </form>
{/if}
 {literal}

        <script type="text/javascript">

    function filterFileType(field) {
if ((field.value.indexOf('.' + 'png') == -1) && (field.value.indexOf('.' + 'jpg') == -1) && (field.value.indexOf('.' + 'gif') == -1) )  {
alert('Your uploaded file must be in .gif|.png|.jpg Format\nPlease select again.');
field.focus();
return false;
}
return true;
}

    jQuery.validator.addMethod("phoneUS", function(phone_number, element) {

    phone_number = phone_number.replace(/\s+/g, "");

	return this.optional(element) || phone_number.length > 9 &&

		phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);

}, "Please specify a valid phone number");


jQuery.validator.addMethod("numeric", function(value, element) {
	return this.optional(element) || /^[0-9]+$/.test(value);
}, "Please specify a valid number");


		jQuery.fn.maxLength = function(max){
	this.each(function(){
		//Get the type of the matched element
		var type = this.tagName.toLowerCase();
		//If the type property exists, save it in lower case
		var inputType = this.type? this.type.toLowerCase() : null;
		//Check if is a input type=text OR type=password
		if(type == "input" && inputType == "text" || inputType == "password"){
			//Apply the standard maxLength
			this.maxLength = max;
		}
		//Check if the element is a textarea
		else if(type == "textarea"){
			//Add the key press event
			this.onkeypress = function(e){
				//Get the event object (for IE)
				var ob = e || event;
				//Get the code of key pressed
				var keyCode = ob.keyCode;
				//Check if it has a selected text
				var hasSelection = document.selection? document.selection.createRange().text.length > 0 : this.selectionStart != this.selectionEnd;
				//return false if can't write more
				return !(this.value.length >= max && (keyCode > 50 || keyCode == 32 || keyCode == 0 || keyCode == 13) && !ob.ctrlKey && !ob.altKey && !hasSelection);
			};
			//Add the key up event
			this.onkeyup = function(){
				//If the keypress fail and allow write more text that required, this event will remove it
				if(this.value.length > max){
					this.value = this.value.substring(0,max);
				}
			};
		}
	});
};


             jQuery.fn.ForceNumericOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                        return (
                            key == 8 ||
                            key == 9 ||
                            key == 46 ||
                            (key >= 37 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 96 && key <= 105));
                    })
                })
            };

 			jQuery.fn.ForcephoneOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                        return (
                            key == 8 ||
                            key == 9 ||
                            key == 46 ||
                            key == 32 ||
                            key == 109 ||
                            key == 189 ||
                            (key >= 37 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 96 && key <= 105));
                    })
                })
            };

            jQuery.fn.ForceAlphaNumericOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                        return (
                            key == 8 ||
                            key == 9 ||
                            key == 46 ||
							key == 32 ||
                            (key >= 37 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 65 && key <= 90) ||
                            (key >= 97 && key <= 122) ||
                            (key >= 96 && key <= 105));
                    })
                })
            };

            jQuery.validator.addMethod("money", function(value, element) {
                 return this.optional(element) || /^(\d{1,3})(\.\d{2})$/.test(value);
             }, "Must be in US currency format 0.99");

            jQuery.validator.classRuleSettings.money = {money: true};

			$(document).ready(function()
			{


    			$('#firm').focus();
				$('#fax').maxLength(20);
                $("#phone").maxLength(20);
                $("#mobile").maxLength(20);
                $("#zip").maxLength(10);
                $("#firm").maxLength(100);
                $('#website').maxLength(100);
                $('#listmail').maxLength(100);
                $("#description").maxLength(500);
                $("#addr1").maxLength(500);
                $("#loc1").maxLength(100);
                $("#contact").maxLength(60);
                $("#phone").ForcephoneOnly();
                $("#mobile").ForcephoneOnly();
                $('#fax').ForcephoneOnly();
                $("#zip").ForceNumericOnly();
                $("#firm").ForceAlphaNumericOnly();
                //$("#description").ForceAlphaNumericOnly();
                $("#addr1").ForceAlphaNumericOnly();
                $("#loc1").ForceAlphaNumericOnly();
                //$("#salary").ForceNumericOnly();
                //$("#salary").ForceNumericOnly();



				$("#import_form").validate({
					rules: {
						firm: 	{ required: true },
						phone:	{ phoneUS: true } ,
						mobile:	{ phoneUS: true },
						fax:	{ phoneUS: true },
						zip : 	{ numeric: true }
					},
                   messages: {
 	                  firm: "Please enter a Firmname" ,
 	                  description: "Please enter a Description",
					  phone: "Please enter proper US format phone no" ,
					  mobile: "Please enter proper US format Mobile no",
					  fax: "Please enter proper US format fax no",
					  zip : "Please enter a proper Zip Code"/*,
 	                 listmail: "Please enter Email"*/
 	               }
				});

			 });
		</script>
		{/literal}

{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
