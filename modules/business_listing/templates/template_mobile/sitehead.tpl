{********** Index Template phpDirectorySource **********************}
{***** Get Template Config Variables ******************************}
{config_load file="$deftpl/system.conf" section='index'}
{***** Display Document Header Containg Scripts/Stylesheets *****}
{include file="$deftpl/header.tpl"}
{******** Site Logo *********}
{****** Breadcrumb *************************}
    <h3>Business Listing</h3>
     <form action="search.php" method="post" data-ajax="false">
     <table style="font-size:10px;overflow:hidden;">
        <tr>
            <td>Keywords</td>
            <td><input   type="text" style="width:120px;height:21px;font-size:10px;" id="search_keywords" name="sk" value="{$search_key}" ></td>
            <td><button name="sp" type="submit" data-theme="a">Go</button></td>
        </tr>
     </table>
     </form>
	<br/>