	{if $notice != ""}
	    	<div class="fail">
            {$notice}
            </div>
	{/if}
	
        <form  class="job_detail_view"  id="register_form0"  action="register.php" method="post">
         <table  width=100% align=center cellpadding=5 cellspacing=0>
          <tr>
           <th colspan="2">
             {lang->desc p1='register' p2=$lang_set p3='step_reg'}
           </th>
         </tr>

         <tr>
          <td class="right_td">
            {lang->desc p1='pds_user' p2=$lang_set p3='login'}:
           <font color={#required_field_color#}>
            {#required_field_ind#}
           </font>
          </td>
          <td class="left_td">
            <input class="required" id="login" type=text name="login" value="{$login}">
           </font>
          </td>
         </tr>
         <tr>
           <td class="right_td">
           {lang->desc p1='pds_user' p2=$lang_set p3='usermail'}:
           <font color={#required_field_color#}>
            {#required_field_ind#}
           </font>
          </td>
           <td class="left_td">
            <input class="required email" id="usermail" type=text name="usermail" value="{$usermail}">
          </td>
         </tr>
         <tr>
           <td class="right_td">
            {lang->desc p1='pds_user' p2=$lang_set p3='pass'}:

           <font color={#required_field_color#}>
            {#required_field_ind#}
           </font>
          </td>
           <td class="left_td">
            <input class="required" id="pass"  type=password name="pass" value="{$pass}">
           </font>
          </td>
         </tr>
         <tr>
           <td class="right_td">
            {lang->desc p1='register' p2=$lang_set p3='vpass'}:
           <font color={#required_field_color#}>
            {#required_field_ind#}
           </font>
          </td>
          <td class="left_td">
            <input class="required" id="vpass"  type=password name="vpass" value="{$vpass}">
           </font>
          </td>
         </tr>
         <tr>
          <td colspan=2 >
           <font color={#required_field_color#}>
            {#required_field_ind#}
           </font>
           <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
  {if $agree_term}
            <input type=checkbox name=agree_term value=1 checked> {lang->desc p1='register' p2=$lang_set p3='agree_terms'}
  {else}
            <input type=checkbox name=agree_term value=1> {lang->desc p1='register' p2=$lang_set p3='agree_terms'}
  {/if}
             <a href=templates/{$deftpl}/terms.htm target=_blank>{lang->desc p1='register' p2=$lang_set p3='terms_link'}</a>
           </font>
          </td>
         </tr>
         <tr>
          <td colspan=2 valign=top align=center bgcolor="{#form_label_bgcolor#}">
           <font style="color:{#form_label_font_color#}; font-size:8pt; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
            {lang->desc p1='register' p2=$lang_set p3='already_reg'} <a href="./user.php">{lang->desc p1='register' p2=$lang_set p3='sign_in'}</a>
           </font>
          </td>
         </tr>
         <tr>
          <td colspan=2 valign=top align=center bgcolor="{#form_btn_bgcolor#}">
           <font style="color:{#form_btn_font_color#}; font-size:{#form_btn_font_size#}; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">
            <input type=submit name=user_reg value="{lang->desc p1='register' p2=$lang_set p3='btn_reg'}"   class="blackbutton">
           </font>
          </td>
         </tr>
        </table>
       </form>
       
       {literal}

        <script type="text/javascript">


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
				$('#login').focus();
                $("#login").maxLength(50);
                $("#login").ForceAlphaNumericOnly();
                $("#usermail").maxLength(100);
                $("#pass").maxLength(50);
                $("#vpass").maxLength(50);
                //$("#salary").ForceNumericOnly();



				$("#register_form0").validate({
					rules: {
						firm: { required: true }

					},
                   messages: {
 	                 firm: "Please enter a Firmname" ,
 	                 description: "Please enter a Description"

 	                 }
				});
			});
		</script>
		{/literal}
