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
{include file="$deftpl/header.tpl"}
{*****************************************

   Page Display

******************************************}

 
<form id="register_edit_form2" name="register_edit_form2" action="edlist.php?lid={$vs_current_listing.id}" class="job_detail_view" method="post" enctype="multipart/form-data" data-ajax="false" onsubmit="return valid_form();">
    {literal}
        <script type="text/javascript">
			function valid_form(){
			 	var validform_detail = validate_form_detail();
				var validform_detail_contact = validate_form_detail_contact_info();
				var validform_wrk_hrs = validate_week_wrk_hrs();
				var error = "";
				if (validform_detail == false){
                    error = error + "\n Profile detail form contain errors.";
                    validity = false;
				}else{
                    if (validform_detail_contact == false){
                    	error = error + "\n Profile contact form contain errors.";
                    	validity = false;
                    }else{
                        if(validform_wrk_hrs == false){
                          error = error +  "\n Business hours form contain errors. ";
                          validity = false;
                        }
                    }
				}
                if(error == ""){
                  return true;
                }else{
                  alert('Please Revise The Form.' + error);
                  return false;
                }
				

   			}
		</script>
    {/literal}

    {if $seltab eq 3}
        {include file="$deftpl/edlist/form_detail_settings.tpl"}
        {include file="$deftpl/edlist/form_detail_contact_info.tpl"}
        {include file="$deftpl/edlist/form_detail_product.tpl"}
        {include file="$deftpl/edlist/form_detail.tpl"}
        {include file="$deftpl/edlist/form_detail_logo.tpl"}
        {*include file="$deftpl/edlist/form_detail_workinghrs.tpl"*}
        {include file="$deftpl/edlist/form_validation.tpl"}
    {else}
        {include file="$deftpl/edlist/form_detail.tpl"}
        {include file="$deftpl/edlist/form_detail_contact_info.tpl"}
        {include file="$deftpl/edlist/form_detail_product.tpl"}
        {include file="$deftpl/edlist/form_detail_settings.tpl"}
        {include file="$deftpl/edlist/form_detail_logo.tpl"}
        {*include file="$deftpl/edlist/form_detail_workinghrs.tpl"*}
        {include file="$deftpl/edlist/form_validation.tpl"}
    {/if}

    
    {literal}
        <script type="text/javascript">
         /*
$( ".ui-page" ).live( "pageshow", function(){
				setTimeout("disable_tinymce();", 1000);

			});

			function disable_tinymce(){
                tinyMCE.execCommand('mceRemoveControl', false, 'xtra_1');
				tinyMCE.execCommand('mceRemoveControl', false, 'description');
   			}
*/
		</script>
        
    {/literal}


   
</form>



{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
