{literal}
    	<script type="text/javascript">
<!-- Begin
/* This script and many more are available free online at
The JavaScript Source!! http://javascript.internet.com
Created by: Abraham Joffe :: http://www.abrahamjoffe.com.au/ */

/***** CUSTOMIZE THESE VARIABLES *****/

  // width to resize large images to
var maxWidth=200;
  // height to resize large images to
var maxHeight=200;
  // valid file types
var fileTypes=["bmp","gif","png","jpg","jpeg"];
  // the id of the preview image tag
var outImage="previewField";
  // what to display when the image is not valid
var defaultPic="templates/default/images/nologo.jpg";
var extOk=false;
var globalPic;
/***** DO NOT EDIT BELOW *****/

function preview(promo_id){
  var source=document.getElementById('promo_img'+promo_id);
  var imageName="file:///"+source.value;

	alert(imageName);
	globalPic=new Image();
    globalPic.src=imageName;
	extOk=false;

	applyChanges();

}



function applyChanges(){
  field=document.getElementById('previewField');
  x=parseInt(globalPic.width);
  y=parseInt(globalPic.height);
  if (x>maxWidth) {
    y*=maxWidth/x;
    x=maxWidth;
  }
  if (y>maxHeight) {
    x*=maxHeight/y;
    y=maxHeight;
  }
  field.style.display=(x<1 || y<1)?"none":"";
  field.src=globalPic.src;
  field.width=x;
  field.height=y;
}
// End -->
</script>


	<script type="text/javascript">
	

	
        $(document).ready(function(){

        $( "#dialog_preview" ).dialog({
        			autoOpen: false ,
                    width: 620,
                    modal:true ,
                    zIndex: 11000
                    });
         $( "#dialog_preview_tab" ).tabs();
     });

    	function show_preview_dialog(promo_id){
				preview(promo_id);
            	$('#preview_start_date').html($('#start_date'+ promo_id ).val());
            	$('#preview_end_date').html($('#end_date'+ promo_id ).val());
                $('#preview_comments').html($('#comments'+ promo_id).val());
                $('#preview_promo_id').val(promo_id);

            $( "#dialog_preview" ).dialog({
                    title: $('#title'+ promo_id).val()
  				});
            $( "#dialog_preview" ).dialog("open");
  		}

         function cmd_dialog_ok (){
           $( "#dialog_preview" ).dialog("close");
         }
         function cmd_dialog_change (){
            promo_id = $('#preview_promo_id').val();
		    $('#edit_promo'+promo_id).trigger('click');
            cmd_dialog_ok ();
         }

	</script>
{/literal}


<div id="dialog_preview">

	<div id="dialog_preview_tab" style="width:580px; border:none !important;">
	<ul style="width:580px;">
			<li><a href="#promotion_info" style="padding:2px;font-size:11px;">Detail</a></li>

	</ul>
	<div id="promotion_info">
	<p>


	</p>

     <table style="width:570px;font-size:10px;">
	    <tr>
   			<td style='text-align:justify;'>

      <img src="templates/default/images/nologo.jpg" alt="no-logo" width="150" height="150" align="left" id="previewField" style='border:4px solid #FFFFFF;'/>
       <b>Valid From</b>&nbsp;<span id="preview_start_date"></span>&nbsp;&nbsp;&nbsp;&nbsp;<b>upto</b>&nbsp;<span id="preview_end_date"></span><br/><br/>
	   <span id="preview_comments"></span>
			</td>

        </tr>
        <tr>
            <td>
                <br/>
                <center>
                    <input type="hidden" id="preview_promo_id"/>
                    <input type="button" value="Ok" style="width:60px;" class="blackbutton" onclick="cmd_dialog_ok();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Change" style="width:90px;" class="blackbutton" onclick="cmd_dialog_change();"/>
                </center>
            </td>
        </tr>

    </table>
	</div>

</div>
</div>
