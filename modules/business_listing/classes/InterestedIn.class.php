<?php
class InterestedIn
{
	 var $mId= false;

	 function __construct($isPromotion=1 , $id=0)
	{

       if($_SESSION['guid']>0){
			if(is_gt_zero_num($id)){
				$sql_condition = " WHERE id=$id";
   			}else{
                $sql_condition = "WHERE
					    isPromotions = $isPromotion
					AND
                        userid =" . $_SESSION['guid'];
	  		}
            $sql = "SELECT id FROM pds_intrested_in $sql_condition";

            $result = mysql_query($sql);
            if($result){
                 while ($row = mysql_fetch_assoc($result))
    		      $this->mId = $row['id'];
            }
       }else{
            $this->mId = 0;
       }
 	}
    function getID() {
        return $this->mId;
    }

	function getAllFilters($isPromotion=1){
            $sql = "SELECT * FROM pds_intrested_in WHERE isPromotions = $isPromotion
					AND  userid =" . $_SESSION['guid'];

            $result = mysql_query($sql);
            $filters = array();
			if ($result){
                while ($row = mysql_fetch_assoc($result)) {
                    $filters[] = $row;
				}
   			}
   			return $filters;
 	}

    function GetInfo()
	{
	   $id = $this->mId;
	 if($id>0){
        $sql = "SELECT
	                `id`,
	                `title`,
					`userid`,
					`keywords`,
					`business_title`,
					`categories`,
					`countries`,
					`states`,
					`metro_area`,
					`isPromotions`,
					`created_date`
                FROM
					`pds_intrested_in`
				WHERE
                    id =" . $id ;
			$result = mysql_query($sql);
			$record =array();
			if($result){
                while($row = mysql_fetch_assoc($result)){
                    $row['metro_area_list'] = GetMetroAreaByState($row['states']);
                    $row['categories_str'] = $row['categories'];
                    $pos = strpos($row['categories'],':');
        			if($pos !== false) {
        				$breaker = ":";
           			}else{
        				$breaker = ",";
        	  		}
                    $row['list_categories'] = get_category_listing_values($row['categories'],$breaker);
                    $row['categories'] = explode($breaker,$row['categories']);
                    $row['isPromotions'] = $row['isPromotions'];
                    $row['metro_area_name'] = getMetroArea_name($row['metro_area']);
                    $row['state_name'] = getState_name($row['states']);
                    $record = $row;
                    break;
                }
            }
			return $record;
  		}
  		return array();
	}
	
	function isTitleExist($title,$user_id, $isPromotions=0, $id=0){

		if (is_not_empty($title)){
			$sql = "SELECT
						`pds_intrested_in`.`id`
					FROM
						`pds_intrested_in`
					WHERE
                        `pds_intrested_in`.`title` = '{$title}'
					AND
						`pds_intrested_in`.`userid`= {$user_id}
                    AND
						`pds_intrested_in`.`isPromotions`= {$isPromotions}";
			if (is_gt_zero_num($id)){
					$sql .= " AND `pds_intrested_in`.`id` <> {$id}";
			}
			$res = mysql_query($sql);
			if($res){
				$title_id = mysql_result($res,0);
				if(is_gt_zero_num($title_id)){
					return 1;
				}
				return 0;
   			}
  		}
  		return -1;
 	}
	

	function Create($params){
        if($params)
		{
        	$sql =
            "INSERT INTO
                `pds_intrested_in`
            (
	         	`userid`,
	         	`title`,
				`keywords`,
				`business_title`,
				`categories`,
				`countries`,
				`states`,
				`metro_area`,
				`isPromotions`
            )
            VALUES
            (
             " . $_SESSION['guid'] . ",
            '" . mysql_real_escape_string($params['title']) ."',
            '" . mysql_real_escape_string($params['keywords']) . "',
            '" . mysql_real_escape_string($params['business_title']) ."',
            '" . mysql_real_escape_string($params['categories']) . "',
            '" . mysql_real_escape_string($params['countries']) ."',
             " . mysql_real_escape_string($params['states']) . ",
             " . mysql_real_escape_string($params['metro_area']) . ",
             " . mysql_real_escape_string($params['isPromotions']) . "
             );";
                    
           	  $result = mysql_query($sql);
    			return mysql_insert_id();
 		}
     return 0;
 	}
 	
 	function Delete($id){
	 	if($id > 0){
  			$sql = "DELETE FROM `pds_intrested_in` WHERE id = $id";
    		$result = mysql_query($sql);
			if($result)
				return (mysql_affected_rows());
		}
		return 0;
	}

 	function Edit($params, $id=0){
        if($id == 0){
            $id = $this->mId;
        }

	 	if($id > 0)
		{
	        if($params)
			{

	        	$sql =
	            "UPDATE
	                `pds_intrested_in`
				 SET
				 title =
				  	'". mysql_real_escape_string($params['title'])."',
				  keywords =
				  	'". mysql_real_escape_string($params['keywords'])."',
				  business_title =
				  	'". mysql_real_escape_string($params['business_title'])."',
				  categories =
				  	'". mysql_real_escape_string($params['categories'])."',
				  countries =
				  	'".mysql_real_escape_string($params['country'])."' ,
				  states =
				  	".mysql_real_escape_string($params['states']).",
				  metro_area =
				  	".mysql_real_escape_string($params['metro_area'])."
				  where
				  		id=".$id;

				  $result = mysql_query($sql);
	        }
 		}
     return 0;
 	}
}
?>
