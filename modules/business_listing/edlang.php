<?PHP
/*
Original class BabelKit, Copyright (C) 2003 John Gorman jgorman@webbysoft.com
Available from http://www.webbysoft.com/babelkit under the LGPL license

Modified structure for compatibility with phpDirectorySource

Copyright (c) 2005-2006, Wagon Trader (an Oregon USA business)
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
include ("configs/vs_config.php");
include ("configs/vs_current_user.php");
include ("configs/vs_current_admin.php");

if ( !$vs_current_admin[login] ){
	//no admin logged in
	header("Location: $config[mainurl]/admin.php");
	exit;
}

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('edlang',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('edlang',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

//***********************************************
// Edit Language Localization
//***********************************************

$perm_add = 1;
$perm_upd = 1;
$perm_del = 1;

function bka_admin_main() {
    global $language;        # Set in bk_admin.php:
    global $perm_add;
    global $perm_del;

    global $action;     # Set here:
    global $code_set;
    global $code_lang;
    global $code_lang2;
    global $code_code;
    global $code_admin;
	global $html;

	if ( isset($_GET['code_set']) ){
	
		$action     = $_GET['action'];
		$code_set   = $_GET['code_set'];
		$code_lang  = $_GET['code_lang'];
		$code_lang2 = $_GET['code_lang2'];
		$code_code  = $_GET['code_code'];
	}else{
	
		$action     = $_POST['action'];
		$code_set   = $_POST['code_set'];
		$code_lang  = $_POST['code_lang'];
		$code_lang2 = $_POST['code_lang2'];
		$code_code  = $_POST['code_code'];
	}

    if (!$code_lang or $code_lang == $code_lang2)
        $code_lang2 = '';

    if (!$code_lang) $code_lang = $language->native;
    $code_admin = bka_admin_get($code_set);
    if ($code_admin['slave']) {
        $perm_add = 0;
        $perm_del = 0;
    }

    bka_admin_header();

    if ($action == 'New') {
        bka_form_display();
    } elseif ($action == '' && $code_code <> '') {
        bka_form_display($code_code);
    } elseif ($action <> '') {
        bka_form_aud();
    } elseif ($code_set <> '') {
        bka_set_display();
    } else {
        bka_translations();
    }
	return ($html);

}

#       #       #       #
#
# Print the page header
#
function bka_admin_header() {
    global $language;
    global $action;
    global $code_set;
    global $code_lang;
    global $code_lang2;
    global $code_code;
	global $html;

    $title = "Universal Language Code Translation";
    if ($code_set) $title .= " : $code_set";
    if ($action == 'New') {
        $title .= " : New";
    } elseif ($code_code <> '') {
        $title .= " : $code_code";
    } elseif ($code_set) {
        if ($code_lang) $title .= " : $code_lang";
        if ($code_lang2) $title .= "/$code_lang2";
    }

    $html .= "
    <center>

    <p><b style=\"color:#873852\">
        Select a code set and language(s)</b>
    <form class=\"job_detail_view\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">
    ";

    $html .= $language->select('code_set',  $language->native, array(
        'blank_prompt' => 'All Codes'
    ));
    $html .= "<br><br>".$language->select('code_lang', $language->native);
    $html .= "<br><br>".$language->select('code_lang', $language->native, array(
        'var_name' => 'code_lang2',
        'select_prompt' => '(Other)',
        'blank_prompt' => '(None)'
    ));

    $html .= "<br><br>
    <input class=\"blackbutton\" type=submit value=\"View Set\">
    </form>
    <hr>
    ";
}

#       #       #       #
#
# Display the code translation todo list
#
function bka_translations() {
    global $language;
	global $html;
	
    $html .= "<b style=\"color:#873852\">Translation Sets</b><br><br>\n";

    # Get the code counts for all language sets.
    $code_counts = bka_get_counts();

    # Get the code and language sets and print the top header.
    $set_rows  = $language->lang_set('code_set',  $language->native);
    $lang_rows = $language->lang_set('code_lang', $language->native);
    $html .= "<table class=\"myTABLE\"><tr><td>&nbsp;\n";
    $html .= "</td>";
    foreach ( $lang_rows as $lang_row ) {
        if ($lang_row[3] == 'd') continue;
        $lang_cd = $lang_row[0];
        $html .= sprintf("<td><b>%6s</b></td>", $lang_cd);
    }
	$html .= "</tr>";

    # Print the count array.
    foreach ( $set_rows as $set_row ) {
        if ($set_row[3] == 'd') continue;
        $set_cd = $set_row[0];

        $this_admin = bka_admin_get($set_cd);
        if ($this_admin['param']) continue;

        $html .= "\n<tr><td class=\"column1\" style=\"font-size:14px; font-weight:bolder;\"><a href=\"" .
            $_SERVER['PHP_SELF'] . "?code_set=$set_cd" .
            "\">$set_cd</a></td>";
//        $html .= bka_str_repeat(' ', 16 - strlen($set_cd) );

        $nat_count = $code_counts[$set_cd][$language->native];
        foreach ( $lang_rows as $lang_row ) {
            if ($lang_row[3] == 'd') continue;
            $lang_cd = $lang_row[0];
            $code_count = $code_counts[$set_cd][$lang_cd];
            $html .= bka_str_repeat(' ', 6 - strlen($code_count + 0) );
            $html .= "<td class=\"column1\"><a href=\"" . $_SERVER['PHP_SELF'] .
                "?code_set=$set_cd" .
                "&code_lang=$language->native" .
                "&code_lang2=$lang_cd" .
                "\">";
            if ($code_count == $nat_count) {
                $html .= sprintf("%d", $code_count);
            } else {
                $html .= sprintf("<span style=\"color:red\">%d</span>", $code_count);
                $todo_count += 1;
            }
            $html .= "</td></a>";

            $totals[$lang_cd] += $code_count;
        }
		$html .= "</tr>";

    }

    # Print the language totals.
//    $html .= sprintf("\n%-16s", "");
	$html .= "<tr><td>&nbsp;</td>";
    foreach ( $lang_rows as $lang_row ) {
        if ($lang_row[3] == 'd') continue;
        $lang_cd = $lang_row[0];
        $html .= sprintf("<td align=center>%6d</td>", $totals[$lang_cd]);
    }

    $html .= "</tr></table>\n";
    $html .= sprintf("%d language sets need translation work!", $todo_count);
	$html .= "<br><br>";
}

#       #       #       #
#
# Display a code set
#
function bka_set_display() {
    global $language;
    global $code_set;
    global $code_lang;
    global $code_lang2;
    global $code_admin;
    global $perm_add;
	global $html;

    if ($code_lang == $language->native) {
        $edit_lang2 = $code_lang2;
    } else {
        $edit_lang2 = '';
    }

    $set_desc = $language->ucwords('code_set', $language->native, $code_set);
    $html .= "<b style=\"color:#873852\">$set_desc Code Administration</b>\n";
    $html .= "<p>\n";

    $html .= "
    <table class=\"myTABLE\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
    <tr class=\"Odd\">
    ";

    if ($code_set == 'code_set') {

        $html .= "
        <th class=\"column1\">
            <strong>&nbsp;P&nbsp;</strong></th>
        <th class=\"column1\">
            <strong>&nbsp;S&nbsp;</strong></th>
        <th class=\"column1\">
            <strong>&nbsp;M&nbsp;</strong></th>
        ";

    } else {

        $html .= "
        <th class=\"column1\">
            <strong>&nbsp;D&nbsp;</strong></th>
        ";
    }

    $html .= "
    <th class=\"column1\">
        <strong>&nbsp;O&nbsp;</strong></th>
    <th class=\"column1\">
        <strong>&nbsp;Code&nbsp;</strong></th>
    <th class=\"column1\">
        <strong>&nbsp;Description&nbsp;</strong></th>
    <th class=\"column1\">
        <strong>&nbsp;Edit&nbsp;</strong></th>
    </tr>
    ";

    # Gather the codes in order and truncate the descriptions.
    $base_set = $language->lang_set($code_set, $code_lang);
    foreach ( $base_set as $n => $row ) {
        $desc = $row[1];
        if (strlen($desc) > 50)
            $desc = substr($desc, 0, 50) . '...';
        $base_set[$n][1] = htmlspecialchars($desc);
    }

    if ($code_lang2) {

        # Add the second language descriptions.
        $lang_set = $language->lang_set($code_set, $code_lang2);
        $lang_lookup = array();
        foreach ( $lang_set as $row ) $lang_lookup[$row[0]] = $row[1];
        unset($lang_set);
        foreach ( $base_set as $n => $row ) {
            $cd = $row[0];
            $desc = $lang_lookup[$row[0]];
            if ($desc <> '') {
                if (strlen($desc) > 50)
                    $desc = substr($desc, 0, 50) . '...';
                $base_set[$n][4] = htmlspecialchars($desc);
            }
        }
        unset($lang_lookup);
    }

    $colspan = ($code_set == 'code_set') ? 5 : 3;
    foreach ( $base_set as $n => $row ) {
        list(
            $code_code,
            $code_desc,
            $code_order,
            $code_flag,
            $code_desc2
        ) = $row;

        $bgcolor    = ($n % 2) ? "#6699CC" : "#6699FF";

        $html .="
        <tr>
        ";
        if ($code_set == 'code_set') {

            $this_admin = bka_admin_get($code_code);
            $P = $this_admin['param'] ? 'P' : '';
            $S = $this_admin['slave'] ? 'S' : '';
            $M = $this_admin['multi'] ? 'M' : '';
            $html .= "
            <td class=\"column1\" >&nbsp;$P&nbsp;</td>
            <td class=\"column1\"  >&nbsp;$S&nbsp;</td>
            <td class=\"column1\" >&nbsp;$M&nbsp;</td>
            ";
        } else {

            $D = $code_flag ? 'D' : '';
            $html .= "
            <td class=\"column1\">&nbsp;$D&nbsp;</td>
            ";
        }
        $html .= "
        <td class=\"column1\" >&nbsp;$code_order&nbsp;</td>
        <td class=\"column1\" >&nbsp;$code_code&nbsp;</td>
        <td class=\"column1\" >&nbsp;$code_desc&nbsp;</td>
        <td class=\"column1\" >&nbsp;
            <a href=\"" . $_SERVER['PHP_SELF'] .
            "?code_set=$code_set" .
            "&code_lang=$language->native" .
            "&code_lang2=$edit_lang2" .
            "&code_code=$code_code" . "\" style=\"color:white;\">
            <strong>edit</strong></a>&nbsp;
        </td>
        </tr>
        ";

        if ($code_lang2) {
            $html .= "
            <tr>
            <td class=\"column1\" colspan=\"$colspan\">&nbsp;</td>
            <td class=\"column1\">&nbsp;$code_desc2&nbsp;</td>
            <td class=\"column1\">&nbsp;</td>
            </tr>
            ";
        }
    }
    $html .=("</table>\n");

    $count = count($base_set);
    switch ($count) {
        case 0: $html .=("<p>No records.\n\n"); break;
        case 1: $html .= sprintf("<p><b>%d</b> record.\n\n", $count); break;
        default: $html .= sprintf("<p><b>%d</b> records.\n\n", $count);
    }
    if ($perm_add) {
        $html .= "&nbsp;&nbsp;<a href=\"" . $_SERVER['PHP_SELF'] .
            "?code_set=$code_set" .
            "&action=New" . "\">Add new $set_desc code</a><br><br>\n";
    }
}

#       #       #       #
#
# Display the multilanguage code entry/update form.
#
function bka_form_display($code_code = '') {
    global $language;
    global $code_set;
    global $code_lang;
    global $code_lang2;
    global $code_admin;
    global $perm_add;
    global $perm_upd;
    global $perm_del;
	global $html;

    # Check for a valid code set or exit.
    $set_desc = $language->ucwords('code_set', $language->native, $code_set);
    if (!$set_desc)
        bka_error_exit("No Code set specified!");
    $html .= "<b style=\"color:#873852\">$set_desc Code Administration</b>\n";
    $html .= "<p>\n";

    $html .= "
    <form class=\"job_detail_view\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">
    <input type=\"hidden\" name=\"code_set\" value=\"$code_set\" >
    <input type=\"hidden\" name=\"code_lang\" value=\"$code_lang\" >
    <input type=\"hidden\" name=\"code_lang2\" value=\"$code_lang2\" >
    <table  border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
    <tr><th colspan=2>
    ";

    if ($code_code == '') {
        $html .= " Add $set_desc code </th><td>";
    } else {

        # Code navigation aids.
        $set = $language->lang_set($code_set, $language->native);
        list( $n_of, $of_n, $next_cd, $prev_cd, $first_cd, $last_cd ) =
            bka_place($set, $code_code);
        $html .= "<b>Edit $set_desc code \"$code_code\"</b>
                (#$n_of of $of_n)<br>\n";

        $html .= "<a href=\"". $_SERVER['PHP_SELF'] .
            "?code_set=$code_set" .
            "&code_lang=$code_lang" .
            "&code_lang2=$code_lang2" .
            "&code_code=$next_cd" . "\">Next</a> ($next_cd)\n";

        $html .= "<a href=\"". $_SERVER['PHP_SELF'] .
            "?code_set=$code_set" .
            "&code_lang=$code_lang" .
            "&code_lang2=$code_lang2" .
            "&code_code=$prev_cd" . "\">Prev</a> ($prev_cd)\n";

        $html .= "<a href=\"". $_SERVER['PHP_SELF'] .
            "?code_set=$code_set" .
            "&code_lang=$code_lang" .
            "&code_lang2=$code_lang2" .
            "&code_code=$first_cd" . "\">First</a> ($first_cd)\n";

        $html .= "<a href=\"". $_SERVER['PHP_SELF'] .
            "?code_set=$code_set" .
            "&code_lang=$code_lang" .
            "&code_lang2=$code_lang2" .
            "&code_code=$last_cd" . "\">Last</a> ($last_cd)\n";
    }

    # Code code.
    $html .= "
    <hr></td>
    </tr>
    <tr>
    <td class=\"right_td\"><strong>Code</strong></td>
    <td class=\"left_td\">
    ";
    if ($code_code == '') {
        if ($code_set == 'code_set') {
            $html .= "<input name=\"code_code\" size=\"16\" maxlength=\"16\">\n";
        } else {
            $html .= "<input name=\"code_code\" size=\"32\" maxlength=\"32\">\n";
        }
    } else {
        $html .= "$code_code\n";
        $html .= "<input name=\"code_code\" type=\"hidden\"
            value=\"$code_code\">\n";
    }
    $html .= "
    </td>
    </tr>
    ";

    list( $desc_nat, $code_order, $code_flag ) =
        $language->get($code_set, $language->native, $code_code);
    if ($code_set == 'code_set') {

        # Code Set Admin parameters
        $this_admin = bka_admin_get($code_code);

        $checked = ($this_admin['param']) ? 'checked' : '';
        $html .= "
        <tr>
            <td class=\"right_td\"><strong>Parameter Set</strong></td>
            <td class=\"left_td\"><input name=\"this_admin[param]\" style=\"width:25px;\"s type=\"checkbox\"
                value=\"1\" $checked>
            [Parameter sets are not translated]
            </td>
        </tr>
        ";

        $checked = ($this_admin['slave']) ? 'checked' : '';
        $html .= "
        <tr>
            <td class=\"right_td\">Slave Set</td>
            <td class=\"left_td\"><input name=\"this_admin[slave]\" type=\"checkbox\" style=\"width:25px;\" value=\"1\" $checked>
            [Slave sets are for translation only]
            </td>
        </tr>
        ";

        $checked = ($this_admin['multi']) ? 'checked' : '';
        $html .= "
        <tr>
            <td class=\"right_td\">Multiline Set</td>
            <td class=\"left_td\"><input name=\"this_admin[multi]\" style=\"width:25px;\" type=\"checkbox\" value=\"1\" $checked>
            [Paragraph mode]
            </td>
        </tr>
        ";

    } else {

        # Deprecated?
        $checked = ($code_flag == 'd') ? "checked" : "";
        $html .= "
        <tr>
            <td class=\"right_td\">Deprecated</td>
            <td class=\"left_td\"><input style=\"width:25px;\" name=\"code_flag\" type=\"checkbox\" value=\"d\" $checked>
            </td>
        </tr>
        ";

    }

    # Order number.
    $html .= "
    <tr>
        <td class=\"right_td\">Code Order</td>
        <td class=\"left_td\"><input  name=\"code_order\" size=\"4\"
        value=\"$code_order\"></td>
    </tr>
    ";

    # Make a field for each translation.
    if ($code_admin['param']) {
        $lang_rows = array(
          array(
            $language->native, $language->desc('code_lang', $language->native, $code_lang)
          )
        );
    } elseif ($code_lang2) {
        $lang_rows = array(
          array(
            $code_lang  , $language->desc('code_lang', $language->native, $code_lang),
          ),
          array(
            $code_lang2 , $language->desc('code_lang', $language->native, $code_lang2)
          )
        );
    } else {
        $lang_rows = $language->lang_set('code_lang', $language->native);
    }

    foreach ( $lang_rows as $lang_row ) {
        list( $lang_code, $lang_desc, $lang_order, $lang_flag ) = $lang_row;
        if ($lang_flag == 'd') continue;

        $code_desc = $language->data($code_set, $lang_code, $code_code);
        $code_desc = htmlspecialchars($code_desc);
        $lang_desc = ucfirst($lang_desc);

        $html .= "<tr>\n";
        $html .= "<td  class=\"right_td\" valign=\"top\">$lang_desc</td>\n";
        if ($lang_code == $language->native && $code_admin['slave']) {
            $html .= "<td  class=\"left_td\">$code_desc\n";
            $html .= "<input type=\"hidden\" name=\"code_desc[$lang_code]\"";
            $html .= " value=\"$code_desc\">\n</td>\n";
        } elseif ($code_admin['multi']) {
            $n = count(explode("\n", $code_desc));
            if ($n < 3) $n = 3;
            $html .= "<td class=\"left_td\"><textarea name=\"code_desc[$lang_code]\" " .
                "cols=\"60\" rows=\"$n\" wrap=\"virtual\">$code_desc";
            $html .= "</textarea></td>\n";
        } else {
            $html .= "<td class=\"left_td\"><input name=\"code_desc[$lang_code]\" size=\"50\"";
            $html .= "    value=\"$code_desc\"></td>\n";
        }
        $html .= "</tr>\n";
    }

    # Action items.
    $html .= "
    <tr>
    <td class=\"right_td\">Action</td>
    <td class=\"left_td\">
    ";
    if ($code_code == '') {
        if ($perm_add)
            $html .= "<input class=\"blackbutton\" style=\"width:100px\" type=\"submit\" name=\"action\" value=\"Add\">\n";
    } else {
        if ($perm_upd)
            $html .= "<input class=\"blackbutton\" style=\"width:100px\" type=\"submit\" name=\"action\" value=\"Update\">\n";
        if ($perm_del)
            $html .= "<input class=\"blackbutton\" style=\"width:100px\" type=\"submit\" name=\"action\" value=\"Delete\">\n";
        if ($perm_add) {
            $html .= "<a href=\"". $_SERVER['PHP_SELF'] .
            "?code_set=$code_set" .
            "&action=New" . "\">Add new $set_desc code</a>\n";
        }
    }
    $html .= "
    </td>
    </tr>
    </table>
    </form>
    
    ";
}

#       #       #       #
#
# Add / Update / Delete a code.
#
function bka_form_aud() {
    global $language;
    global $action;
    global $code_set;
    global $code_code;
    global $perm_add;
    global $perm_upd;
    global $perm_del;
	global $html;

    $code_order = $_POST['code_order'];
    $code_flag  = $_POST['code_flag'];
    $this_admin = $_POST['this_admin'];
    $code_desc  = $_POST['code_desc'];

    # Check for validity.
    if (! $language->get('code_set', $language->native, $code_set))
        bka_error_exit("No Code set specified!");
    if ($action == 'Add' && !$perm_add)
        bka_error_exit("No permission to add '$code_set'!");
    if ($action == 'Update' && !$perm_upd)
        bka_error_exit("No permission to update '$code_set'!");
    if ($action == 'Delete' && !$perm_del)
        bka_error_exit("No permission to delete '$code_set'!");
    if ($code_code == '')
        bka_error_exit("No code specified!");
    if (!ereg('^[a-zA-Z_0-9-]+$', $code_code))
        bka_error_exit("Code must consist of [a-zA-Z_0-9-]!");
    if (!ereg('^-?[0-9]*$', $code_order))
        bka_error_exit("Code order must be numeric!");

    # Variable setup.
    $lang_list = $language->lang_set('code_lang', $language->native);
    $nat_exists = $language->get($code_set, $language->native, $code_code);
    if ($action == "Update" || $action == 'Delete') {
        $set = $language->lang_set($code_set, $language->native);
        list( $n_of, $of_n, $next_cd, $prev_cd, $first_cd, $last_cd ) =
            bka_place($set, $code_code);
    }

    if ($action == 'Delete') {
        if (!$nat_exists)
            bka_error_exit("No such code '$code_code'!");
        $language->remove($code_set, $code_code);
        $html .= "Record Deleted!<p>\n";
        if ($next_cd == $code_code) {
            bka_set_display();
        } else {
            bka_form_display($next_cd);
        }
    }

    elseif ($action == 'Add' || $action == 'Update') {

        if ($action == 'Add' && $nat_exists)
            bka_error_exit("Code '$code_code' already exists!");
        elseif ($action == 'Update' && !$nat_exists)
            bka_error_exit("No such code '$code_code'!");

        if ($code_desc[$language->native] == '')
            bka_error_exit("No native code description specified!");

        # Pump in those fields.
        foreach ( $lang_list as $lang_row ) {
            $lang_cd = $lang_row[0];
            $lang_desc = $code_desc[$lang_cd];
            if (!isset($lang_desc)) continue;
            $lang_desc = trim($lang_desc);
            $language->put($code_set, $lang_cd, $code_code, $lang_desc,
                $code_order, $code_flag);
        }

        # Code Admin fields.
        if ($code_set == 'code_set') {
            bka_admin_put($code_code, $this_admin);
        }

        # Whats next.
        if ($action == 'Add') {
            $html .= "Record Added!<p>\n";
            bka_form_display();
        }
        else {
            $html .= "Record Updated!<p>\n";
            bka_form_display($next_cd);
        }
    }

    else {
        bka_error_exit("Unknown form action '$action'");
    }
}

#       #       #       #
#
# Local Functions
#

# Get the code counts for all language sets.
function bka_get_counts() {
    global $language;
    $result = $language->_query("
        select  code_set,
                code_lang,
                count(*) code_count
        from    $language->table
        group by code_set, code_lang
    ");
    $code_counts = array();
    foreach ( $result as $row ) {
        $code_counts[$row[0]][$row[1]] = $row[2];
    }
    return $code_counts;
}

# Find a code's place in the set.
function bka_place($set, $code_code) {
    $count = count($set);
    $first = $set[0][0];
    $last = $set[$count - 1][0];

    for ($n = 0; $n < $count; $n++) {
        if ($set[$n][0] == $code_code) break;
    }
    if ($n == 0) {
        $prev = $last;
        if ($count > 1) {
            $next = $set[$n + 1][0];
        } else  {
            $next = $last;
        }
    } elseif ($n == $count - 1) {
        $prev = $set[$n - 1][0];
        $next = $first;
    } else {
        $prev = $set[$n - 1][0];
        $next = $set[$n + 1][0];
    }

    reset($set);
    return array( $n + 1, $count, $next, $prev, $first, $last );
}

# Get the code_admin options for the set.
function bka_admin_get($code_set) {
    global $language;
    $params = explode(' ', $language->param('code_admin', $code_set));
    foreach ( $params as $n => $param ) {
        list( $attr, $value ) = explode('=', $param);
        $code_admin[$attr] = $value;
    }
    return $code_admin;
}

# Put the code_admin options for the set.
function bka_admin_put($code_set, $code_admin) {
    global $language;
    if (!$code_admin) $code_admin = array();
    foreach ( $code_admin as $attr => $value ) {
        if (!$attr or !$value) continue;
        if ($params) $params .= ' ';
        $params .= "$attr=$value";
    }
    $language->put('code_admin', $language->native, $code_set, $params);
}

# Error exit.
function bka_error_exit($msg) {

	global $html;
	
    $html .= "<p><b>Error: $msg</b>";
#   page_close();                       # If you need closure.
    exit();
}

# Compiler error workaround.
function bka_str_repeat($str, $rep) {
    if ($rep <= 0) return;              # Stunned designer.
#   return str_repeat($str, $rep);      # PHP bug too.
    for ($i = 0; $i < $rep; $i++) {
        $ret .= $str;
    }
    return $ret;
}

$html = bka_admin_main()."</center>";

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('show_page','edlang');
$tpl-> assign('edlang',$html);

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/edlang.tpl");

?>
