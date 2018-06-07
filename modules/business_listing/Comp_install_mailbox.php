<?PHP
/*
Mailbox Module
for phdDirectorySource 1.1

Copyright (c) 2008, Wagon Trader (an Oregon USA business)
All rights reserved.

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

$code_lang = 'en'; //Default language set

// Configuration module
include ("configs/config.php");

// Database Connection Module
include ("modules/connect.php");

// Functions
include("classes/functions.php");

if ($pds_mailbox != "" AND $pds_amailbox != ""){
	// Table defined in config file... proceed to create table
	mysql_query("DROP TABLE IF EXISTS $pds_mailbox;");
	mysql_query("CREATE TABLE $pds_mailbox (
	  `id` int(11) NOT NULL auto_increment,
	  `member_id` int(11) NOT NULL default '0',
	  `listing_id` int(11) NOT NULL default '0',
	  `surfer_id` int(11) NOT NULL default '0',
	  `surfer_from` varchar(32) default NULL,
	  `email` varchar(120) default NULL,
	  `subject` varchar(120) default NULL,
	  `body` text,
	  `date_sent` date default NULL,
	  `spam` int(1) NOT NULL default '0',
	  `msg_read` int(1) NOT NULL default '0',
	  `remove` int(1) NOT NULL default '0',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM;") or die("Error creating table $pds_mailbox... ".mysql_error());

	echo "Mailbox table created<br><br>";

	mysql_query("DROP TABLE IF EXISTS $pds_amailbox;");
	mysql_query("CREATE TABLE $pds_amailbox (
	  `id` int(11) NOT NULL auto_increment,
	  `member_id` int(11) NOT NULL default '0',
	  `listing_id` int(11) NOT NULL default '0',
	  `surfer_id` int(11) NOT NULL default '0',
	  `surfer_from` varchar(32) default NULL,
	  `email` varchar(120) default NULL,
	  `subject` varchar(120) default NULL,
	  `body` text,
	  `date_sent` date default NULL,
	  `mid` int(11) NOT NULL default '0',
	  `spam` int(1) NOT NULL default '0',
	  `msg_read` int(1) NOT NULL default '0',
	  `remove` int(1) NOT NULL default '0',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM;") or die("Error creating table $pds_amailbox... ".mysql_error());

	echo "Admin Mailbox table created<br><br>";
	
	// Updating Language File
	mysql_query("DELETE FROM $pds_lang WHERE  code_code='mailbox';");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('code_set', '$code_lang', 'mailbox', 'Mailbox Text');");

	mysql_query("DELETE FROM $pds_lang WHERE  code_set='mailbox';");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'action', 'Action');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'adminlink', 'Mailbox');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'breadcrumb', 'Mailbox');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'close_window', 'Close Window');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'date', 'Date');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'date_asc', 'Newest First');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'date_desc', 'Oldest First');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'for', 'for');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'from', 'From');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'from_listing', 'Message sent from listing');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'key', 'Key');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'mailbox', 'Mailbox');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'mailbox_log', 'Mailbox Log');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'name_asc', 'Name ascending');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'name_desc', 'Name descending');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'notice_sent', 'Abuse notice reported to admin');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'not found', 'Message not found');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'no_mail', 'No Mail');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'print', 'Printer friendly version');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'print_message', 'Print Message');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'read', 'Read');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'remove_message', 'Remove message');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'reported', 'Reported');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'report_abuse', 'Report message as abuse');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'subject', 'Subject');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'subject_asc', 'Subject ascending');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'subject_desc', 'Subject descending');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'title_tag ', 'Mailbox');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'unread', 'Unread');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'userlink', 'Mailbox');");
	mysql_query("INSERT INTO $pds_lang (code_set, code_lang, code_code, code_desc) VALUES('mailbox', '$code_lang', 'view_message', 'View message');");

	echo "Language file updated<br><br>";
	
	//Logging Module
	logMod('Mailbox Module','1.1');
	
	echo "Installation Complete";
	
}else{
	echo "Mailbox Databases not defined in the config file... unable to continue!!";
}
?>