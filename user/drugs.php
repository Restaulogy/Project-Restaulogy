<?php 
/*
################################################################################   
## +---------------------------------------------------------------------------+
## | 1. Creating & Calling:                                                    | 
## +---------------------------------------------------------------------------+
##  *** only relative (virtual) path (to the current document)
*/
  define ("DATAGRID_DIR", "../grid/");
  define ("PEAR_DIR", "../grid/pear/");
  
  require_once(DATAGRID_DIR.'datagrid.class.php');
  require_once(PEAR_DIR.'PEAR.php');
  require_once(PEAR_DIR.'DB.php');
  
  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php");
subheader(_("Drugs")); 
if($sesslife == true) {
  $grdOpt = new GridOptions();
//##  *** creating variables that we need for database connection 
  $DB_USER=DB_USER;
  $DB_PASS=DB_PASSWORD;
  $DB_HOST=DB_SERVER;
  $DB_NAME=DB_NAME;

  ob_start();

  $db_conn = DB::factory('mysql'); 
  $db_conn -> connect(DB::parseDSN('mysql://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));
  

//  *** put a primary key on the first place
  
  $sql="SELECT  `drug_codes_id` ,  `drug_codes_name` ,  `drug_codes_description` ,  `drug_codes_type` ,  `drug_type_name` , `drug_codes_start_date` ,  `drug_codes_end_date` , IF(  `drug_codes_end_date` >0,  'Inactive', IF( `drug_codes_start_date` >0,  'Active',  'Inactive') )  'status', IF(  `drug_codes_end_date` > CURDATE( ) , 'activate_drug', IF(  `drug_codes_start_date` >0,  'deactivate_drug',  'activate_drug' ) )  'change_status',  IF(  `drug_codes_end_date` > CURDATE( ) , 'Activate', IF(  `drug_codes_start_date` >0,  'Deactive',  'Activate' ) ) AS 'change' FROM  `hm_drug_codes` INNER JOIN hm_drug_type ON drug_type_id = drug_codes_type";
  /*
  $sql="SELECT md_admins_id  , md_fname , md_lname, md_admins_start_date, md_admins_end_date  FROM hm_md_admins inner join hm_tbl_md on md_id= md_admins_md_admin";
  */
//  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
//  *** set data source with needed options
  $default_order_field = "drug_codes_id";
  $default_order_type = "ASC";
 $dgrid->dataSource($db_conn, $sql, $default_order_field, $default_order_type);
 // 2. General Settings :================================== 
 $dg_encoding = "utf8";
 $dg_collation = "utf8_unicode_ci";
 $dgrid->setEncoding($dg_encoding, $dg_collation); 
 $dgrid->setInterfaceLang("en"); 
 $dgrid->setDirection("ltr");  
 $dgrid->setLayouts($grdOpt->Layouts()); 
 $dgrid->setModes($grdOpt->Modes()); 
 $css_type = "embedded"; 
 $dgrid->setCssClass($grdOpt->CSS(), $css_type); 
 $dgrid->setCaption(''); 
 //  3. Printing & Exporting Settings:  ====================
 $dgrid->allowPrinting(true);  
 $exporting_directory = dirname(dirname(__FILE__))."/grid/export/"; 
  $dgrid->AllowExporting(true, $exporting_directory); 
  $dgrid->AllowExportingTypes($grdOpt->ExportingTypes()); 
 //  4. Sorting & Paging Settings:  ====================
 $dgrid->allowSorting(true);      
 $dgrid->allowPaging($grdOpt->Paging_option(), $grdOpt->Rows_numeration(), $grdOpt->Numeration_sign()); 
 $dgrid->setPagingSettings($grdOpt->BottomPaging(), $grdOpt->TopPaging(), $grdOpt->Paging(), $grdOpt->DefaultPages()); 
 // 5. Filter Settings:  ====================  
  $dgrid->allowFiltering($grdOpt->filtering_option());  
  $obj = new hm_drug_type();
  $drug_types = $obj->GetDrugTypeList(); 
  $filtering_fields = array( 
	"Name"     =>array("table"=>"hm_drug_codes", "field"=>"drug_codes_name", "source"=>"self", "operator"=>true, "default_operator"=>"like", "type"=>"textbox", "case_sensitive"=>true,  "comparison_type"=>"string"), 
    "Description"        =>array("table"=>"hm_drug_codes", "field"=>"drug_codes_description", "source"=>"self", "operator"=>true, "type"=>"textbox", "case_sensitive"=>false,  "comparison_type"=>"string"),  
	"Type"        =>array("table"=>"hm_drug_codes", "field"=>"drug_codes_type", "source"=>"self", "operator"=>true, "type"=>"dropdownlist", "source"=>$drug_types, "case_sensitive"=>false,  "comparison_type"=>"string") 
  );
  $dgrid->setFieldsFiltering($filtering_fields);
// 6. View Mode Settings:   ====================  

 $vm_colimns = array( 
    "drug_codes_name" =>array("header"=>"Name",     "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "drug_codes_description" =>array("header"=>"Description",     "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "drug_type_name" =>array("header"=>"Type",     "type"=>"text", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""  ),
	 "status" =>array("header"=>"Status",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
    "change" =>array("header"=>"Action", "type"=>"link", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>"", "field_key"=>"drug_codes_id","field_key_1"=>"change_status", "field_data"=>"change", "href"=>WWWROOT."action.php?action={1}&id={0}") 
  );
  $dgrid->setColumnsInViewMode($vm_colimns); 
 // 7. Edit Mode Settings:   ====================    
  $table_name = "hm_drug_codes";
  $primary_key = "drug_codes_id";
  $condition = "";
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  
  $em_columns = array(  
	"drug_codes_name"  =>array("header"=>"Name", "type"=>"textbox",  "width"=>"210px", "req_type"=>"rt", "title"=>"Name"),
	"drug_codes_description"  =>array("header"=>"Description", "type"=>"textarea",  "width"=>"210px", "req_type"=>"rt", "title"=>"Description"),
	"drug_codes_type"  =>array("header"=>"Type", "type"=>"enum", "field"=>"drug_codes_type", "source"=>$drug_types, "width"=>"210px", "req_type"=>"sy", "title"=>"Type"),
	"drug_codes_start_date"  =>array("header"=>"Date", "type"=>"hidden", "field"=>"drug_codes_start_date", "width"=>"210px", "req_type"=>"sy", "default"=>date("Y-m-d H:i:s"))    
  ); 
  $dgrid->setColumnsInEditMode($em_columns);
     
// 8. Bind the DataGrid: =========================  
	$dgrid->bind();        
    ob_end_flush(); 
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0;url={$website}/".USER_DIRECTORY."/login\" />";
}

include("footer.php");  
?> 
