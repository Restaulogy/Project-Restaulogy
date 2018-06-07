

    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
    <title>jQuery treeview</title>

    <link rel="stylesheet" href="jquery.treeview.css" />
    <link rel="stylesheet" href="screen.css" />

    <script src="jquery.js" type="text/javascript"></script>
    <script src="jquery.cookie.js" type="text/javascript"></script>

    <script src="jquery.treeview.js" type="text/javascript"></script>

    <script type="text/javascript" src="demo.js"></script>
    <script type="text/javascript">
    function showlisting(treeviewid)
    {
        //var str = document.myform.fund.value;
        //var pct = document.myform.pct.value;
      if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    var url="getPa.php";
    url+="?id=" + treeviewid;
    url+="&loc=3";//url+="?id=2"+str;
    xmlhttp.open("GET",url,false);
    xmlhttp.send(null);
//    document.write(xmlhttp.responseText);

    document.getElementById('txtHint').innerHTML=xmlhttp.responseText;
    // first example
    //$("#browser").treeview();

  }


    </script>


    <?php
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//if($_GET['q']=='a'){
  ?>

    <ul id="browser" class="filetree treeview">
  <?      foreach ($vs_cat as $key => $list)
    {
		echo "<li><span class=\"folder\">".$list['title']."</span>";


		$r = mysql_query ("SELECT * FROM  $pds_category WHERE p =".$list['id']." ORDER BY title ");
		$count = mysql_num_rows($r);

for ($x=0;$x<$count;$x++)
	{
		$f = mysql_fetch_array($r);
		$sub_cat[$x]['id'] = $f['id'];
		$sub_cat[$x]['title'] = $language->desc('category',$lang_set,$f['id']);
		if ($f[f_mt] != "" OR !$config['disable_empty_cat'])
		{
		  if($config['rewrite'])
		  	{
		     $mod_id = $sub_cat[$x]['id'];
		     $mod_title = str_replace(' ','_',getCatPath($f['id']));
		     $mod_title = str_replace('/','-',$mod_title);
		     $sub_cat[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$sub_cat[$x]['title']."</a>";

	  		}
 	 	else
		  	{
         	$sub_cat[$x]['href'] = "<a href=\"#\" onclick=\"showlisting(".$sub_cat[$x]['id'].")\">".$sub_cat[$x]['title']."</a>";
			}

 		}
 	else
	 	{
      		$sub_cat[$x]['href'] = $sub_cat[$x]['title'];
   		}
   		if($x==0)
          {
		   echo "<ul><li><span class=\"file\">".$sub_cat[$x]['href']."</span></li>";
	 	  }
		elseif($x==$count)
	 	  {echo "<li><span class=\"file\">".$sub_cat[$x]['href']."</span></li></ul>";
	 	}
		else
		{
            echo "<li><span class=\"file\">".$sub_cat[$x]['href']."</span></li>";
         }

	}
	    echo "</li>";
	}
	?>
	</ul>

    </td></tr></table>
    </form>
    <br>
    <div id="txtHint">Info is here</div>

</div>







