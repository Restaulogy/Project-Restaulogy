<div data-role='page' id='CategoryDialog'>
	<div data-role='header'> 
		<h4>Select Category</h4>
		<a id='lnkCategoryDialog' href="#CategoryDialog" data-rel="dialog" data-transition="pop" style='display:none;'></a>
	</div>
	<div data-role='content' id='category_content' data-theme='b'></div> 
</div>
 
{literal}
	<script type="text/javascript"> 
		function show_category_dialog(text_ids,span_texts, vjoiner){
		$('#lnkCategoryDialog').trigger('click');
		$('#category_content').html('');   
		$.ajax({     
            type     : "POST",
			data	 : {'cat_texts':span_texts,'cat_ids':text_ids,'vjoiner':vjoiner, 'is_Business':1},
            url      : '{/literal}{$elgg_main_url}{literal}modules/checktree/mobile.php',
			datatype : "html",
            //data   : info, 
            success  : function(data) { 
                if(data){ 
				 $('#category_content').html(data); 
				 $('#category_content').trigger('create'); 
			      /*for(var i in CheckTree.list){ 
			      	CheckTree.list[i].init();
				  }
				  showDialogArgs(document.getElementById(text_ids).value, vjoiner);*/
				 	//$('#next_content').trigger('create');
            	}
            },
            error: function( objRequest ){
					alert(objRequest.responseText);
                     alert("Error occured");
            }
      });     
	}
	</script>
{/literal} 