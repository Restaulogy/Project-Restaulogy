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
subheader(_("Manage Facilities"));
if($sesslife == true) {
  if($Global_member['member_role_id'] == 5){
   $staff_id = $Global_member['staff_id'];
   //echo "staff_id=$staff_id";
   if(is_gt_zero_num($staff_id)){
      $grdOpt = new GridOptions();
//##  *** creating variables that we need for database connection
  $DB_USER=DB_USER;
  $DB_PASS=DB_PASSWORD;
  $DB_HOST=DB_SERVER;
  $DB_NAME=DB_NAME;

  ob_start();

  $db_conn = DB::factory('mysql');
  $db_conn -> connect(DB::parseDSN('mysql://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));

  $sql="SELECT `facility_id`,`facility_owner`,`facility_name`,`facility_address`,`facility_country`,`facility_state`,`facility_city`,`facility_zip`,`facility_phone_1`,`facility_phone_2`,`facility_start_date`,`facility_end_date` , `country_name`,  `cities_name`, `states_name`,IF(  `facility_end_date` >0,  'Inactive', IF( `facility_start_date` >0,  'Active',  'Inactive'))  'status', IF(  `facility_end_date` > CURDATE( ) , 'activate_facility', IF(  `facility_start_date` >0,  'deactivate_facility',  'activate_facility' ) )  'change_status',  IF(  `facility_end_date` > CURDATE( ) , 'Activate', IF(  `facility_start_date` >0,  'Deactivate',  'Activate' ) ) AS 'change'
    FROM `hm_facility`
    INNER JOIN `hm_country` on  `facility_country`= `country_iso`
    INNER JOIN `hm_cities` on  `facility_city`= `cities_id`
    INNER JOIN `hm_states` on `facility_state`= `states_abbrev`
    WHERE `facility_owner`={$staff_id}";

	$dgrid = new DataGrid($grdOpt->DebugMode(), $grdOpt->Messaging(), $grdOpt->Unique_prefix(), DATAGRID_DIR);
//  *** set data source with needed options
  $default_order_field = "facility_id";
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
  $countries= getCountries();
  $states = getStates();
  $cities = getCities("AZ");
  $filtering_fields = array(
	"Name"     =>array("table"=>"hm_facility", "field"=>"facility_name", "source"=>"self", "operator"=>true, "default_operator"=>"like", "type"=>"textbox", "case_sensitive"=>true,  "comparison_type"=>"string"),
    "Address"        =>array("table"=>"hm_facility", "field"=>"facility_address", "source"=>"self", "operator"=>true, "type"=>"textbox", "case_sensitive"=>false,  "comparison_type"=>"string"),
	 "Zip"        =>array("table"=>"hm_facility", "field"=>"facility_zip", "source"=>"self", "operator"=>true, "type"=>"textbox", "case_sensitive"=>false,  "comparison_type"=>"string"),
	  "Phone"        =>array("table"=>"hm_facility", "field"=>"facility_phone_1", "source"=>"self", "operator"=>true, "type"=>"textbox", "case_sensitive"=>false,  "comparison_type"=>"string"),
	  "Phone2"        =>array("table"=>"hm_facility", "field"=>"facility_phone_2", "source"=>"self", "operator"=>true, "type"=>"textbox", "case_sensitive"=>false,  "comparison_type"=>"string"),
	"Country"        =>array("table"=>"hm_facility", "field"=>"facility_country", "source"=>"self", "operator"=>true, "type"=>"dropdownlist", "source"=>$countries, "case_sensitive"=>false,  "comparison_type"=>"string", "on_js_event"=>"onchange=\"change_state('f__ff_hm_facility_facility_country','f__ff_hm_facility_facility_state');\""),
	"State"        =>array("table"=>"hm_facility", "field"=>"facility_state", "source"=>"self", "operator"=>true, "type"=>"dropdownlist", "source"=>$states, "case_sensitive"=>false,  "comparison_type"=>"string" ,"on_js_event"=>"onchange=\"change_cities('f__ff_hm_facility_facility_state','f__ff_hm_facility_facility_city');\""),
	"City"        =>array("table"=>"hm_facility", "field"=>"facility_city", "source"=>"self", "operator"=>true, "type"=>"dropdownlist", "source"=>$cities, "case_sensitive"=>false,  "comparison_type"=>"string")
  );
  $dgrid->setFieldsFiltering($filtering_fields);
// 6. View Mode Settings:   ====================
 $vm_colimns = array(
    "facility_name" =>array("header"=>"Name",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "facility_address" =>array("header"=>"Address",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "cities_name" =>array("header"=>"City",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "states_name" =>array("header"=>"State",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     /*
"country_name" =>array("header"=>"Country",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "facility_zip" =>array("header"=>"Zip",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "facility_phone_1" =>array("header"=>"Phone",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
     "facility_phone_2" =>array("header"=>"Phone 2",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
*/
	 "status" =>array("header"=>"Status",     "type"=>"textbox", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
    "change" =>array("header"=>"Action", "type"=>"link", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>"", "field_key"=>"facility_id","field_key_1"=>"change_status", "field_data"=>"change", "href"=>WWWROOT."action.php?action={1}&id={0}")
  );
  $dgrid->setColumnsInViewMode($vm_colimns);

// 7. Edit Mode Settings:   ====================
  $table_name = "hm_facility";
  $primary_key = "facility_id";
  $condition = "";
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  $em_columns = array(
    "facility_id" =>array("header"=>"id", "type"=>"hidden",  "width"=>"210px", "req_type"=>"rt", "title"=>"Id"),
    "facility_owner" =>array("header"=>"facility_owner", "type"=>"hidden",  "width"=>"210px", "req_type"=>"rt", "title"=>"Id","default"=>$staff_id),
	"facility_name"  =>array("header"=>"Name", "type"=>"textbox",  "width"=>"210px", "req_type"=>"rt", "title"=>"Name"),
	"facility_address"  =>array("header"=>"Address", "type"=>"textarea",  "width"=>"210px", "req_type"=>"rt", "title"=>"Address"),
	"facility_country"  =>array("header"=>"Country", "type"=>"enum", "source"=>$countries, "width"=>"210px", "req_type"=>"rt", "title"=>"Address","default"=>"US","on_js_event"=>"onchange=\"change_state('rtyfacility_country','rtyfacility_state');\""),
	"facility_state"  =>array("header"=>"State", "type"=>"enum", "source"=>$states,  "width"=>"210px", "req_type"=>"rt", "title"=>"State", "on_js_event"=>"onchange=\"change_cities('rtyfacility_state','rtyfacility_city');\""),
	"facility_city"  =>array("header"=>"City", "type"=>"enum", "source"=>$cities,  "width"=>"210px", "req_type"=>"rt", "title"=>"City"),
	"facility_zip"  =>array("header"=>"Zip", "type"=>"text", "field"=>"facility_zip", "width"=>"210px", "req_type"=>"rz", "title"=>"Zip"),
	"facility_phone_1"  =>array("header"=>"Phone", "type"=>"text", "field"=>"facility_phone_1", "width"=>"210px", "req_type"=>"rm", "title"=>"Phone"),
	"facility_phone_2"  =>array("header"=>"Phone2", "type"=>"text", "field"=>"facility_phone_2", "width"=>"210px", "req_type"=>"sy", "title"=>"Phone2")
	);
  $dgrid->setColumnsInEditMode($em_columns);
// 8. Bind the DataGrid: =========================
	$dgrid->bind();
    ob_end_flush();
   }else {
	  echo "<div class=\"errorbox\">Controller Not found in the system.</div>";
   }
  }else{
	  echo "<div class=\"errorbox\">Only Facility Controller Manage This.</div>";
  }
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0;url={$website}/".USER_DIRECTORY."/login\" />";
}
?>
<script type="text/javascript">
function change_state(country_id,state_id){
 
	var country_val = $('#'+country_id).val();  
	$.post( "<?php echo WWWROOT;?>ajax/getOptions.php",
		{ search : 'states', id: country_val},
        function(results){   
           if (!results) return;
           $('#' + state_id).html(results);
    });  
}
function change_cities(state_id,city_id){
	var state_val = $('#'+state_id).val();  
	$.post( "<?php echo WWWROOT;?>ajax/getOptions.php",
	   { search : 'city', id: state_val },
        function(results){   
       		if (!results) return;
       	$('#' + city_id).html(results);
    });  
}
/*$(function() { 
	$("#rtyfacility_country").change(change_state('rtyfacility_country','rtyfacility_state'));
	$("#rtyfacility_state").change(change_cities('rtyfacility_state','rtyfacility_city')); 
	$("#f__ff_hm_facility_facility_country").change(change_state('f__ff_hm_facility_facility_country','f__ff_hm_facility_facility_state'));
	$("#f__ff_hm_facility_facility_state").change(change_cities('f__ff_hm_facility_facility_state','f__ff_hm_facility_facility_city')); 
 });*/

</script>


<?php
include("footer.php");  
?> 
