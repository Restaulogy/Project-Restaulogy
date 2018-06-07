<?php

/* $db_host = "localhost";
$db_user = "root";
$db_pass = "1nf0resha";
$db_name = "elgg";

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ("Unable to connect to DB"); 
mysql_select_db($db_name, $connection);*/
$query = "SELECT * FROM pds_category ORDER BY id";
$result = mysql_query($query);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<head>
	<title>Destroydrop &raquo; Javascripts &raquo; Tree</title>
 <link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="NEW_dtreecheckbox.js"></script>
</head>

<body>


<div class="new_dTree">
<form>
<p><a href="javascript: d.openAll();">open all</a> | <a href="javascript: d.closeAll();">close all</a></p>

<script type="text/javascript">
<!--
d = new new_dTree('d');
d.add(0,-1,'Categories','','');
<?php
while ($row = mysql_fetch_array($result)) {
// Node(id, pid, name, url, title, target, isopen, img)
?>
d.add(<?echo $row[id];?>,<?echo $row[p];?>,'<?echo $row[title];?>','','<input type="checkbox" name="nodes" value="<?echo $row[id];?>"');
<?
}
?>
document.write(d);
//show selected node
//d.openTo(138, true);
//-->
</script>
<INPUT TYPE="BUTTON" onClick="cycleCheckboxes(this.form)" VALUE="OK">
</form>
<script type='text/javascript'>
<!--
function cycleCheckboxes(what) {
    var op="";
    for (var i = 0; i<what.elements.length; i++) {
        if ((what.elements[i].name.indexOf('nodes') > -1)) {
            if (what.elements[i].checked) {
                //window.opener.document.form1.valor.value += what.elements[i].value + ',';
                op += what.elements[i].value + ',';
            }
        }
    }
    alert('output='+op);
}
//-->
</script>
</div>

</body>

</html>
<?php
mysql_free_result($result);
/* End Code */
?>
