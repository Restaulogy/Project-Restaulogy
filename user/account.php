<?php
/*
	@! AuthManager v3.0
	@@ User authentication and management web application
-----------------------------------------------------------------------------	
	** author: StitchApps
	** website: http://www.stitchapps.com
	** email: support@stitchapps.com
	** phone support: +91 9871084893
-----------------------------------------------------------------------------
	@@package: am_authmanager3.0
*/
include("../init.php");
include("header.php");
subheader(_("My Profile")); 
if($sesslife == true) { 
?>
 <div class="row">
 	<div class="span6">  
<?
	$member = new members(); 
	$info = $member->GetInfo(0,$username);
	 
		if(!empty($info)) {
		extract($info);  
?>	 
			<table class="table table-striped table-bordered table-condensed"> 
			<tr><td class="first"><?php echo _("Name"); ?></td><td><?php echo $first_name." ".$last_name; ?></td></tr>
			<tr><td class="first"><?php echo _("Email"); ?></td><td><?php echo $email; ?></td></tr>
			<?php
			if ($member_role_id==3) {
			?>
			<tr><td class="first"><?php echo $_lang['dob']; ?></td><td><?php echo $DOB; ?></td></tr>
			<tr><td class="first"><?php echo $_lang['ss_no']; ?></td><td><?php echo $ss_no; ?></td></tr>
			<?php
			}else{
			 
			   if($member_role_id == 2 && is_gt_zero_num($parent)){?>
			   <tr><td class="first">Provider </td><td><?php echo $parent_name; ?></td></tr>	 
			<?php } ?>
			<tr><td class="first"><?php echo $_lang['license']; ?></td><td><?php echo $license; ?></td></tr>
			<tr><td class="first"><?php echo $_lang['license_expiry']; ?></td><td><?php echo $license_expiry; ?></td></tr>
			<tr class='doctor_row'>
			 	<td class="first"><label>Facilities: </label></td>
			     <td><?php echo $facilities;?></td>
		 	</tr>
			<?php
			}?>
			
			<tr><td class="first"><?php echo _("Password"); ?></td><td><a href="<?php echo $website."/".USER_DIRECTORY; ?>/changepassword"><strong><?php echo _("Click here to change your password"); ?></strong></a></td></tr>
			<tr><td class="first"><?php echo _("Key"); ?></td><td><?php echo $key; ?></td></tr>
			<tr><td class="first"><?php echo _("Joined"); ?></td><td><?php echo $join; ?></td></tr>
			<tr><td class="first"><?php echo _("Last Access"); ?></td><td><?php echo $access; ?></td></tr>
			</table> 
			<br />
<?php
		} else {
		?>
			echo "<div class=\"alert alert-error\"><strong>"._("Unable to retrieve.")."</strong><br/>"._("Oops! We are unable to retrieve your account information at the moment. Please try again later.")."</div>";
		<?php
		}?>
		
	</div> 
		
	<div class="span5 offset1"> 
		<?php
		echo "<h4>"._("Close Account")."</h4>";
		echo "<p>"._("If you wish to close your account permanently, then you can do so by clicking the button below.")."</p><br/>";
		echo "<a href=\"{$website}/".USER_DIRECTORY."/closeaccount\" class=\"btn btn-danger\">"._("Close your account")."</a>";
		?>
	 </div>  
 </div>
<?php
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0;url={$website}/".USER_DIRECTORY."/login\" />";
} 
?>
 
<?php
include("footer.php");
?>
