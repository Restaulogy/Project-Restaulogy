<?php
		include_once(dirname(dirname(__FILE__)).'/init.php');
    $filedir 	= $_REQUEST['filedir'];
		
		$images 	= $_REQUEST['image'];
    $names 		= $_REQUEST['name'];  
		$cnt = count($images);
		/*$txt = 'sadsfasdf a '.$cnt.'...\n';
		foreach($_REQUEST as $key=>$req){
			$txt .= $key."=".$req."\n";
			if(is_array($req)){
				foreach($req as $k=>$val){
					$txt .= $k."=".$val."\n";
				}
			}
		}*/		 
		//print_r($_REQUEST);exit;		 
		//file_put_contents($filedir . "/sample.txt", $txt, FILE_APPEND | LOCK_EX);
		$img_src = array();
		for($i=0;$i<$cnt;$i++){
			$image = str_replace('data:image/png;base64,', '', $images[$i]);
    	$decoded = base64_decode($image); 
    	file_put_contents(PATHROOT."/".$filedir."/".$names[$i].".png", $decoded, LOCK_EX); 
			if(file_exists(PATHROOT."/".$filedir."/".$names[$i].".png")){
				$img_src[$names[$i]] = WWWROOT.$filedir."/".$names[$i].".png"; 
			}
			/*if(file_exists(PATHROOT.'/images/tables/occupied/'.$names[$i].'.png')){
				$img_src[$names[$i]] = WWWROOT.'images/tables/occupied/'.$names[$i].'.png'; 
			}*/			
		}
     
   echo json_encode($img_src);
?>