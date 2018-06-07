{*****************************************

       Edit Listing Template
          phpDirectorySource

******************************************}

{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edlist'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
 {$mail_err}
 {$mail_fail}
 {$mail_success}


{if $notice != ""}
    	<div class="fail">
        	{$notice}
        </div>
	{/if}
{if $operation != ""}
    	<div class="approved">
        	{$operation}
        </div>
{/if}
        <!-- add new item form -->
        <form id="tgt_client_form" name="tgt_client_form" class="job_detail_view" method="post" action = "targetclients.php" >
	   <table width="100%" class="job_detail_view">
          <tr>
             <td class="right_td">
                 Select Category
             </td>
             <td class="left_td">
              <input type="text" class="required" name="category" id="category" value="{$smarty.post.category|escape}"/>{$tree_cate}
            </td>
         </tr>
         <tr>
             <td class="right_td">
                 City
             </td>
             <td class="left_td">
              <input type="text" name="city" id="city" value="{$smarty.post.city|escape}"/>
             </td>
         </tr>
         <tr>
            <td class="right_td">
                 How often service used
             </td>
             <td class="left_td">
                <select name="timeframe" id="timeframe">
                  <option value="">-Select One-</option>
                  <option value="daily">daily</option>
                  <option value="weekly">weekly</option>
                  <option value="montly">montly</option>
                  <option value="yearly">yearly</option>
                  <option value="occasionally">occasionally</option>
                </select>
            </td>
         </tr>
         <tr>
            <td class="right_td">
                 Price Range Interested In
             </td>
             <td class="left_td">
                <select name="pricing" id="pricing">
                  <option value="">-Select One-</option>
                  <option value='Less than $10'>Less than $10</option>
                  <option value='$10-$100'>$10-$100</option>
                  <option value='$100-$500'>$100-$500</option>
                  <option value='$500-$1000'>$500-$1000</option>
                  <option value='$1000-$5000'>$1000-$5000</option>
                  <option value='$5000-$10000'>$5000-$10000</option>
                  <option value='Greater than $10000'>Greater than $10000</option>
                </select>
            </td>
          </tr>
         <tr>
             <td colspan="2">
                <input type="submit" name="search" value="Search" class="blackbutton" style="width:100px;"/>
             </td>
         </tr>
        </table>
        </form>
        

      <!-- Now Show the list of the found records -->
      <BR>
      {if $user_list}
          <div id="client_box" style="padding-left:25px;" >
              <select id="target_clients" name="target_clients" class="multiselect" multiple="multiple">
                  {section name=citm loop=$user_list}
                     <option value="{$user_list[citm].userid}">{$user_list[citm].location} ,{$user_list[citm].zip}[=]templates/{$deftpl}/images/client.png[=] <small> {$user_list[citm].pricing},{$user_list[citm].timeframe}</small></option>
                  {/section}
              </select>
              <br>
              <small><I>* Total {$total_users} clients found matching to your criteria.</I></small>
              <input type="button" value="Send Mail" class="blackbutton" style="widht:100px;height:30px;" onclick="get_value1()"/>
          </div>
        {/if}

         {literal}
            <script type="text/javascript">
                function get_value1()
                {
                    ob = document.getElementById('target_clients');
                    var selected = "";
                    for (var i = 0; i < ob.options.length; i++){
                        if (ob.options[ i ].selected){
                            selected = selected + ob.options[ i ].value + ',';
                        }
                    }
                    this_str = document.getElementById('selected_clients').value ;
                    //alert(document.getElementById('selected_clients').value)  ;
                    if ( ((selected.length) != 0) || ((this_str.length) != 0)){
                         document.getElementById('selected_clients').value =  selected.slice(0,selected.length-1);
                         //$('#reciepeintLst').html(selected);
                         $('#tgt_client_mail_form').show();
                         $('#client_box').hide();//return true;
                    }
                    else{
                        alert ("Please, select Clients");//return false;
                    }
                }
            </script>
        {/literal}
        
        <form id="tgt_client_mail_form" style="display:none;" name="tgt_client_mail_form" class="job_detail_view" enctype="multipart/form-data" method="post" action = "targetclients.php" >
         <input type="hidden" value="" id="selected_clients" name="selected_clients"/>
          <table width=100%>
		 	 <tr>
                <th colspan="2">Send Mail To Client</th>
             </tr>

		  	  <tr>
              <td class="right_td">
                * From {lang->desc p1='contact' p2=$lang_set p3='from_title'}
              </td>
              <td class="left_td">
                 {$organizer_name}
              </td>
             </tr>
         <!--
             <tr>
              <td class="right_td">
                * From {lang->desc p1='contact' p2=$lang_set p3='from'}
              </td>
               <td class="left_td">
                {$organizer_mail}
              </td>
             </tr>
             -->
             <tr>
              	<td class="right_td">
                	*{lang->desc p1='contact' p2=$lang_set p3='subject'}
				</td>
              	<td class="left_td">
                	<input type="text" id="subject" class="required" name=subject value={$from_title}>
               	</td>
             </tr>

             <tr>
             	<td class="right_td">
                	*{lang->desc p1='contact' p2=$lang_set p3='message'}
                </td>
              	<td class="left_td">
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
            	extended_valid_elements : "a[name|href|target=_blank|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
            });
            function toggleEditor(id) {
            if (!tinyMCE.get(id))
            	tinyMCE.execCommand('mceAddControl', false, id);
            else
            	tinyMCE.execCommand('mceRemoveControl', false, id);
            }
            </script>
        {/literal}
       	<textarea cols=20 rows=5 name=message id="msg" class="required">{$message}</textarea>

        <div class="toggle_editor_container"><a class="toggle_editor" href="javascript:toggleEditor('msg');">Add/Remove editor</a></div>
        {literal}
        <script type="text/javascript">
        	$(document).ready(function() {
        		$('msg').parents('tgt_client_mail_form').submit(function() {
        			tinyMCE.triggerSave();
        		});
        	});
        </script>
        {/literal}
               		
               	</td>
             </tr>
             
            <tr>
                <td class="right_td">
                    Attachment
    			</td>
    			<td class="left_td">
    			<input type="file" name="attachment" />
              </td>
           </tr>
         
            <tr>
             <td colspan=2 valign=top align=center bgcolor="{#form_btn_bgcolor#}">
               <input name="send_mail" type=submit  id="send_mail" value="Send Mail" class="blackbutton" style="width:100px; height:30px;">&nbsp;&nbsp;&nbsp;&nbsp;
               <input type="reset"  id=btn_cancel value="Cancel" class="blackbutton" style="width:80px;height:30px;" onclick="$('#tgt_client_mail_form').hide();$('#client_box').show();">
              </font>
             </td>
            </tr>

           </table>
         </form>
            
        {literal}

        <script type="text/javascript">
       		$(document).ready(function()
    		{
    			$('#from_title').focus();
    			$('#from_title').ForceAlphaNumericOnly();
    			$('#from_title').maxLength(100);
    			$('#from').ForceUrlOnly();
    			$('#refer_to').ForceUrlOnly();
    			$('#from').maxLength(200);
    			$('#refer_to').maxLength(200);
    		 	$('#subject').ForceAlphaNumericOnly();
    			$('#subject').maxLength(100);

    			$("#tgt_client_mail_form").validate({
    				rules: {
                        subject :{required:true}
    				},
                   messages: {
    					subject: "Please, Enter subject",
    					msg : "Please, Enter  your message"
                   }
    			});
    			
    			$("#tgt_client_form").validate({
    				rules: {
                        category :{required:true}
    				},
                   messages: {
    					category: "Please, Select Category To Search"
                   }
    			});
    		 });
		</script>
	{/literal}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
