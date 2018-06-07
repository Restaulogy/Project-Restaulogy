<?php

$start_date_for_pdf = date("l, jS F,Y h:i A",strtotime($start_date));
$end_date_for_pdf = date("l, jS F,Y h:i A",strtotime($end_date));
$metro_area_for_pdf = getMetroArea_name($metro_area);
$states_for_pdf =getState_name($states);
$strContent='
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Email Template - Head In The Clouds</title>
        <!--general stylesheet-->
        <style type="text/css">
            p {
                padding: 0;
                margin: 0;
            }

            h1, h2, h3, p, li {
                font-family: Georgia, Helvetica, sans-serif, Arial;
            }

            td {
                vertical-align: top;
            }

            ul, ol {
                margin: 0;
                padding: 0;
            }
            
            #image_holder{
                float:left !important;
                width:120px !important;
				text-align: center;
				display:inline !important;
			}
        </style>
		<!--[if gte mso 9]>
		<style type="text/css">
		.transparent{ background-color: #dfe4e9; background-image: url(\'http://newsletters.urldock.com/hitc-cm4/images/article-bg.jpg\'); }
		</style>
		<![endif]-->
    </head>
    <body class="body" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="#cad3db" style="margin: 0px; background-color: #cad3db; background-image: url(\'images/body-bg.jpg\'); background-repeat: repeat; background-position: center top;">
    <br><br>
        <table cellspacing="0" border="0" cellpadding="0" width="100%" align="center" style="margin: 0px;">
            <tbody>
                <tr valign="top">
                    <td class="ifcase" valign="top" background="images/body-bg.jpg" style="background-image: url(\'images/body-bg.jpg\'); background-repeat: repeat; background-position: center top;">
                        <!--container-->
						<table cellspacing="0" cellpadding="0" border="0" width="700" align="center" background="images/bottom-cloud-transparent.png" style="background-image: url(\'images/bottom-cloud-transparent.png\'); background-repeat: no-repeat; background-position: right bottom; ">
							<tbody>
								<tr>
									<td valign="top" style="padding-bottom:30px; font-family: Georgia, Helvetica, sans-serif, Arial; ">
										<table cellspacing="0" cellpadding="0" border="0" align="center" width="600">
							                <tbody>
							                    <tr>
							                        <td valign="top">
							                            <table cellspacing="0" cellpadding="0" border="0" align="center" background="images/clouds-bg.jpg" style="background-image: url(\'images/clouds-bg.jpg\'); background-repeat: no-repeat; background-position: center top; ">
							                                <tbody>

							                                    <tr>
							                                        <td colspan="2" valign="baseline" style="vertical-align:baseline; text-align: left;">
																		<h1 style="margin:0; padding:0; font-family: Gill Sans, Trebuchet MS, Helvetica, Arial, sans-serif; font-size: 34px; color:#ffffff; font-weight: normal; letter-spacing:2px;">CupObiz.Com</h1> &nbsp;<br>



		                                        </td>

							                                    </tr>

							                                </tbody>
							                            </table>
							                        </td>
							                    </tr>
							                    <tr>
							                        <td valign="top" colspan="2">
                                   <table cellspacing="0" border="0" cellpadding="0" align="center" width="600" style="margin: 0px; padding-bottom:20px;">
							                                <tbody>

							                                    <tr>
							                                        <td valign="top">
							                                            <table class="transparent" cellspacing="0" border="0" cellpadding="0" align="center" width="600" style="border:10px; border-style:solid; border-color:#f3f5f7;">
							                                                <tbody>
							                                                    <tr>
							                                                        <td valign="top" background="images/article-bg-transparent.png" style="padding-top:20px; background-image: url(\'images/article-bg-transparent.png\'); background-position: center bottom; background-repeat: repeat;">
							                                                            <table cellspacing="0" border="0" cellpadding="0" align="center" width="580" style="">
							                                                            	<tbody>
							                                                            		<tr>
							                                                            			<td valign="top" height="24" bgcolor="#cbd3db" style="background-color: #cbd3db; background-image: url(\'images/article-title-bg.jpg\'); background-repeat: repeat; background-position: center center;">
							                                                            				<h2 style="margin: 0; padding-left:20px; padding-top:3px; padding-bottom:3px; font-size: 24px; color: #626b73; font-weight: normal; font-family:Georgia;">
Arizona Centennial Best Fest - Prescott																										</h2>
							                                                            			</td>
							                                                            		</tr>
							                                                            	</tbody>
							                                                            </table>
							                                                            <table cellspacing="0" border="0" cellpadding="0" align="center" width="540" style="padding-top:20px; font-family: Georgia, Helvetica, sans-serif, Arial;">
							                                                                <tbody>
							                                                                    <tr>
							                                                                        <td valign="top">
							                                                                           <div align="center" id="image_holder"><img width="321" height="170" src="images/giraffe.jpg" alt="This is an image witha a giraffe." style="border: 10px; border-color: #c2cad2; border-style: solid; margin-right:20px; margin-bottom:5px;" /></div>
							                                                                            <p style="padding-bottom:20px; color: #798692; font-size:14px; line-height:20px;">
							                                                                                Turn Your Windows Laptop Into A Secure Wi-Fi Hotspot To Share The Internet With Friends, Co-Workers, And Mobile Devices. Turn Your Windows Laptop Into A Secure Wi-Fi Hotspot To Share The Internet With Friends, Co-Workers, And Mobile Devices...<a href="#">View More</a>
							                                                                            </p>
<table cellspacing="0" border="0" cellpadding="0" align="left" width="540" style="color: #798692; font-size:14px; font-family: Georgia;">
								                                                                                            <tbody>
								                                                                                                <tr>
								                                                                                                    <td valign="top" width="12" height="12" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">
								                                                                                                        <img width="5" height="5" src="images/bullet-1.jpg" alt="" style="padding-top: 2px; padding-bottom: 2px;"/>
								                                                                                                    </td>
								                                                                                                    <td valign="top" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">
																																		<b>Date :</b> 01/27/12 10:59 AM - 02/29/12 10:59 AM
								                                                                                                    </td>
								                                                                                                </tr>
								                                                                                                <tr>
								                                                                                                    <td valign="top" width="12" height="12" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">
								                                                                                                        <img width="5" height="5" src="images/bullet-1.jpg" alt="" style="padding-top: 2px; padding-bottom: 2px;"/>
								                                                                                                    </td>
								                                                                                                    <td valign="top" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">
								                                                                                                        <b>Location :</b> Phoenix-Arizona
								                                                                                                    </td>
								                                                                                                </tr>
								                                                                                                <tr>
								                                                                                                    <td valign="top" width="12" height="12" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">
								                                                                                                        <img width="5" height="5" src="images/bullet-1.jpg" alt="" style="padding-top: 2px; padding-bottom: 2px;"/>
								                                                                                                    </td>
								                                                                                                    <td valign="top" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">

 <b>Business :</b>	<a href="#">Hampton Inn Phoenix Airport North</a>
		 						                                                                                                    </td>
								                                                                                                </tr>
								                                                                                                <tr>
								                                                                                                    <td valign="top" width="12" height="12" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">
								                                                                                                        <img width="5" height="5" src="images/bullet-1.jpg" alt="" style="padding-top: 2px; padding-bottom: 2px;"/>
								                                                                                                    </td>
								                                                                                                    <td valign="top" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;">
								                                                                                                        <b>Address :</b> 123 Some Street, City, ST 99999. Ph +1 4 1477 89 745
								                                                                                                    </td>

<td valign="top" width="12" height="12" style="padding-top: 2px; padding-bottom: 2px; vertical-align:top;" colspan="2">&nbsp;&nbsp;<br/>&nbsp;&nbsp;</td>						                                                                                            </tbody>
								                                                                                        </table>
																																	                                                                        </td>
							                                                                    </tr>
							                                                                </tbody>
							                                                            </table>
 						                                                        </td>
							                                                    </tr>
							                                                </tbody>
							                                            </table>
							                                        </td>
							                                    </tr>
							                                </tbody>
							                            </table>
							                        </td>
							                    </tr>
												<tr>
													<td colspan="2" valign="top" style=" padding: 10px 0 20px;" class="footer">
														<p style="font-family: Georgia; margin:0; padding-bottom: 3px; padding-top: 3px; color:#6e7c88; font-size: 12px;">copyright &copy; 2010-2013 CupOBiz</p>
													</td>
												</tr>
							                    <tr>
							                        <td colspan="2" valign="top" style=" padding-bottom: 20px;">
							                            <img width="600" height="7" src="images/divider.png" alt="" style="display:block;"/>
							                        </td>
							                    </tr>
							                </tbody>
							            </table>
									</td>
								</tr>
							</tbody>
						</table>
                        <!--/container-->
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>';

   /*
    require_once('html2fpdf/html2fpdf.php');
    $newpdf=new HTML2FPDF();
    $newpdf->HTML2FPDF("P","mm","A4");
    $newpdf->AddPage();
    @$newpdf->WriteHTML($strContent);
    @$newpdf->Output("pdf/".$pdf,"F");
    */
    include_once("../MPDF53/mpdf.php");
    $mpdf=new mPDF();
    $mpdf->WriteHTML($strContent);
    $mpdf->Output("pdf/".$pdf,"F");
  //.End...
 ?>
