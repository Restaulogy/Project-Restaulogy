<?PHP
// partial part of rating
//passing variable: $rating_listid


    $Q_arr = array();



    // Question 1:
    $Q_arr[0]['question'] = 'How would you rate the performance of the Business/contractor?';

    // Question 2:
    $Q_arr[1]['question'] = 'How was the quality of service/product?';

    // Question 3:
    $Q_arr[2]['question'] = 'Was the work delivered in a timely fashion?';
    
    // Question 4:
    $Q_arr[3]['question'] = 'How would you rate their business and technical knowledge?';

    // Question 5:
    $Q_arr[4]['question'] = 'How was after sale customer service?';

    // Question 6:
    $Q_arr[5]['question'] = 'Would you recommend them to your friends and other connections?';

    /*
    // Question 7:
    $Q_arr[6]['question'] = 'How was the after sale service?';
    */




	$sql = "SELECT firm,
			CEILING(round(avg( ifnull(question1,0)),1)*2) as avg_q1,
			CEILING(round(avg( ifnull(question2,0)),1)*2) as avg_q2,
			CEILING(round(avg( ifnull(question3,0)),1)*2) as avg_q3,
			CEILING(round(avg( ifnull(question4,0)),1)*2) as avg_q4,
			CEILING(round(avg( ifnull(question5,0)),1)*2) as avg_q5,
			CEILING(round(avg( ifnull(question6,0)),1)*2) as avg_q6,
  			sum(case ifnull(question1,0) when 0 then 0 Else 1 End) as count_q1,
   			sum(case ifnull(question2,0) when 0 then 0 Else 1 End) as count_q2,
   			sum(case ifnull(question3,0) when 0 then 0 Else 1 End) as count_q3,
			sum(case ifnull(question4,0) when 0 then 0 Else 1 End) as count_q4,
			sum(case ifnull(question5,0) when 0 then 0 Else 1 End) as count_q5,
			sum(case ifnull(question6,0) when 0 then 0 Else 1 End) as count_q6
			
			FROM pds_votes v right outer join pds_list l
			on v.list_id = l.id
			GROUP BY l.id having l.id =".$rating_listid;

	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	mysql_free_result($result);


    for($i=0; $i < 6 ; $i++ ){
      $j = $i + 1;
         $Q_arr[$i]['avg'] = $row["avg_q{$j}"];
         $Q_arr[$i]['count'] = $row["count_q{$j}"];
    }
    unset ($i);
    unset ($j);
	
$Q_stats  ='
<tr>
	<th colspan="2"><b>Recommendations For <u>'.$row['firm'].'</u></b></td>
</tr>
<tr>
		<td colspan="2" class="left_td" style="width:700px;font-weight:bold;">
    1.	How would you rate the performance of the Business/contractor?
		&nbsp;<img  src="graphics/'.$row['avg_q1'].'.gif" alt="'.$row['avg_q1'].'"/>
		&nbsp;'.$row['count_q1'].' votes
		</td>
</tr>
<tr>
		<td colspan="2" class="left_td" style="width:700px;font-weight:bold;">
    2.	How was the quality of service/product?
	&nbsp;<img  src="graphics/'.$row['avg_q2'].'.gif" alt="'.$row['avg_q2'].'"/>
	&nbsp;'.$row['count_q2'].' votes
		</td>
</tr>
<tr >
		<td colspan="2" class="left_td" style="width:700px;font-weight:bold;">
    3.	Was the work delivered in a timely fashion?
 	&nbsp;<img  src="graphics/'.$row['avg_q3'].'.gif" alt="'.$row['avg_q3'].'"/>
	&nbsp;'.$row['count_q3'].' votes
		</td>
</tr>
<tr>
		<td colspan="2" class="left_td" style="width:700px;font-weight:bold;">
    4.	How would you rate their business and technical knowledge?
    &nbsp;<img  src="graphics/'.$row['avg_q4'].'.gif" alt="'.$row['avg_q4'].'"/>
	&nbsp;'.$row['count_q4'].' votes
		</td>
</tr>
<tr>
		<td colspan="2" class="left_td" style="width:700px;font-weight:bold;">
    5.	How was after sale customer service?
    &nbsp;<img  src="graphics/'.$row['avg_q5'].'.gif" alt="'.$row['avg_q5'].'"/>
	&nbsp;'.$row['count_q5'].' votes
		</td>
</tr>
<tr>
		<td colspan="2" class="left_td" style="width:700px;font-weight:bold;">
    6.	Would you recommend them to your friends and other connections?
    &nbsp;<img  src="graphics/'.$row['avg_q6'].'.gif" alt="'.$row['avg_q6'].'"/>
	&nbsp;'.$row['count_q6'].' votes
		</td>
</tr>
<!--
<tr>
		<td colspan="2" class="left_td" style="width:700px;font-weight:bold;">
 	7. How was the after sale service?
    &nbsp;<img  src="graphics/'.$row['avg_q7'].'.gif" alt="'.$row['avg_q7'].'"/>
	&nbsp;'.$row['count_q7'].' votes
		</td>
</tr>
-->
  ';
    $sql = "SELECT vote_id, list_id, vote, created_on, user_id,
                 CASE question1 WHEN 1 THEN 'Very Negative'
                                WHEN 2 THEN 'Negative'
                                WHEN 3 THEN 'Neutral'
                                WHEN 4 THEN 'Positive'
                                WHEN 5 THEN 'Very Positive'
                                ELSE ''
                 END As answer1,
                 CASE question2 WHEN 1 THEN 'Very Negative'
                                WHEN 2 THEN 'Negative'
                                WHEN 3 THEN 'Neutral'
                                WHEN 4 THEN 'Positive'
                                WHEN 5 THEN 'Very Positive'
                                ELSE ''
                 END As answer2,
                 CASE question3 WHEN 1 THEN 'Very Negative'
                                WHEN 2 THEN 'Negative'
                                WHEN 3 THEN 'Neutral'
                                WHEN 4 THEN 'Positive'
                                WHEN 5 THEN 'Very Positive'
                                ELSE ''
                 END As answer3,
                 CASE question4 WHEN 1 THEN 'Very Negative'
                                WHEN 2 THEN 'Negative'
                                WHEN 3 THEN 'Neutral'
                                WHEN 4 THEN 'Positive'
                                WHEN 5 THEN 'Very Positive'
                                ELSE ''
                 END As answer4,
                 CASE question5 WHEN 1 THEN 'Very Negative'
                                WHEN 2 THEN 'Negative'
                                WHEN 3 THEN 'Neutral'
                                WHEN 4 THEN 'Positive'
                                WHEN 5 THEN 'Very Positive'
                                ELSE ''
                 END As answer5,
                 CASE question6 WHEN 1 THEN 'Very Negative'
                                WHEN 2 THEN 'Negative'
                                WHEN 3 THEN 'Neutral'
                                WHEN 4 THEN 'Positive'
                                WHEN 5 THEN 'Very Positive'
                                ELSE ''
                 END As answer6,
                 title, comments
            FROM pds_votes WHERE list_id =".$rating_listid;
	$result = mysql_query($sql);
	//echo "sql=$sql";

	$stats  = '<center> <table id="job-posts" class="job_detail_view" style="width:700px;border-top:1px ridge #F4F8FE; border-bottom: 1px groove #cccccc;border-left:1px ridge #F4F8FE; border-right: 1px groove #cccccc;" cellspacing="0">
	';
	$stats .= $Q_stats;
    /*
    <tr class="alt">
		<th style="width:150px;font-size:13px; height:30px;text-align:left;">&nbsp;&nbsp;Title</th>
		<th style="width:90px;font-size:13px; height:30px;text-align:left;">&nbsp;&nbsp;Date</th>

	</tr>
    */
    $rowno=0;
    $rating_arr = array();
	while ($row = mysql_fetch_assoc($result))
    {

        //$rating=isset($row['rating']) ? $row['rating'] : 0;

		$stats .= '<tr class="Odd" >
		<td style="font-size: 14px; font-weight: bold; width:325px;>' .$row['title'].'</td>
		<td class="column1" style="font-size: 14px; font-weight: bold; width:175px; color: #333333;"><I>' . Date('Y-m-d',strtotime($row['created_on'])) . '</I></td>
        </tr>

        <tr >
        <td colspan="2" class="left_td" style="width:700px;line-height:21px;">
           <b> '.((strlen($row['comments'])>150) ? (substr(htmlentities($row['comments'], ENT_QUOTES),0,150)."..") : htmlentities($row['comments'], ENT_QUOTES)).'</b> <br>
                  <a href="#" onclick="$(\'#message'.$rowno.'\').toggle(); return false;" alt="message" title="message">View Full Message</a>
                <div id="message'.$rowno.'" style="margin-bottom:8px;display:none;border:2px solid  #e5eff8; font-size: 12px; color:#17a;" >
                1. How would you rate the performance of the Business/contractor?<br>Ansewer:-&nbsp;<b>'.$row['answer1'].'</b>
                <hr>
                2. How was the quality of service/product?<br>Ansewer:-&nbsp;<b>'.$row['answer2'].'</b><hr>
                3.Was the work delivered in a timely fashion?<br>Ansewer:-&nbsp;<b>'.$row['answer3'].'</b><hr>

                4. How would you rate their business and technical knowledge?<br>Ansewer:-&nbsp;<b>'.$row['answer4'].'</b>
                <hr>
                5. How was after sale customer service?<br>Ansewer:-&nbsp;<b>'.$row['answer5'].'</b><hr>
                6. Would you recommend them to your friends and other connections?<br>Ansewer:-&nbsp;<b>'.$row['answer6'].'</b><hr>

                <hr>

                   &bull;Commnents:
                  <b>'.$row['comments'].'</b>
                </div>

        </td>
      </tr>
        ';
        $rating_arr[$rowno]['vote_id'] = $row['vote_id'];
        $rating_arr[$rowno]['title'] = $row['title'];
        $rating_arr[$rowno]['comments'] = $row['comments'];
        $rating_arr[$rowno]['date'] = $row['created_on'];
        $answer_array = array();
        for($i=0; $i < 6 ; $i++ ){
             $j = $i + 1;
             $answer_array[$i] = $row["answer$j"];
        }
        $rating_arr[$rowno]['answer'] = $answer_array;
     unset ($i);
     unset ($j);

	    $rowno=$rowno +1;
    }
    $stats .='
    <tr>
    <td colspan="2" class="bottom_line"></td>
    </tr></table></center>';
    

    $tpl->assign ('stats_rating', $rating_arr);
    $tpl->assign ('stats_questions', $Q_arr);


?>
