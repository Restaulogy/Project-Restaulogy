{include file='header.tpl'}
<div class="wrapper">
 <h1>{$_lang.main.set_up_menu.title}</h1>  
 
 
 <table class="cnf">
    <tr>
         <td> 
			<a href="{$website}/user/tbl_menu.php">
				<img src="{$website}/css/jqm_extra_icon/green/addressbook.png" alt="{$_lang.main.set_up_menu.sum_menu}"/>
				<span>{$_lang.main.set_up_menu.sum_menu}</span>
			</a>
		 </td>
         <th>&nbsp;</th>
         <td>
            <a href="{$website}/user/tbl_dishes.php">
				<img src="{$website}/css/jqm_extra_icon/green/disc.png" alt="{$_lang.main.set_up_menu.sum_dish}"/>
				<span>{$_lang.main.set_up_menu.sum_dish}</span>
			</a>	
         </td>
    </tr> 
 </table>
  
{include file='footer.tpl'}
