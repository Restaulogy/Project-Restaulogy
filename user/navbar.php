<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="<?php echo $website; ?>"><img src="<?php echo $website; ?>/images/am_logo.png" /></a>
<?php if($sesslife == true){ ?>
		<div class="btn-group pull-left">
		<button class="btn btn-danger">
		<?php 
		 switch($Global_member['member_role_id']){
		 	case 3	 : echo "Patient";break;
		 	case 5	 : echo "Facility-Controller";break;
		 	case 6	 : echo "Staff";break;
		 	default  : echo "Provider";break;
		 }
		 ?>
		</button>
		<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right">
		<?php
			if ($Global_member['member_role_id'] == 3){ 
				echo "<li><a href='{$website}/".USER_DIRECTORY."/patient_facility'>Manage Facilities</a></li>";
				echo "<li><a href='{$website}/".USER_DIRECTORY."/patient_drugs'>Manage Drugs</a></li>"; 
				echo "<li><a href='{$website}/".USER_DIRECTORY."/patient_allergy'>Manage Allergies</a></li>";
			}elseif ($Global_member['member_role_id'] == 5){
				echo "<li><a href='{$website}/".USER_DIRECTORY."/facility'>Manage Facilities</a></li>";
				echo "<li><a href='{$website}/".USER_DIRECTORY."/facility_staff'>Manage Staff</a></li>";
				echo "<li><a href='{$website}/".USER_DIRECTORY."/patient_search'>Manage Patients</a></li>";
			}else{ 
				echo "<li><a href='{$website}/".USER_DIRECTORY."/patient_search'>Manage Patients</a></li>";
				echo "<li><a href='{$website}/".USER_DIRECTORY."/md_facility'>Manage Facilities</a></li>"; 
				if($Global_member['member_role_id']==1){ 
				echo "<li><a href='{$website}/".USER_DIRECTORY."/provider_admin'>Manage Provider</a></li>"; 
				}   
			}  
			?> 
		</ul>
		</div>
		<div class="btn-group pull-left">
		<button class="btn btn-danger">Codes</button>
		<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right">
		<?php
				echo "<li><a href='{$website}/".USER_DIRECTORY."/drugs'>Drug Codes</a></li>";
				echo "<li><a href='{$website}/".USER_DIRECTORY."/allergy'>Allergies</a></li>"; 
			?>
		</ul>
		</div>
		 
<?php } if($is_admin == 1) { ?>
	<div class="btn-group pull-left">
		<button class="btn btn-danger"><?php echo _("Admin"); ?></button>
		<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><a href="<?php echo $website."/".ADMIN_DIRECTORY; ?>/statistics"><i class="icon-signal"></i> <?php echo _("Statistics"); ?></a></li>
			<li><a href="<?php echo $website."/".ADMIN_DIRECTORY; ?>/users"><i class="icon-user"></i> <?php echo _("Users"); ?></a></li>
			<li><a href="<?php echo $website."/".ADMIN_DIRECTORY; ?>/settings"><i class="icon-wrench"></i> <?php echo _("Settings"); ?></a></li>
			<li><a href="<?php echo $website."/".ADMIN_DIRECTORY; ?>/access"><i class="icon-list-alt"></i> <?php echo _("Access"); ?></a></li>
			<li><a href="<?php echo $website."/".ADMIN_DIRECTORY; ?>/sql-logs"><i class="icon-warning-sign"></i> <?php echo _("Logs"); ?></a></li>
		</ul>
	</div>
<?php } ?>
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
<?php if($sesslife == false) { ?>
					<li><a href="<?php echo $website."/".USER_DIRECTORY; ?>/login"><?php echo _("Login"); ?></a></li>
					<li><a href="<?php echo $website."/".USER_DIRECTORY; ?>/register"><?php echo _("Register"); ?></a></li>
<?php } else {
/*
displaying gravatar photo over here if email is associated with a gravatar account.
*/


extract($Global_member);
if($member_role_id == 3){
	$profile_img =  WWWROOT."/images/patient.png"; 
}else{
	$profile_img =  WWWROOT."/images/doctor.png"; 
}
?>
					<img src="<?php echo $profile_img;?>" class="profile-photo"> 
					<li><a href="<?php echo $website; ?>/profile/<?php echo $userid; ?>"><?php echo $first_name." ".$last_name; ?></a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo _("Account"); ?>&nbsp;<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $website."/".USER_DIRECTORY; ?>/account"><?php echo _("Info"); ?></a></li>
							<li><a href="<?php echo $website."/".USER_DIRECTORY; ?>/changepassword"><?php echo _("Change Password"); ?></a></li>
							<li><a href="<?php echo $website."/".USER_DIRECTORY; ?>/editprofile"><?php echo _("Edit Profile"); ?></a></li>
							<li class="divider"></li>
							<li>
						<?php if(!empty($_SESSION["code"])) { ?>
								<a href="https://www.facebook.com/logout.php?next=<?php echo urlencode($website."/".USER_DIRECTORY."/logout"); ?>&access_token=<?php echo $_SESSION["access_token"]; ?>"><?php echo _("Logout"); ?></a>
						<?php } else { ?>
							<a href="<?php echo $website."/".USER_DIRECTORY; ?>/logout"><?php echo _("Logout"); ?></a>
						<?php } ?>
							</li>
						</ul>
					</li>
					 
					
<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
