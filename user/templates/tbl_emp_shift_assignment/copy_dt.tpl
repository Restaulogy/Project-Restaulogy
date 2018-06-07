<div id="popupCopyDate" style="display:none;position:fixed;width:270px;z-index:100;" class='ui-body-a'>
  <div data-role="header" data-theme="h">
		<h4>Copy Schedule </h4>
	</div>
	<div data-role="content" data-theme="a" style="padding:5px;">
	
	<fieldset data-mini="true" data-role="controlgroup" data-type="horizontal">
				
				 	<input type="radio" name="cpydttype" id="cpydttype1" value="1"/>
         	<label for="cpydttype1">Single Day</label>
					<input type="radio" name="cpydttype" id="cpydttype2" value="0"/>
         	<label for="cpydttype2">Date Range</label> 
						<input type="radio" name="cpydttype" id="cpydttype3" value="2"/>
         	<label for="cpydttype3">Week</label>  
	</fieldset>
	<label>Source Date</label>
	<input type="text" readonly="readonly" id="cpydtsrc" value=""/> 
	<div id="box_cpydttype1" class="biz_hidden" style="width: 100%;"> 
	 <label>Destination Date</label> 
		<input type='text' id='cpydtsingle' readonly="readonly" value=''/>
	</div>
	<div id="box_cpydttype2" class="biz_hidden" style="width: 100%;">
	
	<label>From</label>
		<input type='text' id='cpydtfrm' readonly="readonly"   value=''/>
	<label>To</label>
		<input type='text' id='cpydtto' readonly="readonly"  value=''/>
	</div>
	
	<div id="box_cpydttype3" class="biz_hidden" style="width: 100%;"> 
	<label>From</label>
		<input type='hidden' id='cpywksrc' value=''/>
	 	<label id='lbl_cpywksrc'></label>
	<label>To</label>
		<select id='cpywkdsr' data-native-menu="false" data-mini="true" multiple="multiple"></select>
	</div> 
	
	 
	 
	<div class="clearfix line_break"></div>
		<center><input type="button" onclick="copyDtFromSrc();" data-icon="copy-item" value="Copy" data-inline='true'/>
	<input type="button" onclick="$('#popupCopyDate').hide();" value="{$_lang.cancel_lbl}" data-icon="delete" data-inline='true'/></center>
	</div>
</div>