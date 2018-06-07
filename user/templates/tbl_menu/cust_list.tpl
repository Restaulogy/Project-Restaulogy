{include file='header.tpl'}


<div class="wrapper">
{*include file='menu_nav_bar.tpl'*}
<h1>{$_lang.tbl_menu.listing_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<div class="clearfix" id="dashboard" >
<center>
<table>
<tr>
{foreach from=$tbl_menulist item=tbl_menuitem name=mnulst}  
	 <td style="width:50%;text-align:center;padding: 5px;">
			 <div class="boxgrid captionfull" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_VIEW}&menu_id={$tbl_menuitem.menu_id}&is_preview=1'"> 
			 {if $tbl_menuitem.menu_image neq ''}
			     <img src="{$website}/uploads/menu/{$tbl_menuitem.menu_image}"/>
             {else}
                 <img width="50" height="50" src="{$website}/images/no_dish.png" />
             {/if}
			 </div>
			 <div style="font-style: Arial;font-size:18px;padding:5px;">
				 {$tbl_menuitem.menu_name}
			 </div>
		 </td>
 {if ($smarty.foreach.mnulst.iteration % 2 eq 0) && ($smarty.foreach.mnulst.iteration neq 0)}
 </tr><tr>{/if}
{/foreach}
	</tr>
</table>
</center>
</div>

</div>

<style type="text/css">
.boxgrid{
	width: 140px;
	height: 140px;
	margin:5px;
	float:left;
	background:#161613;
	/*border: solid 2px #96BF48;*/
	overflow: hidden;
	position: relative;
 cursor:pointer;

}
.boxgrid img{
	position: absolute;
	top: 0;
	left: 0;
	border: 0;
	width: 140px;
	height: 140px;

}
.boxcaption{
    float: left;
    position: absolute;
    background: #96BF48;
    color:#fff;
    height: 60px;
    width: 140px;
    opacity: .9;
    /* For IE 5-7 */
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
    /* For IE 8 */
    -MS-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
     }
.captionfull .boxcaption {
 	top: 140px;
 	left: 0;
 }
 .caption .boxcaption {
 	top: 100;
 	left: 0;
 }
</style>

 
{include file="footercontent.tpl"}
{literal}
<script type="text/javascript">
 $(function(){

    //Full Caption Sliding (Hidden to Visible)
    $('.boxgrid.captionfull').hover(function(){
        $(".cover", this).stop().animate({top:'0px'},{queue:false,duration:160});
    }, function() {
        $(".cover", this).stop().animate({top:'160px'},{queue:false,duration:160});
    });
});
</script>
{/literal}
</body></html>
