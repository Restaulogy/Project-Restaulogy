{literal}
    <script>
	//reset type=date inputs to text
		$( document ).bind( "mobileinit", function(){
			$.mobile.page.prototype.options.degradeInputs.date = true;

		});
		
  		$( ".ui-page" ).live( "pagecreate", function(){
            $(".ui-datepicker").hide();
  		});
		
	</script>
	<script type="text/javascript">
		function toggle_datepicker(field_id, is_show){
			var field_contain_id_str = "#" + field_id + "_contain";
			var showcal_field_id_str = "#" + field_id + "_showcal";
			var hidecal_field_id_str = "#" + field_id + "_hidecal";
			if(is_show == 1){
	            $("div.ui-datepicker", field_contain_id_str).show();
	            $(showcal_field_id_str).hide();
	            $(hidecal_field_id_str).show();
	  		}else{
	            $("div.ui-datepicker", field_contain_id_str).hide();
	            $(showcal_field_id_str).show();
	            $(hidecal_field_id_str).hide();
			}
            
  		}
	</script>
	
	
{/literal}
