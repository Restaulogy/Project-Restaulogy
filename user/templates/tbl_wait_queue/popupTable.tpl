<div data-role="popup" id="popupTable" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="width:200px;" class="ui-corner-all">
	 <div data-role="header" data-theme="a" class="ui-corner-top">
        <h6>Add Table</h6>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" class="ui-corner-bottom ui-content" style="padding:5px;">
	<form id="frmAddTable" action="{$page_url}" method="POST"> 
		<label>Table</label>
		<input type='text' name='wt_que_table_id' id='popup_table_id' value=''/>
		<input type='hidden' name='wt_que_id' id='popup_que_id' value='' />
		<input type='hidden' name='wt_que_is_cancelled' id='popup_is_cancelled' value='0' />	
		<input type='hidden' name='action' value='{$smarty.const.ACTION_DEACTIVATE}' />				
		<div class="clearfix"></div>
		<center>
			<input type='button' value="{$_lang.save_lbl}" onclick="saveQue();"/>
		</center>
	  </form>
	</div>
</div>