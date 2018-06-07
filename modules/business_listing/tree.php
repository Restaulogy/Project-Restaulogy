<?php
/*
$db_host = "localhost";
$db_user = "root";
$db_pass = "1nf0resha";
$db_name = "elgg";

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ("Unable to connect to DB");
mysql_select_db($db_name, $connection);*/
$query = "SELECT * FROM pds_category ORDER BY id";
$result = mysql_query($query);

?>

<div class="dtree" style="text-align:left; width:180px; overflow-x:scroll;">
<p><a href="javascript: d.openAll();">open all</a> | <a href="javascript: d.closeAll();">close all</a></p>

<script type="text/javascript">
<!--
d = new dTree('d');
d.add(0,-1,'Categories');
<?php
while ($row = mysql_fetch_array($result)) {
// Node(id, pid, name, url, title, target, isopen, img)
?>
d.add(<?echo $row[id];?>,<?echo $row[p];?>,'<?echo $row[title];?>','index.php?cat=<?echo $row[id];?>');
<?php
}
?>
document.write(d);
//show selected node
//d.openTo(138, true);
//-->
</script>
</div>

<?php
mysql_free_result($result);
/* End Code */
?>
