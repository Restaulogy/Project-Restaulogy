
    <li>
    <!--<a href="#promo_dialog{$user_promotion[pitm].id}" data-rel="dialog">-->
    <a href="promotion.php?view_promotion_id={$user_promotion[pitm].id}" rel="external">

        <p>
        <table style='font-size:10px;'>
            <tr>
                <td>
                <b style='font-size:11px;'>{$user_promotion[pitm].title}&nbsp;at&nbsp;{$list[itm].firm}</b>
                </td>
            </tr>
            <tr>
                <td>{$user_promotion[pitm].start_date|date_format:"%D"}&nbsp;-&nbsp;{$user_promotion[pitm].end_date|date_format:"%D"}&nbsp;<a href='promotion.php?renew=1&id={$user_promotion[pitm].id}' target="_blank" >Renew</a></td>
            </tr>
        </table>
        </p>
        </a>
    </li>



      
    





