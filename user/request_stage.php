<?php 
	 $current_status_color = CLR_WHITE; 
	 $current_status_icon = ICN_INITIATE; 
 
 	if($info[$request['id']][SRVC_REQST_STATUS] == SERVICE_STATUS_CANCELLED){
		 $info[$request['id']]['current_status'] = SERVICE_STATUS_CANCELLED;
		 $current_status_color = CLR_GRAY;
		 $current_status_icon = ICN_CANCELLED;
	}else{
		if(is_not_empty($remain_stages)){
	 	$info[$request['id']]['current_status'] = SERVICE_STATUS_IN_PROCESS;
	 	//.. Check first item from the list
		  foreach($remain_stages as $val){
				$current_stage = $val;break;
			}
	 		 
			 
			$cal_sec = 0; 
		if(strtotime($request[SRVC_REQST_CREATED_ON]) > 0){
		 $cal_sec = strtotime('now') - strtotime($request[SRVC_REQST_CREATED_ON]); 
		}
		//..if current stage is order picked stage 
		if($current_stage['id'] == ORDER_PICKED){ 
		 
			if($current_stage['exp_time'] < $cal_sec){ 
				if(isCustomer()){  
					$current_status_color = CLR_YELLOW;
					$current_status_icon = ICN_IN_PROCESS;  
			 }else{ 
					$current_status_color = CLR_RED;
					$current_status_icon = ICN_NOT_IN_TIME;  
			 } 
			}else{
				$current_status_color = CLR_GREEN;
				$current_status_icon = ICN_COMPLETE; 
			}
		}else{
			if($current_stage['exp_time'] < $cal_sec){ 
			 if(isCustomer()){ 
			  
				$current_status_color = CLR_YELLOW;
				$current_status_icon = ICN_IN_PROCESS;  
			 }else{
			 	
				$current_status_color = CLR_RED;
				$current_status_icon = ICN_NOT_IN_TIME;  
			 }
			}else{
				$current_status_color = CLR_YELLOW;
				$current_status_icon = ICN_IN_PROCESS;
			}
		}   
			
	 }else{
	 	 $info[$request['id']]['current_status'] = SERVICE_STATUS_COMPLETD;
		 $current_status_color = CLR_WHITE;
		 $current_status_icon = ICN_COMPLETE;
	 }
	} 
	 $info[$request['id']]['current_status_color'] = $current_status_color; 
	 $info[$request['id']]['current_status_icon'] = $current_status_icon;  
?>