<div id="popup_csv_import" style="display:none;position:fixed;width:300px;z-index:900;top: 50%;left: 50%;margin-left:-120px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
    <h1> CSV Import </h1>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
    <form name="frm_csv_import" id="frm_csv_import" enctype="multipart/form-data"  method="post" action="{$website}/user/rewrad_point_list.php" onsubmit="return validate_me_now();">
	       Select csv file :<input id="uploaded" name="uploaded" type="file" maxlength="20" />
	       
	       <input name="mode" type="hidden" value="CSV_IMPORT" />
	       <br>
            <div class="biz_center">
            {jqmbutton icon="search" type="submit" value="Upload File" name="upfile" }
            <a href="#" onclick="$('#popup_csv_import').hide();" data-inline="true" data-role="button" data-theme="a" data-icon="delete" >Close</a>
            </div>
    </form>
    
		</div>
</div>
