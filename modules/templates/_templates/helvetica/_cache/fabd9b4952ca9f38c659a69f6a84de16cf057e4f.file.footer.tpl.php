<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 13:41:23
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\helvetica\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1767551c167abab6490-20300363%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fabd9b4952ca9f38c659a69f6a84de16cf057e4f' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\helvetica\\footer.tpl',
      1 => 1364975054,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1767551c167abab6490-20300363',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'translations' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c167abb246d2_78087050',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c167abb246d2_78087050')) {function content_51c167abb246d2_78087050($_smarty_tpl) {?><table id="tbl_footer">
    <tr>
        <td id="top_border"></td>
    </tr>
    <tr>
        <td>
            <center>
                 <?php echo $_smarty_tpl->tpl_vars['translations']->value['copyright'];?>

            </center>
        </td>
    </tr>

</table>
            
<!--
   <table id="tbl_footer">
          <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <img src="images/icon_email_friend.gif" width="36" height="37" alt="">
                        </td>
                        <td width="16" rowspan="2" valign="top">&nbsp;</td>
                        <td>
                           <?php echo $_smarty_tpl->getSubTemplate ("footer/email_info.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                        </td>
                    </tr>
                 </table>
            </td>
            <td>
                 <table>
                    <tr>
                        <td>
                            <img src="images/icon-footer.gif" width="36" height="37" alt="">
                        </td>
                        <td width="16" rowspan="2" valign="top">&nbsp;</td>
                        <td>
                          <?php echo $_smarty_tpl->getSubTemplate ("footer/contact_info.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                        </td>
                    </tr>
                 </table>

            </td>
            </tr>
          </table>
-->


<?php }} ?>