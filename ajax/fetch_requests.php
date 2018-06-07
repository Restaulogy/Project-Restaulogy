<?php

include_once(dirname(dirname(__FILE__))."/init.php");
include("header.php");

$tplres ="";
 if($sesslife == true){ 
 	echo "<link rel=\"stylesheet\" href='{$CONFIG->wwwroot}modules/eyedatagrid/table.css'>";
	require_once($CONFIG->path.'/modules/eyedatagrid/class.eyemysqladap.inc.php');
	require_once($CONFIG->path.'/modules/eyedatagrid/class.eyedatagrid.inc.php');
	// Load the database adapter
	$db = new EyeMySQLAdap('localhost', 'root', '', 'test');

	// Load the datagrid class
	$x = new EyeDataGrid($db,$CONFIG->wwwroot."modules/eyedatagrid/images/");

	// Set the query
	//$x->setQuery("*", "people", 'Id');
	$qry = "SELECT 
			`srvc_reqst_id` 'id', `table_number` 'Table',`srvc_name` 'Service',
			CASE IF( `srvc_reqst_emp_id` >0, 1, 0 )
			WHEN 1
			THEN CONCAT( staff_fname, ' ', staff_lname )
			ELSE '--'
			END AS `Server`, 
			`srvc_reqst_created_by` 'Customer',`srvc_reqst_status` 'Status' 
			FROM 
				`tbl_services_requests`
			INNER JOIN 
				`tbl_dining_table` ON `table_id` = `srvc_reqst_table_id`
			INNER JOIN 
				`tbl_services_code` ON `srvc_id` = `srvc_reqst_srvc_id`
			LEFT OUTER JOIN 
				`tbl_staff` ON `srvc_reqst_emp_id` = `staff_member_id`";
	$x->biz_setQuery($qry);
	//..Dont USE WHERE 

	// Allows filters
	$x->allowFilters();

	// Show reset grid control
	$x->showReset();

	// Add custom control, order does matter
	/*$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "alert('%FirstName%\'s been promoted!')", EyeDataGrid::TYPE_ONCLICK, 'Promote Me');

	// Add standard control
	$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "alert('Editing %LastName%, %FirstName% (ID: %_P%)')");
	$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "alert('Deleting %_P%')");

	// Add create control
	$x->showCreateButton("alert('Code for creating a new person')", EyeDataGrid::TYPE_ONCLICK, 'Add New Person');*/
	// Show checkboxes
	/*$x->showCheckboxes();
	// Show row numbers
	$x->showRowNumber();*/
	// Change the amount of results per page
	$x->setResultsPerPage(10);

	$tplres =$x->printTable();
 }
 echo $tplres;
 
?>