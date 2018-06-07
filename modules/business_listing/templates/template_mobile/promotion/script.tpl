{literal}
	    <script type="text/javascript">
		
	 
		
		function change_for_new_pdf(){
            var chk = $("#new_pdf:checked").length;
            pdf_promo_id = document.getElementById('pdf');
			if (chk){
				pdf_promo_id.disabled = 0;
					$('#pdf').parent().removeClass('ui-disabled').trigger('refresh');
				
   			}else{
                $('#pdf').val('');
				pdf_promo_id.disabled = 1;
					$('#pdf').parent().addClass('ui-disabled').trigger('refresh');
	  		} 
  		}

	    function redirect_promotion()
	    {
            var w = document.getElementById("choose_listing");
            var location_str = 'promotion.php?list_id=' + w.value;
            document.location.href= location_str;
		}
	    function get_listing()
	    {
			var w = document.getElementById("choose_listing");

			if (w.value == 0)
			{document.getElementById("Choose_btn").style.display = "none";
			}
			else
			{document.getElementById("Choose_btn").style.display = "inline";}
		}
	   function promotion_toggle()
	   {   var today = new Date();
	     var this_val =  document.getElementById("start_date1");
	     alert (Date.parse(this_val.value)+''+ Date.parse(today)) ;

	   }
	   
	function change_image_file() {
      img_promo_id = document.getElementById('promo_img');
      //alert(document.getElementById('use_list_img').checked);
	      if(document.getElementById('use_list_img').checked){
	        img_promo_id.disabled=1;
	      }else{
	        img_promo_id.disabled=0;
	      }
    }

    function change_cupons(){
        if(document.getElementById('cupon_type').value!="none"){
            $('#allowed_cupons_row').show();
        }else{
             $('#allowed_cupons_row').hide();
        }
    }

    function cupons_quanity_value(){
        if(document.getElementById('cupon_type').value!="none"){
            return 1;
        }else{
            $('#allowed_cupons').val('0');
            return 0;
        }
    }
    
    
    function call_preview(promo_id, template_id){
			if (template_id > 0){
                template_id = template_id;
   			}else{
                template_id = 0;
	  		}
            window.open('{/literal}{$elgg_main_url}{literal}modules/templates/index.php?post_id='+ promo_id +'&template_type=promotion&template_id='+ template_id);
		}
    
	    </script>
{/literal}
