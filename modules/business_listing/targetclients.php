<?PHP
/*
Copyright (c) 2005-2008, Wagon Trader (an Oregon USA business)
All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice,
this list of conditions and the following disclaimer.

Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

All pages generated from the use of phpDirectorySource must contain the statement
"Powered by: phpDirectorySource" with an active link to http://www.phpdirectorysource.com,
unless a waiver is granted by the copyright holder.

Neither the name of Wagon Trader nor the names of its contributors may be used to endorse
or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER
IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT
OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************
$bread_crumb[0] = "Search Target Clients";
//***********************************************
// Listings
//***********************************************
include("categories.php");
include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php";

global $CONFIG,$SESSION;

$tpl-> assign('operation' , '');
$tpl-> assign('notice' , '');
if ($vs_current_user[id] != "" ){
    //..get posted category
    if (isset($_POST['category']) && ($_POST['category']>0))
    {
       $category = $_POST['category'];
    }
    //..get posted city
    if (isset($_POST['city']) && ($_POST['city']!=""))
    {
       $city = $_POST['city'];
    }
    if (isset($_POST['timeframe']))
    {
       $timeframe = $_POST['timeframe'];
    }
    if (isset($_POST['pricing']))
    {
       $pricing = $_POST['pricing'];
    }
    //..now fetch the records based on the filter criteria
    $tgtClints=array();
    
/*************************************************************************************
For Searching The Clients starts here
************************************************************************************/
    if (isset($_POST['search']))
    {
      //..make sure you are not including the same logged in user
      //$sql="Select userid from pds_wish_list where FIND_IN_SET('$category',category) and userid!=".$vs_current_user[id];
      $sql="Select * from pds_wish_list where category=$category and timeframe like '$timeframe%' and pricing like '$pricing%' and userid!=".$vs_current_user[id];
      $result = mysql_query($sql);

        $cnt=0;
  		if ($result)
  		{
            while ($row = mysql_fetch_assoc($result)) {
              //..Now get the location of the that user using elgg functions
              $receiver=get_user($row["userid"]);

              if ($city){
                if ($receiver->location){
                    $pos = strpos($receiver->location, $city);
                    if ($pos === false){}
                    else {
                      $tgtClints[$cnt]["userid"]=$row["userid"];
                      $tgtClints[$cnt]["location"]=$receiver->location;
                      $tgtClints[$cnt]["email"]=$receiver->email;
                      $tgtClints[$cnt]["state"]=$receiver->user_state;
                      $tgtClints[$cnt]["zip"]=$receiver->user_zip;
                      $tgtClints[$cnt]["timeframe"]=$row["timeframe"];
                      $tgtClints[$cnt]["pricing"]=$row["pricing"];
                      $cnt=$cnt+1;
                      continue;
                    }
                }
              }else{
                  $tgtClints[$cnt]["userid"]=$row["userid"];
                  $tgtClints[$cnt]["location"]=$receiver->location;
                  $tgtClints[$cnt]["email"]=$receiver->email;
                  $tgtClints[$cnt]["state"]=$receiver->user_state;
                  $tgtClints[$cnt]["zip"]=$receiver->user_zip;
                  $tgtClints[$cnt]["timeframe"]=$row["timeframe"];
                  $tgtClints[$cnt]["pricing"]=$row["pricing"];
                  $cnt=$cnt+1;
                  continue;
              }
            }
  		}
  		if ($cnt==0) $tpl-> assign('notice','No matching records found');
        $tpl-> assign('user_list',$tgtClints);
        $tpl-> assign('total_users',$cnt);

        $sel_user = get_user($vs_current_user[id]);
        $tpl-> assign('organizer_name',$sel_user->name);
        $tpl-> assign('organizer_mail',$sel_user->email);

  	}
/*************************************************************************************
For Searching The Clients ends here
************************************************************************************/
    if (isset($_POST['send_mail']))
    {
        // print_r($_POST);
         $mail_err = "";
         
        //checking for mailers
         if ((isset($_POST['selected_clients'])) && ((strlen(trim($_POST['selected_clients'])))!=0))
         {
            $mail_clients  = explode(",",$_POST['selected_clients']);
         }
         else
         {
            $mail_err .= '<div class="fail">No Client is Selected</div>';
         }
         //checking for subject
         if ((isset($_POST['subject'])) && ((strlen(trim($_POST['subject'])))!=0))
         {
            $mail_subject  =  $_POST['subject'];
         }
         else
         {
            $mail_err .= '<div class="fail">No Subject is given</div>';
         }
         //checking for msg
         if ((isset($_POST['message'])) && ((strlen(trim($_POST['message'])))!=0))
         {
            $mail_message  =  $_POST['message'];
         }
         else
         {
            $mail_err .= '<div class="fail">No Message is given</div>';
         }
         //checking for attachment
         if (isset($_FILES['attachment']['tmp_name']))
         {
            $attached_file = $_FILES['attachment']['tmp_name'];
            
             if ($_FILES["attachment"]["error"] > 0)
                {
                 echo "Return Code: " . $_FILES["attachment"]["error"] . "<br />";
                }
            else
                {
                   $path_info = pathinfo($_FILES["attachment"]["name"]);

                     $file_parts = explode(".".$path_info['extension'], $_FILES["attachment"]["name"]);
            	    $filename = $file_parts[0]."_".time().".".$path_info['extension'];

                    move_uploaded_file($_FILES["attachment"]["tmp_name"],$config[root]."mail_attachments/" .$filename);
                    $attached_file  = $config[root]."mail_attachments/" .$filename ;
                    unlink($_FILES["attachment"]["tmp_name"]);
                }
            
            
         }else{
            $attached_file="";
         }
         
         if ((strlen(trim($mail_err)))!=0)
         {
              $tpl-> assign('mail_err' ,$mail_err);
         }
         else
         {
            $mail_fail = '';
            $mail_success = '';
            foreach ($mail_clients as $client)
    		{
    			if((strlen(trim($client)))!=0)
                {
                    $receiver=get_user($client);
                    $reply = get_input('reply',0);

                    //checking Mailling section
    				$res = send_mail($receiver->name,$receiver->email,$mail_subject,$mail_message, $vs_current_user[id],$attached_file);
                    //echo $res;
                    //checking Messageing section
                   $msg_result = messages_send($mail_subject,$mail_message,$client,0,$reply);
                if($msg_result)
                   {
                    if($res==1)
                    {
                        $mail_success.= $receiver->location.' ,';
                    }
                    else
                    {
                        $mail_fail.= $receiver->location.' ,';
                    }
                  }
                  else
                  {
                    $mail_fail.= $receiver->location.' ,';
                  }
                   // checking for mail success messaging


    			}
       		}
       		
       		 if((strlen(trim($mail_success)))!=0)
                   {
                     $mail_success = substr($mail_success, 0, strlen(trim($mail_success))-1);
                     $mail_success = '<div class="approved">Mail To '.$mail_success.'  Delivered successfully</div>';
                     $tpl-> assign('mail_success' , $mail_success);
                   }
                    // checking for mail fail messaging
                    if((strlen(trim($mail_fail)))!=0)
                   {
                     $mail_fail = substr($mail_fail, 0, strlen(trim($mail_fail))-1);
                    $mail_fail = '<div class="fail">Problem During Delivery To '.$mail_fail.'</div>';
                     $tpl-> assign('mail_fail' , $mail_fail);
                   }

         }

    }
/*************************************************************************************
For sending mail to Clients starts here
************************************************************************************/

/*************************************************************************************
For sending mail to Clients starts here
************************************************************************************/
}

$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('show_page','user');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/targetclients.tpl");
?>
