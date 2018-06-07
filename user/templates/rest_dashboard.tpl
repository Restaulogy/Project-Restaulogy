{include file='header.tpl'}
{literal}
<style type="text/css">
	 .viewport {
            /*border: 3px solid #eee; */
            overflow: hidden;
            position: relative !important;
        }
    .dash_lbl {
            margin-top:-12px !important;
            color:white !important;/* #84A63F */
            font-size: 1.1em !important;
            font-weight: bold !important;
            font-family: Arial !important;
    }
	.dark {
			color:#fff;
			vertical-align: middle !important;
            font-size: 1.0em;
            font-weight: bold;
            height: 100% !important;
            position	: absolute;
						text-align: center;
            text-decoration: none;
            width:50%;
            z-index: -100;
			display: block; /*
			border:3px solid #ccc;*/
        }

        img:hover
        {
        opacity:0.4!important;
        filter:alpha(opacity=40)!important;  /* For IE8 and earlier */
        }
        img
        {
        opacity:1.0!important;
        filter:alpha(opacity=100)!important;  /* For IE8 and earlier */
        }

</style>
{/literal}

<div class="wrapper">
 <h1>{$_lang.main.rest_dashboard}</h1>
<div class="clearfix" id="dashboard"><center>
<table style="width:100%;">
    <tr>

         <td style="width:50%;position:relative;" class="viewport">
		 		<div class="dark">{$_lang.tbl_qrcode_log.title}</div>
				<a href="{$website}/user/tbl_qrcode_log.php" style="width:100%;text-align:center !important;">

    				<img src="{$website}/images/dashboard/social_media.png" alt="{$_lang.tbl_qrcode_log.title}" style="width:50%"/>
					<span class='dash_lbl'>{$_lang.tbl_qrcode_log.title}</span>
    			</a>
         </td>

         <td style="width:50%;position: relative;margin-bottom:20px;" class="viewport">
		 		<div class="dark">{$_lang.biz_rewards.rwd_points_lst}</div>
                <a href="{$website}/user/rewrad_point_list.php" style="width:100%;text-align:center !important;">
    				<img src="{$website}/images/dashboard/feedback.png" alt="{$_lang.biz_rewards.rwd_points_lst}" style="width:50%"/>
    				<span class='dash_lbl'>{$_lang.biz_rewards.rwd_points_lst}</span>
    			</a>
         </td>
    </tr>

</table>

</center>
</div>
<!--/#dashboard-->

</div> <!--/#wrapper-->
{include file='footercontent.tpl'}

</body></html>
