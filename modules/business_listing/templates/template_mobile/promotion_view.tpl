<div id="dialog_preview{$promo_id}">

     <div id="dialog_preview_tab{$promo_id}" style="width:580px; border:none !important;">
        <ul style="width:580px;">
        	<li><a href="#promotion_info{$promo_id}" style="padding:2px;font-size:11px;">Detail</a></li>
        </ul>
    	<div id="promotion_info{$promo_id}">
         <table style="width:570px;font-size:10px;">
    	    <tr>
       			<td style='text-align:justify;'>
        			{if $promotion.img_ext}
                        <img src="promotion_images/{$promotion.id}.{$promotion.img_ext}" alt="{$promotion.title}" width="150" height="150" align="left" style='border:4px solid #FFFFFF;'/>
                    {else}
                        <img src="templates/default/images/nologo.jpg" alt="{$promotion.title}" width="150" height="150" align="left" style='border:4px solid #FFFFFF;'/>
                    {/if}
                    <b>Valid From</b>&nbsp;{$promotion.start_date|date_format:"%B %d, %Y"}&nbsp;&nbsp;&nbsp;&nbsp;<b>upto</b>&nbsp;{$promotion.end_date|date_format:"%B %d, %Y"}<br/><br/>
        	       {$promotion.comments}
								 
								 
								  
    			</td>
            </tr>
            <tr>
                <td>
                <center>
                    {if $promotion.pdf != "" }
        			     <a style="width:70px;" href="pdf/{$promotion.pdf}" target="_blank"><img style="border:none;width:15px;height:15px;" src='{$elgg_small_icon_url}print.png' alt="print"/>View/Print</a>
        			{/if}
                </center>
                </td>
            </tr>
            <tr>
                <td>
                    <br/>
                    <center>
                        <input type="button" value="Ok" onclick="cmd_dialog_ok({$promo_id});"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" value="Change" onclick="cmd_dialog_change({$promo_id});"/>
                        {if $is_new_insert}
                          &nbsp;&nbsp;&nbsp;&nbsp
                        <input type="button" value="Cancel" style="width:90px;" class="blackbutton" name="delete" onclick="cmd_dialog_cancel({$promo_id});"/>
                        {/if}
                    </center>
                </td>
            </tr>

          </table>
    	</div>
    </div>
</div>

{literal}
    <script type='text/javascript'>
        function cmd_dialog_ok (promo_id){
           $( "#dialog_preview"+promo_id).dialog("close");
        }
        function cmd_dialog_change (promo_id){
            $('#edit_promo'+promo_id).trigger('click');
            cmd_dialog_ok (promo_id);
        }
        function cmd_dialog_cancel(promo_id){
            cmd_dialog_ok (promo_id);
            $('#cmd_delete'+promo_id).trigger('click');

        }


     $(document).ready(function(){
        $( "#dialog_preview{/literal}{$promo_id}{literal}" ).dialog({
                    title: "{/literal}{$promotion.title}{literal}",
        			autoOpen: false ,
                    width: 620,
                    modal:true ,
                    zIndex: 11000
                    });
           $( "#dialog_preview_tab{/literal}{$promo_id}{literal}" ).tabs();
        {/literal}
		 {if $is_preview eq 1 && $current_promotion_id eq $promo_id}
		 {literal}

		    $( "#dialog_preview{/literal}{$promo_id}{literal}" ).dialog("open");

         {/literal}
		 {/if}

        {literal}

     });


    </script>
     {/literal}
