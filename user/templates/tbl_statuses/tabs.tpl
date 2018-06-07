<!-- <link rel="stylesheet" href="{$website}/css/chosen/chosen.css" /> -->
<div class="navTable_border">
<table class="navTable" style="width:300px;">
	<tr>
        <th {if ($status_event eq 'REQUEST') && !($smarty.request[$smarty.const.MODE_TITLE])}class="active"{else}class="link" onclick="changeTab('REQUEST',{if !($smarty.request[$smarty.const.MODE_TITLE])}0{else}1{/if});"{/if}>{$_lang.main.status_menu.request}</th>
		<th {if ($status_event eq 'ORDER') && !($smarty.request[$smarty.const.MODE_TITLE])}class="active"{else}class="link" onclick="changeTab('ORDER',{if !($smarty.request[$smarty.const.MODE_TITLE])}0{else}1{/if});"{/if}>{$_lang.main.status_menu.order}</th>
		<th {if ($status_event eq 'TABLE') && !($smarty.request[$smarty.const.MODE_TITLE])}class="active"{else}class="link" onclick="changeTab('TABLE',{if !($smarty.request[$smarty.const.MODE_TITLE])}0{else}1{/if});"{/if}>{$_lang.main.status_menu.table}</th>
		<th {if ($status_event eq 'PROMOTION') && !($smarty.request[$smarty.const.MODE_TITLE])}class="active"{else}class="link" onclick="changeTab('PROMOTION',{if !($smarty.request[$smarty.const.MODE_TITLE])}0{else}1{/if});"{/if}>{$_lang.main.status_menu.promotion}</th>
	</tr>
</table>
</div>
