<?
	for ($x=0;$x<mysql_num_rows($r_list);$x++){
			$list[$x] = mysql_fetch_assoc($r_list);

			$check_file = "sublist".$list[$x][level].".tpl";
			if (is_readable("templates/$config[deftpl]/sublist/$check_file")){
				$list[$x][subfile] = $check_file;
			}else{
				$list[$x][subfile] = "sublist0.tpl";
			}
			if($x%2){
				$list[$x][bgcolor] = $config['bg_dark'];
			}else{
				$list[$x][bgcolor] = $config['bg_light'];
			}

			$check_file = $list[$x]['id'].".".$list[$x]['logo_ext'];
			if ($list[$x]['logo_ext'] != "" AND is_readable("logo/$check_file")){
				$list[$x]['logo'] = $check_file; //"$config[mainurl]/logo/$check_file?".rand();
		  }

		  $list[$x]['mod_firm'] = str_replace(" ","_",$list[$x]['firm']);
		  $list[$x]['mod_firm'] = str_replace("/","-",$list[$x]['mod_firm']);

          $list[$x]['tip_firm'] = addslashes(htmlentities($list[$x]['firm']));
          $list[$x]['tip_phone'] = addslashes(htmlentities($list[$x]['phone']));
          $list[$x]['tip_address'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['address1'])));
          $list[$x]['tip_description'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['description'])));
          $list[$x]['desc_elipsis'] = snippet($list[$x]['description']);
          $list[$x]['country'] = getCountry_name($list[$x]['country']);
		  $list[$x]['states'] = getState_name($list[$x]['states_id']);

    //** for Promotion start **//
    $sql =  mysql_fetch_row(mysql_query("SELECT count(id) FROM pds_list_promotions WHERE list_id =".$list[$x]['id']. " AND end_date>=CURDATE();"));
	$promotion_count = $sql[0];

	if ($promotion_count > 0)
	    {
            $list[$x]['promotion'] = 1 ;
            //$sql_qry = "SELECT * FROM pds_list_promotions WHERE list_id=".$list[$x]['id'];
			$sql_qry = "SELECT p.id, p.list_id,title,pdf,comments, case ispromotion when 1 then ifnull(f.id,0) else 0 end as is_promo_fav FROM pds_list_promotions p left outer join pds_list_favorites f on p.id = f.list_id  where p.list_id=".$list[$x]['id'] ." AND p.end_date>=CURDATE()";
		    //echo $sql_qry."<BR>";
			$result =  mysql_query($sql_qry) or die(mysql_error());
            for($y=0;$y<mysql_num_rows($result);$y++){
	           $list[$x]['user_promotion'][$y]=mysql_fetch_assoc($result);
	        }
            $row = mysql_fetch_assoc($result);

            $pdf_name  = string_replace_for_sql($row['title']);
            $pdf_size = round((filesize($config[root]."pdf/".$row['pdf'])/1024),2);
            // $list[$x]['user_promotion'] = $row;
            // $result = mysql_query($sql);

            $list[$x]['promotion_title'] =string_replace_for_sql($row['title']);
		    $list[$x]['promotion_pdf'] =$row['pdf'];
            $list[$x]['promotion_pdf_name'] = $pdf_name;
		}
	else
	    {
            $list[$x]['promotion'] = 0 ;
		}
    //** for Promotion End **//


    //*** For Favorite Listing start **//
    $strsql="SELECT count( id ) FROM pds_list_favorites WHERE list_id =".$list[$x]['id']." and user_id=".$_SESSION['userid'] ." and ispromotion = 0";

    $sql =  mysql_fetch_row(mysql_query($strsql));
	$favorites_count = $sql[0];

    $list[$x]['favorites'] = $favorites_count ;
}
?>
