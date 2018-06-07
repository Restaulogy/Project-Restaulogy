    <?PHP
    $r = mysql_query("SELECT * FROM $pds_list WHERE state='apr' and level='2' ORDER BY RAND() LIMIT 0,4;");
    for($x=0;$x<mysql_num_rows($r);$x++){
       $vs_featured[$x]=mysql_fetch_assoc($r);
    }
    $tpl-> assign('vs_featured',$vs_featured);
    mysql_free_result($r);
    ?>
