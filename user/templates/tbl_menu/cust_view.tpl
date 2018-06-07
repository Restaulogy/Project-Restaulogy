{include file="header.tpl"}
<style>
.ui-select .ui-btn-icon-right .ui-icon {
right: 0px !important;
}
</style>

<div class="wrapper" >

<a id="mnu_srch_top_btn" href="#" style="float:right;" data-inline="true" data-mini="true" data-role="button" data-icon="search"  onclick="$('#filter_menu_for_cust').toggle();$('#mnu_srch_top_btn').hide();"> Search</a>

<!-- {*include file='menu_nav_bar.tpl'*} -->

<!--<h1>
<a href="{$website}/user/tbl_menu.php?is_preview=1">{$_lang.tbl_menu.listing_title}</a>
<b class="bigSymbol">&raquo;</b> 
<b>{$_lang.tbl_dishes.listing_title}</b> 
	
</h1>-->

<!--<div class="clearfix"></div>-->

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

{if $smarty.session.menu_filt.filter_text neq ''}
	<div style="width:99%;padding:5px;border-bottom:1px dotted #ccc;font-style: italic;"><span class="info">Search results &laquo; </span><span class="notice">{$smarty.session.menu_filt.filter_text}</span>
    <input data-inline="true" data-icon="delete" data-iconpos="notext" type="button" onclick="window.location.href='{$website}/user/tbl_menu.php?web_redt={$web_redt}&search_attrib=&search_keyword=&search_price=0&cancel_filter=1&mode=VIEW&menu_id={$smarty.session[$smarty.const.SES_MENU]}&is_preview=1';" value=""/>
    <span class="info">&raquo;</span></div>
    <br>
{/if}

{include file='tbl_menu/search.tpl'}

<div id="tbl_menu_view" class="description"> 

<div style="z-index: 9999 !important;">
	<label>Choose Menu</label>
	<select id="sel_mnu_top" name="sel_mnu_top" onchange="window.location.href='{$website}/user/tbl_menu.php?menu_id='+this.value+'&is_preview=1&mode=VIEW';" >
	 <!-- <option value="" data-placeholder="true">Select Menu</option>-->
	 {foreach from=$tbl_menulist key=mnuId item=_menu}
	 		<option value="{$mnuId}" {if $smarty.session[$smarty.const.SES_MENU] && ($_menu@key eq $smarty.session[$smarty.const.SES_MENU])}selected="selected"{/if} >{$_menu.menu_name}</option>
	 {/foreach}
	</select>
</div>


 <div id="mnu_dishes_pg">
{if $mnu_full_deatils.submenu}
{else}
    <div class="error">We apologize, Currently we do not have this information available, please check with your server.</div>
{/if}

	<div id="menuset" data-role="collapsible-set" data-theme="a" class="ui-content"  data-content-theme="b" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" class="no_border">
   {foreach from=$mnu_full_deatils.submenu item=sub_menu name='_nm_sb_mnu'}
	 		
			{if $sub_menu.dishes_count gt 0}			
        <div data-role="collapsible" class="coll" {if $smarty.foreach._nm_sb_mnu.index eq 0}data-collapsed="false"{/if}>
            <h4>
                {if $sub_menu.submnu_image neq ''}
                    <img width="30" height="30" src="{$website}/uploads/submenu/{$sub_menu.submnu_image}" alt="{$sub_menu.submnu_image}" />
                {else}
                    <img width="30" height="30" src="{$website}/images/no_dish.png" />
                {/if}
               
                <small style='font-size:12px !important;text-transform:none;'>
                {$sub_menu.submnu_name|truncate:50:'..':true}               
                </small>
               {*if $sub_menu.submnu_description  && $sub_menu.submnu_description neq '' }
                    <br>
                    <small style='font-size:10px !important;text-transform:none;'>
                    <!--<span style='font-size:16px;'>*</span>-->                
                    {$sub_menu.submnu_description|wordwrap:35:"<br />\n"}
                    </small>
                {/if*}              
								
            </h4>
		 
            <p class="no_margin no_padding">  
			<table class="listTable white_border no_margin full_width" style='background:#fff;'>    
				
        {foreach from=$sub_menu.dishes item=tbl_dishesitem name='mn_sbmn_dsh'} 
				
			  {assign var="dish_img_actual" value=""}
			  {if $tbl_dishesitem.sbmnu_dish_dish_details.dish_img neq ""}
	              {assign var="dish_img_actual" value="{$website}/uploads/dish/{$tbl_dishesitem.sbmnu_dish_dish_details.dish_img}"}
	          {else}
	              {if $tbl_dishesitem.sbmnu_dish_dish_details.dish_is_drink eq 0}
	                  {assign var="dish_img_actual" value="{$website}/images/no_dish.png"}
	              {else}
					  {assign var="dish_img_actual" value="{$website}/images/no_drink.jpg"}
	              {/if}
	          {/if} 
					
			{assign var="dish_price_actual" value=""}
			 {if $tbl_dishesitem.sbmnu_dish_dish_details.dish_is_drink gt 0}
		        {if $tbl_dishesitem.sbmnu_dish_dish_details.dish_bottle_price gt 0}
		            {assign var="dish_price_actual" value="{$tbl_dishesitem.sbmnu_dish_dish_details.dish_bottle_price}"}
		        {elseif $tbl_dishesitem.sbmnu_dish_dish_details.dish_glass_price gt 0}
					{assign var="dish_price_actual" value="{$tbl_dishesitem.sbmnu_dish_dish_details.dish_glass_price}"}
		        {else}
					{assign var="dish_price_actual" value="0.00"}
		        {/if}
             {else}
                {if $tbl_dishesitem.sbmnu_dish_price gt 0}
					{assign var="dish_price_actual" value="{$tbl_dishesitem.sbmnu_dish_price}"}            
                {else}
					{assign var="dish_price_actual" value="0.00"}
                {/if}
             {/if}
			{if $deviceType eq 'phone'}
				{assign var="_itm_per_row" value="2"}
			{else}
				{assign var="_itm_per_row" value="3"}
			{/if}
						
			{if $smarty.foreach.mn_sbmn_dsh.index gt 0 && $smarty.foreach.mn_sbmn_dsh.index % $_itm_per_row == 0}
				<tr>
			{/if}
				 	<td >
						<table style='border:0px solid #dadad1;width:100%;height:99%;'>
							<tr>
								<td style='vertical-align:top !important;padding:5px;width:100px;height:{if $deviceType eq 'phone'}100px;{else}190px;{/if}background:url("{$dish_img_actual}");background-size:100% 100%;background-repeat: no-repeat;cursor:pointer;' onclick="window.location.href='{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$tbl_dishesitem.sbmnu_dish_id}&is_preview=1&web_redt={$web_redt}';"></td>
							</tr>
							<tr>
								<td style='color:#000;font-size:12px;font-family: arial;height:40px;cursor:pointer;' >
									<table style='border:0px solid #dadad1;width:100%;height:100%;'>
										<tr>
											<td width='100%'>
												{$tbl_dishesitem.sbmnu_dish_dish_details.dish_name|truncate:30:'..':true}
											</td>
										</tr>	
										<tr>	
											<td width='100%'>
											<span style='color:#EF6C00;font-size:18px;font-weight: bold;font-family: arial;'>{$smarty.session.curr_restant.restaurent_currency}{$dish_price_actual|round:0}</span>
											{if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1}											<span style='float:right !important;'><input type="button" data-inline="true" data-mini="true" data-icon="add-item" data-theme="b" value="Add &nbsp;" onclick=" {if $smarty.session[$smarty.const.SES_OTP]} newOrder({$tbl_dishesitem.sbmnu_dish_id}); {else} startOTP({$tbl_dishesitem.sbmnu_dish_id}); {/if}" /></span>
											{/if}
											</td>
										</tr>
									</table>								
								</td>	
							</tr>
						</table>
					</td>					 
				{/foreach}
				{if $sub_menu.dishes_count==1}
					<td width='50%' >
						&nbsp;
					</td>
				{/if}
				</tr>
			</table>				
						

	  		</p>
	  </div>
			{/if}
    {/foreach}   
    </div> 
 </div>

<div class="biz_center">
{if $web_redt eq 1}
{else}
    <input data-icon="delete" data-inline="true"  type="button" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}?is_preview=1&web_redt={$web_redt}'"/>
{/if}

</div>
</div>

{include file="tbl_menu/js.tpl"}

{include file="tbl_menu/cust_view/order.tpl"}

{include file="tbl_menu/cust_view/js.tpl"}

{include file="tbl_menu/otp.tpl"}

</div>

{include file="footercontent.tpl"}
{literal}
<script>

function changeTheme(collapsible_id){
 
	$("[data-role='collapsible'] .ui-collapsible-heading a").attr('data-theme', 'a').trigger('create');
	if(collapsible_id){
		collapsible_id.find('.ui-collapsible-heading a').attr('data-theme', 'd').trigger('create');
	}
}

function startOTP(submenu_dish){	
	$("#otp_dish_rdt_id").val(submenu_dish);
	$('#popupOTP').popup('open');
}

function newOrder(submenu_dish){
 if(submenu_dish > 0){
 	 var info = {}; 
 	 info["popup_window"] = 'NewOrder'; 
 	 postForm(info,"{/literal}{$website}{literal}/user/tbl_menu.php?sbmnu_dish_id="+submenu_dish+"&is_preview=1",'post','_self');
 	 //$('#popupNewOrder').popup('open');	 
 	 //info["sbmnu_dish_id"] = submenu_dish;
 	 //info["is_preview"] = 1;
 	 //postForm(info,"{/literal}{$website}{literal}/user/tbl_submenu_dishes.php?sbmnu_dish_id="+submenu_dish+"&is_preview=1",'post','_self');	
 }

}

$(function(){
	/*$('#menu_start_timing').scroller({ preset: 'time', timeFormat:'HH:ii'});*/
	$("#menu_start_timing").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
	$("#menu_end_timing").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
	/*$('#menu_end_timing').scroller({ preset: 'time' }); */

})

/*$(document).one("pagebeforechange", function() {
    // animation speed;
    var animationSpeed = 700;

    function animateCollapsibleSet(elm) {
        // can attach events only one time, otherwise we create infinity loop;				
        elm.one("expand", function() {
			//$(this).find("a[data-theme='a']").removeClass('ui-btn-up-a').addClass('ui-btn-up-d').attr('data-theme', 'd').trigger('create'); 
            // hide the other collapsibles first;
            $(this).parent().find(".ui-collapsible-content").not(".ui-collapsible-content-collapsed").trigger("collapse"); 
            // animate show on collapsible;
            $(this).find(".ui-collapsible-content").slideDown(animationSpeed, function() {
            // trigger original event and attach the animation again;
			animateCollapsibleSet($(this).parent().trigger("expand"));
			changeTheme($(this).parent());
            });			
						
			// reset theme of all collapsible
			//$( "#menuset" ).children().find("a[data-theme='d']").removeClass('ui-btn-up-d').addClass('ui-btn-up-a').attr('data-theme', 'a').trigger('create'); 
			// change theme for selected collapsible
			$(this).find("a[data-theme='d']").addClass('ui-btn-up-d').trigger('create'); 			
			//$(this).parent().find('a').removeClass(oldClass).addClass(newclass).attr('data-theme', 'i').trigger('create');
            // we do our own call to the original event;
            return false;
        }).one("collapse", function() {						
			//$(this).find("a[data-theme='d']").removeClass('ui-btn-up-d').addClass('ui-btn-up-a').attr('data-theme', 'a').trigger('create');  
			$(this).find("a[data-theme='d']").removeClass('ui-btn-up-d').trigger('create'); 
            // animate hide on collapsible;
            $(this).find(".ui-collapsible-content").slideUp(animationSpeed, function() {
			    // trigger original event;
                $(this).parent().trigger("collapse");
				changeTheme();
            });
			//alert($(this).html());
            // we do our own call to the original event;
            return false;
        });	
    }

    // init;
    animateCollapsibleSet($("[data-role='collapsible-set'] > [data-role='collapsible']"));
});*/

$(document).one("pagebeforechange", function() {

    // animation speed;
    var animationSpeed = 700;

    function animateCollapsibleSet(elm) {

        // can attach events only one time, otherwise we create infinity loop;
        elm.one("expand", function() {

            // hide the other collapsibles first;
            $(this).parent().find(".ui-collapsible-content").not(".ui-collapsible-content-collapsed").trigger("collapse");

            // animate show on collapsible;
            $(this).find(".ui-collapsible-content").slideDown(animationSpeed, function() {
                // trigger original event and attach the animation again;
                animateCollapsibleSet($(this).parent().trigger("expand"));
            });

            // we do our own call to the original event;
            return false;
        }).one("collapse", function() {

            // animate hide on collapsible;
            $(this).find(".ui-collapsible-content").slideUp(animationSpeed, function() {

                // trigger original event;
                $(this).parent().trigger("collapse");
            });

            // we do our own call to the original event;
            return false;
        });
    } 
    // init;
    animateCollapsibleSet($("[data-role='collapsible-set'] > [data-role='collapsible']"));
});

$('.coll').on('expand collapse',function (e) {
	if (e.type == 'expand') {
	$(this).find('a.ui-collapsible-heading-toggle').addClass('biz_ui_selected').trigger("create");
	}else{
		$(this).find('a.ui-collapsible-heading-toggle').removeClass('biz_ui_selected').trigger("create");
	}
});
/*$('.coll').on("expand", function(e){
    //$(e.target + ' .ui-btn').addClass('ui-btn-active').trigger("create");
	 $('.coll .ui-collapsible-heading .ui-btn').addClass('ui-btn-hover-d').trigger("create");
});*/

/*$('.coll').on('expand collapse',function (e) {
    if (e.type == 'expand') {
        var oldclass = 'ui-btn-up-d ui-body-d';
        var newclass = 'ui-btn-up-e ui-body-e';
        $(this).find('a').removeClass(oldclass + ' ui-btn-hover-d').addClass(newclass + ' ui-btn-hover-e').trigger("create");
        $(this).find('.ui-collapsible-content').removeClass(oldclass).addClass(newclass).trigger("create");
    }
    if (e.type == 'collapse') {
        var oldclass = 'ui-btn-up-e ui-body-e';
        var newclass = 'ui-btn-up-d ui-body-d';
        $(this).find('a').removeClass(oldclass + ' ui-btn-hover-e').addClass(newclass + ' ui-btn-hover-d').trigger("create");
        $(this).find('.ui-collapsible-content').removeClass(oldclass).addClass(newclass).trigger("create");

    }
});*/

</script>
{/literal}
</body></html>
