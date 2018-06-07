
 {if $promotion.id|trim|strlen eq 0}
    {assign var="ALLOW_TO_POST" value=0}
    {if $elgg_user_allow_to_post eq 1}
        {if $elgg_user_subscription_id && $elgg_remaining_itm_to_post }
            {assign var="ALLOW_TO_POST" value=1}
        {else}
            {if $elgg_user_allow_to_free_post eq 1}
                {assign var="ALLOW_TO_POST" value=1}
            {/if}
        {/if}
    {/if}
 {else}
     {assign var="ALLOW_TO_POST" value="1"}
 {/if}
 {if $ALLOW_TO_POST eq 0}
    <div class="fail">Not Allowed To Post Promotion.</div>
 {else}
{include file="$deftpl/promotion/notify_msg.tpl"}
<form id="promotion_form" name="promotion_form" action="promotion.php?list_id={$vs_user_profile_list_id}" method="post"  enctype="multipart/form-data" data-ajax="false" onsubmit="return validate_promotion_form();">
{if $promotion.id}
<input type="hidden" id="id" style="width:50px;" name=" id" value="{$promotion.id}"/>
{/if}
{if $is_renew_promotion}
            <input type="hidden" id="is_renew_promotion"  name="is_renew_promotion" value="1"/>
    {/if}
        <table class="job_detail_panal_table">

        <tr>
            <td class="detail_right_td">Title <font color="red">*</font></td>
			<td class="detail_left_td">
			     <input type="text" name="title" id="title" {$req_cls}  value="{$promotion.title}">
            </td>
         </tr>
         <tr><td colspan="2"><span class="error" id="title_error"></span></td></tr>
         <tr>
            <td class="detail_right_td">
				Promotion&nbsp;<small>(pdf)</small>
			</td>
			<td class="detail_left_td">
            {if $promotion.id && $is_renew_promotion neq 1}
    		 	    <a href="pdf/{$promotion.pdf}" target="_blank">{$promotion.title}</a><br>
                {/if}


                <input type="checkbox" value="1" id="new_pdf" name="new_pdf" onchange="change_for_new_pdf();" onclick="change_for_new_pdf();"/>
                <label for="new_pdf">Add New pdf</label>

             <input type="file" size="15" id="pdf" name="pdf" {if $promotion.id}disabled="disabled"{/if}/> &nbsp;&nbsp;
         </tr>
          <tr><td colspan="2"><span class="error"  id="pdf_error"></span></td></tr>
         <tr>
                <td class="detail_right_td">Select Template</td>
                <td class="detail_left_td">
                        <select name="template_id" id="template_id">
                         {if $templates_info}
                     		{section name=itm loop=$templates_info}
                                    <option  value="{$templates_info[itm].id}"  {if $templates_info[itm].id == $template_id || $templates_info[itm].id == $smarty.post.template_id }selected="selected"{/if}>{$templates_info[itm].title}</option>
                            {/section}
                        {/if}
                        </select>
                        <a href="#" data-role="button" onclick="call_preview({if $promotion.id && $is_renew_promotion neq 1}{$promotion.id}{else}0{/if}, $('#template_id').val());" name="preview">Preview</a>
					</td>
         </tr> 
         <tr>
            <td class="detail_right_td">Start Date <font color="red">*</font></td>
			<td class="detail_left_td">
            {if $promotion.id && $is_renew_promotion neq 1}
            {if $promotion.start_date}{$promotion.start_date|date_format:'%m/%d/%Y %I:%M %p'}{/if}

            
			{else}
                <input class="startdate" type="text" name="start_date" id="start_date" size="10" value="{if $promotion.start_date}{$promotion.start_date|date_format:'%m/%d/%Y'}{else}{$smarty.post.start_date|date_format:'%m/%d/%Y'}{/if}" />
            {/if}
			</td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="start_date_error"></span></td></tr>
         <tr>
             <td class="detail_right_td">End Date <font color="red">*</font></td>
			<td class="detail_left_td">
            {if $promotion.id && $is_renew_promotion neq 1}
            	{if $promotion.end_date}{$promotion.end_date|date_format:'%m/%d/%Y %I:%M %p'}{/if}

            {else}
			   <input class="enddate" type="text" id="end_date" name="end_date" size="10" value="{if $promotion.end_date}{$promotion.end_date|date_format:'%m/%d/%Y'}{else}{$smarty.post.end_date|date_format:'%m/%d/%Y'}{/if}" />
            {/if}
			</td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="end_date_error"></span></td></tr>
        <tr>
            <td class="detail_right_td">
                    State <font color="red">*</font>

   			</td>
			<td class="detail_left_td">
			      <select id="states" {$req_cls} name="states" onchange="javascript:change_metro_area_by_state('states','metro_area');">
            		<option value="">Select States</option>
					{if $current_states_list}
                        {section name=sitm loop=$current_states_list}
                            <option value="{$current_states_list[sitm].id}" {if  $current_states_list[sitm].id == $promotion.states}selected="selected"{/if}>{$current_states_list[sitm].name}</option>
                        {/section}
                    {/if}
                </select>

            </td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="states_error"></span></td></tr>
         <tr id="show_sub_categories" >
         	<td class="detail_right_td">
                Metro Area <font color="red">*</font>

            </td>
         <td class="detail_left_td" id="metro_area_box">
            {assign var="current_metro_area_list" value=$promotion.area_list}
            <select  name="metro_area"  {$req_cls} id="metro_area">
                <option value="">Select Metro Area</option>
                 {if ($current_metro_area_list) && ($promotion.states)}
                    {section name=sitm loop=$current_metro_area_list}
                    <option  value="{$current_metro_area_list[sitm].metro_id}" {if  $current_metro_area_list[sitm].metro_id == $promotion.metro_area}selected="selected"{/if}>{$current_metro_area_list[sitm].metro_name}</option>
                    {/section}
                 {/if}
            </select>

         </td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="metro_area_error"></span></td></tr>
          <tr>
            <td class="detail_right_td">Image</td>
			<td class="detail_left_td">
                  <input type="checkbox" name="use_list_img" value="1" id="use_list_img" onclick="change_image_file();" onchange="change_image_file();"/>
                        <label for="use_list_img">Use Listing logo</label>
            {if  $promotion.img_ext  || $promotion.img_ext neq '0'}
                    <a target="_blank" href="promotion_images/{$promotion.id}.{$promotion.img_ext}">{$promotion.title}</a><br>
            {/if}
				<input type="file" size="15" name="promo_img" ACCEPT="text/html, image/jpeg" id="promo_img">&nbsp;&nbsp;
			</td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="promo_img_error"></span></td></tr>
         
         <tr>
            <td class="detail_right_td">Coupons</td>
			<td class="detail_left_td">
				
                <select name="cupon_type" id="cupon_type" onchange="change_cupons();">
                    <option value="none" {if $coupon_type eq 'none'}selected{/if}>Regular promotions</option>
                    <option value="all_site" {if $promotion.cupon_type eq 'all_site'}selected{else}{if $coupon_type eq "all_site"}selected{else}{/if}{/if}>One time coupon </option>
                    <option value="recommendation" {if $promotion.cupon_type eq 'recommendation'}selected{else}{if $coupon_type eq "recommendation"}selected{else}{/if}{/if}>coupon on recommendation</option>
                    <!-- <option value="survey" {if $promotion.cupon_type eq 'survey'}selected{else} {if $coupon_type eq "survey"}selected{else}{/if}{/if}>Survey</option> -->
                    <option value="reward" {if $promotion.cupon_type eq 'reward'}selected{else} {if $coupon_type eq "reward"}selected{else}{/if}{/if}>Rewards program </option>
                </select>
                &nbsp;<a href="#" title="what is this?" style="background:url('{$elgg_main_url}images/_graphics/icon_bookmarkthis.gif') 0px 0px no-repeat;  padding-left:20px;font-size:12px !important;font-weight:bold;color:#6a18b6;font-family:  Verdana, Arial, Helvetica, sans-serif; height:55px !important;" onclick="return overlib('<table  class=\'inside_popup\' style=\'font-family:  Verdana, Arial, Helvetica, sans-serif;width:290px;font-size:10px !important;\'><tr><td colspan=\'2\' class=\'top_line\'><span style=\'width:290px;text-align:left;padding-left:15px;line-height:20px;font-size:12px;font-weight:bold;color:Gray;\'>Coupons</span><br><b>1. Regular promotions </b>- These could be your regular lunch specials or dinner special or happy hours or inventory clearance deals or occasional specials.<br><b>2. One time redeem coupon -</b> This is a onetime redeem only coupon. The customer can redeem this coupon only one time and this can be used for marketing or advertising a new business or menu.<br><b>3 - Rewards program -</b> This is a program for your regular customers. You can customize your own rewards program. Also you can take help of our team to create a effective rewards program.<br><b>4. This coupon is a Thank you coupon </b>given to a customer who has recommended your business. This would appreciate and encourage customers promote your business<br>o	Regular promotion<br>o	One time redeem coupon<br>o	Rewards program<br>o	Coupon on Recommendation<a href=\'#\' style=\'float:right;\' onclick=\'return cClick();\'>close</a></td></tr><tr><td colspan=\'2\' style=\'text-transform: lowercase !important;\'>{$varPromPath}</td></tr><tr><td colspan=\'2\' class=\'bottom_line\'></td></tr></table>',STICKY);" >what is this?</a>
            </td>
        </tr>

        <tr id="allowed_cupons_row" {if $promotion.cupon_type eq 'none' || $coupon_type eq 'none'}style="display:none"{/if}>
             <td class="detail_right_td">Allowed Coupons</td>
			<td class="detail_left_td">
                   <input type="text" name="allowed_cupons" id="allowed_cupons" {if $promotion.cupon_type neq "" && $promotion.cupon_type neq "none" && $promotion.allowed_cupons gt 0} value="{$promotion.allowed_cupons}"{else} value="0" {/if}/>
			</td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="promo_allowed_cupons_error"></span></td></tr>
         <tr>
            <td class="detail_right_td">Comment <font color="red">*</font></td>
			<td class="detail_left_td">
			<div style="width:180px;overflow-x:scroll !important;">
        {literal}
            <script language="javascript" type="text/javascript" src="../../tinymce/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

            <script language="javascript" type="text/javascript">
               tinyMCE.init({
            	mode : "textareas",
            	theme : "advanced",
            	relative_urls : false,
            	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,bullist,numlist,undo,redo,link,unlink,image,blockquote,code",
            	theme_advanced_buttons2 : "",
            	theme_advanced_buttons3 : "",
            	theme_advanced_toolbar_location : "top",
            	theme_advanced_toolbar_align : "left",
            	theme_advanced_statusbar_location : "bottom",
            	theme_advanced_resizing : true,
            	extended_valid_elements : "a[name|href|target=_blank|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
            	editor_selector :"comments"   ,
            	onchange_callback: function (editor)     {
                  tinyMCE.triggerSave();
                }
            });
            function toggleEditor(id) {
            if (!tinyMCE.get(id))
            	tinyMCE.execCommand('mceAddControl', false, id);
            else
            	tinyMCE.execCommand('mceRemoveControl', false, id);
            }
			
			
			 
            </script>
        {/literal}
        <textarea id="comments" name="comments" rows="5" {$req_cls}>{$promotion.comments}</textarea>

        <div class="toggle_editor_container"><a style="color:#17a;" class="toggle_editor" href="javascript:toggleEditor('comments');">Add/Remove editor</a></div>
      
        </div>
		  {literal}
        <script type="text/javascript">
	
    function validate_promotion_form(){
	 

        validform = true;

//..For firm
 	 //var var_title  = document.forms.promotion_form.title.value;
 	 
      var var_title  = $("#promotion_form #title").val();
 	 
     $("#title_error").html('');

     
	 if (!IsNonEmpty(var_title)){
            $("#title_error").html('Please Enter Title.');
            validform = false;
	 }
	 
	//var var_pdf = document.forms.promotion_form.pdf.value;
	
	var var_pdf  = $("#promotion_form #pdf").val();
	
	$("#pdf_error").html('');
 
    var chk = $("#new_pdf:checked").length;

	if(IsNonEmpty(var_pdf)){


        if(!IsFileType(var_pdf, 'pdf')){
            $("#pdf_error").html('Please Select pdf Document.');
            validform = false;
 		}
 	}else {
         if(chk){
            $("#pdf_error").html('Please Add pdf Document.');
            validform = false;
           }else{

          }
    }


   //.. for   description
   // var var_comments  = document.forms.promotion_form.comments.value;
    var var_comments  = $("#promotion_form #comments").val();

     $("#comments_error").html('');
	 if (!IsNonEmpty(var_comments)){
            $("#comments_error").html('Please Enter Comment.');
            validform = false;
	 }


    {/literal}
    
    {if $promotion.id && $is_renew_promotion neq 1}
           {** DO NOTING **}
    {else}
    {literal}
      //.. for   startdate
    // var var_start_date  = document.forms.promotion_form.start_date.value;
   var var_start_date  = $("#promotion_form #start_date").val();
     $("#start_date_error").html('');
	 if (!IsNonEmpty(var_start_date)){
            $("#start_date_error").html('Please Enter Start Date.');
            validform = false;
	 }else  {
      if(!checkdate(var_start_date)){
             $("#start_date_error").html('Please Enter Proper Date.Format Must Be like mm/dd/yyyy.');
            validform = false;
  		}else{
            var d= new Date();
 			var todayvalue = new Date(d.getFullYear(), d.getMonth(), d.getDate());
            if(((Date.parse(todayvalue) == Date.parse(var_start_date)) || ( Date.parse(todayvalue) < Date.parse(var_start_date)))==false){
                $("#start_date_error").html('Start Date Should be greater than todays date');
			   validform = false;
			}
		}
     }
     //var var_end_date = 	document.forms.promotion_form.end_date.value;
    
     var var_end_date = $("#promotion_form #end_date").val();
		$("#end_date_error").html('');
    
	 if (!IsNonEmpty(var_end_date)){
            $("#end_date_error").html('Please Enter End Date');
            validform = false;
	 }else{
		if(!checkdate(var_end_date)){
             $("#end_date_error").html('Please Enter Proper Date.Format Must Be like mm/dd/yyyy.');
            validform = false;
  		}else{
        /*
        var nextmontvalue = new Date(var_start_date);
		  nextmontvalue.setDate(nextmontvalue.getDate()+ 30);
		  if(( Date.parse(var_end_date)  < Date.parse(nextmontvalue))==false){
             $("#end_date_error").html("End date should be within 30 days from Start  date.");
             validform = false;
		  }
        */
		  if(( Date.parse(var_end_date)  > Date.parse(var_start_date))==false){
            $("#end_date_error").html("End date should be greater than Start date.");
             validform = false;
			}
		}
  	}
    {/literal}
    {/if}
    {literal}
	// var var_states  = document.forms.promotion_form.states.value;
	  var var_states = $("#promotion_form #states").val();

     $("#states_error{/literal}{literal}").html('');
	 if (!IsNonEmpty(var_states)){
            $("#states_error").html('Please Select State.');
            validform = false;
	 }

	// var var_metro_area  = document.forms.promotion_form.metro_area.value;
	 var var_metro_area = $("#promotion_form #metro_area").val();
	 
     $("#metro_area_error").html('');
	 if (!IsNonEmpty(var_metro_area)){
            $("#metro_area_error").html('Please Select Metro Area.');
            validform = false;
	 }

	//var var_promo_img = document.forms.promotion_form.promo_img.value;
	
	var var_promo_img = $("#promotion_form #promo_img").val();
	
	$("#promo_img_error").html('');

	if(IsNonEmpty(var_promo_img)){
        if(((IsFileType(var_promo_img, 'jpg')) || (IsFileType(var_promo_img, 'png')))==false){
            $("#promo_img_error").html('Please Select JPG, PNG,  Document.');
            validform = false;
 		}
 	}
 	
 	var var_promo_allowed_cupons = $("#promotion_form #allowed_cupons").val();

	$("#promo_allowed_cupons_error").html('');
 	
    if(cupons_quanity_value() == 1){
      if(IsNonEmpty(var_promo_allowed_cupons)==false){
             $("#promo_allowed_cupons_error").html('Please Enter Quantity');
             validform = false;
      }else{
         if(isInt(var_promo_allowed_cupons)==false){
              $("#promo_allowed_cupons_error").html('Please Enter integer value.');
                validform = false;
         }else{
            if(is_gt_zero_num(var_promo_allowed_cupons)==false){
                $("#promo_allowed_cupons_error").html('Please Enter value greater than zero');
                validform = false;
            }
         }

      }
    }
 	
 	
		if(validform == false){
            alert('Please Revise the form');
  		}
	 return validform;


    }
    
	    $(function(){
	    		$("#start_date").scroller({ preset: 'date' });
	    		$("#end_date").scroller({ preset: 'date' });
	    });
        </script>
        {/literal}
          </td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="comments_error"></span></td></tr>
   </table>
   <center>
    {if $promotion.id}
        <input type="hidden" id="listid" name="listid" value="{$promotion.list_id}"/>
    {else}
        <input type="hidden" id="listid" name="listid" value="{$listid}"/>
    {/if}
            <input type="hidden" id="promotion_id" name="promotion_id" value=""/>
            <!--<input type="submit" name="preview" value="Preview"/>-->
      <input name="save" type="hidden" value="1"/>
	 <button type="submit" data-role="button" data-inline="true">{if $promotion.id && $is_renew_promotion neq 1}Update{else}Create{/if}</button>
     {if $promotion.id && $is_renew_promotion neq 1}
         <a href="#promotion_view" data-role="button" data-inline="true"  data-theme="a" > Cancel</a>
	 {else}
   <!--<input data-role="button" data-inline="true" type="button"  name="cancel_insert" onclick="document.location.href='edlist.php?lid={$listid}'"  data-theme="a" value="Profile"/>-->
   {/if}
   </center>
  </form>
  
 {/if}
