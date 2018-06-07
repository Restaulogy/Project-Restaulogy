<?php
Class GridOptions{
 	public	function Modes($bool = true){
		 
		return array(
	    "add"	 =>array("view"=>$bool, "edit"=>$bool, "type"=>"button" , "show_add_button"=>"outside"),
	    "edit"	 =>array("view"=>$bool, "edit"=>$bool,  "type"=>"button", "byFieldValue"=>""),
	    "cancel"  =>array("view"=>$bool, "edit"=>$bool,  "type"=>"button"),
	    "details" =>array("view"=>$bool, "edit"=>$bool, "type"=>"button"),
	    "delete"  =>array("view"=>$bool, "edit"=>$bool,  "type"=>"button") 
	 );
  	}

 	public function CSS(){
		global $grid_theme;
		return $grid_theme;
	}

 	public function Layouts(){
		return array("view"=>0, "edit"=>1, "filter"=>1);
	}

 	public function ExportingTypes(){
		return array("excel"=>"true", "pdf"=>"true", "xml"=>"true");
	}

	public function BottomPaging(){
		return array("results"=>true, "results_align"=>"left", "pages"=>true, "pages_align"=>"center", "page_size"=>true, "page_size_align"=>"right");
	}
	public function TopPaging(){
		return array();
	}
	public function Paging(){
		return array("10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000");
	}
	public function DefaultPages(){
		return 10;
	} 
	public function Paging_option(){
		return true;
	}
	public function Rows_numeration(){
		return false;
	}
	public function Numeration_sign(){
		return  "N #";
	}
	public function DebugMode(){
		return false;
	}
	public function Messaging(){
		return true;
	}
	public function unique_prefix(){
		return "f_";
	} 
	public function filtering_option(){
		return true;
	}
} 
?>
