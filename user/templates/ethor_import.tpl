{include file="header.tpl"}
<div class="wrapper">
    <h1>{$_lang.main.ethor.import}</h1>

    <div class="info">
        Import menu from the ethore store to the restaurant.
    </div>
    <br><br>
    <form method="POST" action="{$website}/user/ethor_menu.php" >
        <input data-inline="true" name="action" value="import" type="hidden" />
        {if $is_allowed_import eq 1}
            <input data-inline="true" data-icon="reload" name="btn_import" value="Import" type="submit"/>
        {else}
            <div class="error">Restaurant is not recognized as ethore store.You cannot import.</div>
        {/if}
    </form>
    <br><br>
    {if $menu_list}
        {$menu_list}
    {/if}
</div><!--/.wrapper-->
{include file="footer.tpl"}
