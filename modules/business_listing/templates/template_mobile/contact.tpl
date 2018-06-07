{*****************************************

           Contact Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='contact'}
{*****************************************

   Display Header

******************************************}

{*****************************************

   Page Display

******************************************}

{if $isMobileContact}
 {include file="$deftpl/header.tpl"}
	<div data-role="page">
    {include file="$deftpl/list/header.tpl"}


	<div data-role="content">
{/if}

 {if $notice != ""}
         <div class="fail">
            {$notice}
         </div>
  {/if}
    {assign var="contact_form" value="contact_form"}
{if !$sent_flag}
  {if $action == "admin"}
    {if $vs_config.rewrite}

            <form id="{$contact_form}" name="{$contact_form}" onsubmit="return validate_{$contact_form}();" action="Contact_Admin.html" method="post" data-ajax="false">
    {else}
            <form id="{$contact_form}" name="{$contact_form}" onsubmit="return validate_{$contact_form}();" action="contact.php?act=admin" method="post" data-ajax="false">
    {/if}
  {elseif $action == "refer"}
  {assign var="contact_form" value="refer_contact_form"}
    {if $vs_config.rewrite}

            <form id="{$contact_form}" name="{$contact_form}" onsubmit="return validate_{$contact_form}();" action="Refer_{$vs_current_listing.mod_firm}-{$vs_current_listing.id}.html" method="post" data-ajax="false">
    {else}
            <form id="{$contact_form}" name="{$contact_form}" onsubmit="return validate_{$contact_form}();" action="contact.php?lid={$vs_current_listing.id}&act=refer" method="post" data-ajax="false">
    {/if}
  {else}
  {assign var="contact_form" value="suggestion_contact_form"}
    {if $vs_config.rewrite}
            <form id="{$contact_form}" name="{$contact_form}" onsubmit="return validate_{$contact_form}();" action="Mail_{$vs_current_listing.mod_firm}-{$vs_current_listing.id}.html" method="post" data-ajax="false">
    {else}
            <form id="{$contact_form}" name="{$contact_form}" onsubmit="return validate_{$contact_form}();" action="contact.php?lid={$vs_current_listing.id}" method="post" data-ajax="false">
    {/if}
  {/if}
   
  {if $from_title}

  {else}
        {assign var="from_title" value="$elgg_curr_user_name"}
  {/if}
  
  {if $from}
   
  {else}
        {assign var="from" value="$elgg_curr_user_mail"}
  {/if}
  <div class="extra_info">
  {if $action eq "refer"}
  *Recommend this business to a Connection.
  {else}
  *Send your comments and suggestions to the Business.
  {/if}
  </div>
      <table  class="job_detail_panal_table">
		  	  <tr>
              <td class="detail_right_td">
                *{lang->desc p1='contact' p2=$lang_set p3='from_title'}
              </td>
              <td class="detail_left_td">
                <input type="text" class="required" id="{$contact_form}_from_title" name="from_title" value="{$from_title}">
              </td>
             </tr>
             <tr>
				<td colspan="2" id="{$contact_form}_from_title_error" class="form_error"></td>
			 </tr>
             <tr>
              <td class="detail_right_td">
                *{lang->desc p1='contact' p2=$lang_set p3='from'}
              </td>
               <td class="detail_left_td">
                <input type="text" id="{$contact_form}_from" class="required email" name="from" value="{$from}">
              </td>
             </tr>
             <tr>
				<td colspan="2" id="{$contact_form}_from_error" class="form_error"></td>
			 </tr>
             <tr>
              	<td class="detail_right_td">
                	*{lang->desc p1='contact' p2=$lang_set p3='subject'}
				</td>
              	<td class="detail_left_td">
              	 {if $action == "refer"}
                    <input type="text" id="subject" class="required" name="subject" value="Business recommendation from {$from_title}">
                {else}
                        <input type="text" id="{$contact_form}_subject" class="required" name="subject" value="Message from {$from_title}">
                {/if}

               	</td>
             </tr>
             <tr>
				<td colspan="2" id="{$contact_form}_subject_error" class="form_error"></td>
			 </tr>
  {if $action == "refer"}
             <tr>
              <td class="detail_right_td">
                *{lang->desc p1='contact' p2=$lang_set p3='refer_to'}
              </td>
              <td class="detail_left_td">
                <input type="text" name="refer_to" id="{$contact_form}_refer_to" class="required email" value="{$refer_to}">
              </td>
             </tr>
             <tr>
				<td colspan="2">
					<span id="{$contact_form}_refer_to_error" class="form_error"></span>
				</td>
			 </tr>
  {/if}
             <tr>
             	<td class="detail_right_td">
                	*{lang->desc p1='contact' p2=$lang_set p3='message'}
                </td>
              	<td class="detail_left_td">
               		<textarea cols=20 rows=5 name="message" id="{$contact_form}_msg" class="required">{$message}</textarea>
               	</td>
             </tr>
             <tr>
                <td colspan="2">
					<span id="{$contact_form}_message_error" class="form_error"></span>
				</td>

			 </tr>
            <tr>
             <td colspan=2 valign=top align=center class="bottom_line">

               <input type="hidden" name="act" value="{$action}">
               <button name="btn_send" type="submit"  id="btn_send" data-theme="a" data-inline="true">{lang->desc p1='contact' p2=$lang_set p3='btn_send'}</button>

			   &nbsp;&nbsp;&nbsp;&nbsp;
			   {if $vs_config.rewrite}
               			<button onclick="document.location.href='{$vs_current_listing.firm}-{$vs_current_listing.id}.html'">{$vs_current_listing.firm}</button>
{else}          <!--
                <button class="blackbutton" style="width:60px;"  onclick="document.location.href='show.php?lid={$vs_current_listing.id}'">{$vs_current_listing.firm} </button>  &nbsp;&nbsp; -->
               <!-- <button class="blackbutton" style="width:60px;" onclick="location.href='{$mybackbutton}'">Back</button> -->
				{/if}
				
				{if $showing_promotion && $promoid}
				    <input type="hidden" name="promoid" value="{$promoid}" />
				{/if}
				
              </font>
             </td>
            </tr>

           </form>
           </table>

{else}
            <div class="approved">
                {lang->desc p1='contact' p2=$lang_set p3='sent_msg'}
            </div>

{/if}

 {literal}

        <script type="text/javascript" language="javascript">
        
        function validate_{/literal}{$contact_form}{literal}(){
            var validform = true;
            
		//..For from_title -- Ok
		 var var_from_title = 	document.forms.{/literal}{$contact_form}{literal}.from_title.value;
			$("#{/literal}{$contact_form}{literal}_from_title_error").html('');
			 if(!IsNonEmpty(var_from_title)){

             $("#{/literal}{$contact_form}{literal}_from_title_error").html('Please Enter title');
             	validform = false;
             }
        //..For subject -- Ok
		 var var_subject = 	document.forms.{/literal}{$contact_form}{literal}.subject.value;
			$("#{/literal}{$contact_form}{literal}_subject_error").html('');
			 if(!IsNonEmpty(var_subject)){
             $("#{/literal}{$contact_form}{literal}_subject_error").html('Please Enter subject');
             	validform = false;
             }
		//.. For message
		 var var_message = 	document.forms.{/literal}{$contact_form}{literal}.message.value;
			$("#{/literal}{$contact_form}{literal}_message_error").html('');
			 if(!IsNonEmpty(var_message)){
             $("#{/literal}{$contact_form}{literal}_message_error").html('Please Enter message');
             	validform = false;
             }
		
		
		var var_from = 	document.forms.{/literal}{$contact_form}{literal}.from.value;
		$("#{/literal}{$contact_form}{literal}_from_error").html('');
		 if(!IsNonEmpty(var_from)){
             $("#{/literal}{$contact_form}{literal}_from_error").html('Please Enter Your Email');
              validform = false;
           }else{
             if(!isEmail(var_from)){
                 $("#{/literal}{$contact_form}{literal}_from_error").html('Please Enter Proper Email');
                 validform = false;
             }
           }
    {/literal}
     {if $action == "refer"}
    {literal}
	var var_refer_to = 	document.forms.{/literal}{$contact_form}{literal}.refer_to.value;
			$("#{/literal}{$contact_form}{literal}_refer_to_error").html('');
		 if(!IsNonEmpty(var_refer_to)){
             $("#{/literal}{$contact_form}{literal}_refer_to_error").html('Please Enter Connections Email');
              validform = false;
           }else{
             if(!isEmail(var_refer_to)){
                 $("#{/literal}{$contact_form}{literal}_refer_to_error").html('Please Enter Proper Email');
                 validform = false;
             }else{
                if (var_from == var_refer_to ){
                    $("#{/literal}{$contact_form}{literal}_refer_to_error").html('Both Email Should Not Be Same');

                   validform = false;
                }

   			  }
           }
	{/literal}
	    {/if}
	{literal}


		if(validform == false){
			alert ("Please Revise The Form.");
  		}
		return validform;
		}
        



		</script>
		{/literal}

{if $isMobileContact}
	</div><!-- content -->
		<div data-role="footer">
			<h4><small>Business Listing</small></h4>
		</div>
	</div><!-- Page -->
	{include file="$deftpl/footer.tpl"}
{/if}

{*****************************************

   Display Footer

******************************************}

