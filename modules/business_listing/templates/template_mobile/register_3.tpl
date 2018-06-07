
         <div class="attention">
            {lang->desc p1='register' p2=$lang_set p3='step_pay'}
        </div>
          

		<table width=100% align=center cellpadding=5 cellspacing=0>
        <tr>
        <tr>
         <td width=50% valign=top align=left>
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
           <input type="hidden" name="cmd" value="_xclick">
           <input type="hidden" name="business" value="{$vs_config.paypal_email}">
           <input type="hidden" name="return" value="{$vs_config.mainurl}/register.php">
           <input type="hidden" name="notify_url" value="{$vs_config.mainurl}/register.php">
           <input type="hidden" name="cancel_return" value="{$vs_config.mainurl}">
           <input type="hidden" name="custom" value="{$vs_current_listing.id}">
           <input type="hidden" name="currency_code" value="{$vs_config.paypal_currency}">
           <input type="hidden" name="item_number" value="{$listing_level}">
           <input type="hidden" name="item_name" value="{$vs_level[$listing_level].title} Membership">
           <input type="hidden" name="quantity" value="1">
           <input type="hidden" name="amount" value="{$vs_level[$listing_level].cost}">
           <input type="hidden" name="no_shipping" value="0">
           <input type=submit class="blackbutton" value="{lang->desc p1='register' p2=$lang_set p3='btn_paypal'}">
          </form>
         </td>
         <td width=50% valign=top align=left>
          <form action="register.php" method="post">
           <input type=hidden name=listing_level value="{$listing_level}">
           <input type=hidden name=submit_flag value=1>
           <input type="submit" class="blackbutton" name="btn_billing" value="{lang->desc p1='register' p2=$lang_set p3='btn_billing'}">
          </form>
         </td>
        </tr>
       </table>
