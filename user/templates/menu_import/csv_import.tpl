{include file='header.tpl'}

<div class="wrapper" >

<h1>Import Menu from CSV</h1>

<br>
{if $err}
	<div class="biz_center">{$err}</div>
{/if}

<br>
<h4> Instruction for import:</h4>
<div class="info">
	<ul>
		<li> - Please upload files with csv format only</li>
		<li> - CSV File must have 'MENU','SUB MENU','DISH NAME','DISH DESCRIPTION','DISH PRICE' as column header.</li>
		<li> - For menu and sub menu you have to enter value for first item in same menu </li>		
	</ul>
</div>


	<div id="popup_csv_import"  class='ui-body-a'>
	    <!--<div data-role="header" data-theme="a" class="ui-corner-top">
	    <h1> CSV Import </h1>
	    </div>-->
	    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
	    <form name="frm_csv_import" id="frm_csv_import" enctype="multipart/form-data"  method="post" action="{$website}/user/csv_menu_import.php" onsubmit="return validate_me_now();">
		       Select csv file :<input id="uploaded" name="uploaded" type="file" maxlength="20" />
		       
		       <input name="mode" type="hidden" value="CSV_IMPORT" />
		       <br>
	            <div class="biz_center">
	            {jqmbutton icon="search" type="submit" value="Upload File" name="upfile" }
	           
	            </div>
	    </form>
	    
			</div>
	</div>

</div>

{literal}
<script type="text/javascript" src="{/literal}{$website}{literal}/js/flashMessage.js"></script>
<script type="text/javascript">
function validate_me_now(){
  var s = document.getElementById('uploaded');
  if(null != s && '' == s.value)
  {
    alert('Define file name');
    s.focus(); return false;
  }
  return true;
}
</script>
{/literal}

{include file='footercontent.tpl'}

</body>
</html>