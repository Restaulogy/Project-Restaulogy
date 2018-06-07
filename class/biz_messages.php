<?php
class biz_messages{
	var $msg_box_css ; 
	function css(){
	    global $CONFIG;
		$str = "
			<style type='text/css'>/* NOTIFICATIONS */
				.biz_attention, .biz_approved,  .biz_fail, .biz_notice , .biz_alert, .biz_info {
				    background-repeat:no-repeat;
					background-position: 1px 3px;
					color:#fc6300;
					border-width:1px;
					border-left: 0;
					border-right: 0;
					border-style:solid;
				    padding:1px 2px 3px 17px;
					vertical-align:middle;
					position:relative !important;
					width:94%;  /* height:15px; */
					line-height:15px;
				    text-align:left;
					margin:2px 1px 2px 0px;
					font-family:  Arial;
					font-size:10px !important;
				}
				
				.biz_attention a, .biz_approved a,  .biz_fail a, .biz_notice a, .biz_alert a , .biz_info a {
					color: ".ELGG_BLUE." !important;
					text-decoration:none  !important;
				 	line-height:15px !important;
			     }

				.biz_attention
				{
					background-color:#FFF3A3;
					background-image: url('{$CONFIG->wwwroot}_graphics/biz_messages/exclamation.png');
					border-color: #E7BD72;
					color:black;
				}
				.biz_approved
				{
					background-color:#CDEFA6;
					background-image: url('{$CONFIG->wwwroot}_graphics/biz_messages/tick.png');
					border-color: #9BCC54;
				}
				.biz_fail
				{
					/*
					background-color:#FFD5D5;
					background-image: url('{$CONFIG->wwwroot}_graphics/biz_messages/fail.png');
					border-color: #FFACAD;
					*/
					background-color:orange; border: none;
                    background-image: url('{$CONFIG->wwwroot}_graphics/biz_messages/fail.png');
					border-color:#FC6300;
   					color:white;
				}
				.biz_notice
				{
					background-color:#E6E6E6;
					background-image: url('{$CONFIG->wwwroot}_graphics/biz_messages/note.png');
					border-color: #C5C5C5;
				}
				.biz_alert
				{
					background-color:#FFF3A3;
					background-image: url('{$CONFIG->wwwroot}_graphics/biz_messages/exclamation.png');
					border-color: #E7BD72;
					color: red;
				}
				.biz_info {
                    border-color:none;
					background-color:#cee7ff;
					border-color:#9fd0ff  !important;
					color:black;
					background-image: url('{$CONFIG->wwwroot}_graphics/biz_messages/info.png');
				}
				
				.biz_msg_close{
                    display:inline-block;
					 /*float:right;*/
					width:16px;
					height:16px;
                    background:url('{$CONFIG->wwwroot}_graphics/biz_messages/close.png') no-repeat;
				}
			</style> ";
		return $str;
	}
	
    function __construct($isScript=0){  
	  if (is_gt_zero_num($isScript)){
	  	
	  }else{
	  	echo $this->css();
	  }	 
 	}

	private function msg_block($type, $msg, $isClose=1){
		/*return "<center><div class='".$this->get_block_class($type)."'><b style='float:left;'>$msg</b> <a class='biz_msg_close'  title='close' href='#' onclick='$(this).parent().hide();'></a></div></center>";*/
		//return "<center><div class='".$this->get_block_class($type)."'><b >$msg</b> <a class='biz_msg_close'  title='close' href='#' onclick='this.parentNode.style.display = \"none\";'></a></div></center>"; 
		return "<center><table class='".$this->get_block_class($type)."'><tr><td><b>$msg</b></td><td style='width:18px;vertical-align:top;'>".(is_gt_zero_num($isClose)?"<a class='biz_msg_close' title='close' href='#' onclick='this.parentNode.parentNode.parentNode.parentNode.style.display = \"none\";'></a>":"")."</td></tr></table></center>";
	}


	private function get_block_class($type){
        $class = "biz_notice";
		switch(strtoupper($type)){
			case "ERROR" 	: $class = "biz_fail";
							   break;
            case "ALERT" 	: $class = "biz_alert";
							   break;
            case "ATTENTION": $class = "biz_attention";
							   break;
            case "SUCCESS" 	: $class = "biz_approved";
							   break;
            case "NOTICE" 	: $class = "biz_notice";
							   break;
            case "INFO" 	: $class = "biz_info";
							   break;
  		}
  		return $class;
 	}
	function alert($msg,$isClose=1){
		return  $this->msg_block("ALERT", $msg,$isClose);
	}
    function success($msg,$isClose=1){
		return  $this->msg_block("SUCCESS", $msg,$isClose);
	}
    function error($msg,$isClose=1){
		return  $this->msg_block("ERROR", $msg,$isClose);
	}
    function notice($msg,$isClose=1){
		return  $this->msg_block("NOTICE", $msg,$isClose);
	}
    function attention($msg,$isClose=1){
		return  $this->msg_block("ATTENTION", $msg,$isClose);
	}
	function info($msg,$isClose=1){
		return  $this->msg_block("INFO", $msg,$isClose);
 	} 
} 
?>
