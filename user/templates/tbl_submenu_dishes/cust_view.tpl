{include file="header.tpl"}
<style>
	.dish_nav_arow_left
  {
  	position: absolute;
  	cursor: pointer;
  	display: block;
    background: url('{$website}/images/arrow_left.png') no-repeat;
    overflow:hidden;
		width: 40px; 
		height: 40px; 
		top: 168px;
		left: 3px;
  }
	.dish_nav_arow_right
  {
  	position: absolute;
  	cursor: pointer;
  	display: block;
    background: url('{$website}/images/arrow_right.png') no-repeat;
    overflow:hidden;
		width: 40px; 
		height: 40px; 
		top: 168px;
		right: 3px;
  }
</style>

{*
{if $Global_member.member_role_id eq $smarty.const.ROLE_CUSTOMER}
    {if $tbl_submenu_dishesinfo.cust_favorite && $tbl_submenu_dishesinfo.cust_favorite.cust_fav_id gt 0}
    	<input data-mini="true" type="button" onclick="deleteCustFavorites({$tbl_submenu_dishesinfo.cust_favorite.cust_fav_id});" value="Remove from favorites" data-inline="true" data-icon="remove_save" />
    {else}
        <input type="button" data-inline="true" data-mini="true" onclick="popupCustFavorites({$tbl_submenu_dishesinfo.sbmnu_dish_id},'SUBMENU_DISH');" value="Add to favorites" data-inline="true" data-icon="save" />
    {/if}
{/if}
*}

<div class="wrapper">

 <!-- Arrow Left -->
{if $_prev_dish_id gt 0}
	<span class="dish_nav_arow_left" onclick='window.location.href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$_prev_dish_id}&is_preview=1&web_redt=0";'></span>
{/if}
<!-- Arrow Right -->
{if $_next_dish_id gt 0}
	<span class="dish_nav_arow_right" onclick='window.location.href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$_next_dish_id}&is_preview=1&web_redt=0";'></span>
{/if}

{*include file='menu_nav_bar.tpl'*}
 
	{if $tbl_submenu_dishesinfo}

		{if $smarty.session[$smarty.const.SES_CART][$sequence_num][$smarty.const.SES_SUB_MENU_DISH][$tbl_submenu_dishesinfo.sbmnu_dish_id]}
				{assign var=dish_cart value=$smarty.session[$smarty.const.SES_CART][$sequence_num][$smarty.const.SES_SUB_MENU_DISH][$tbl_submenu_dishesinfo.sbmnu_dish_id]}
		{/if} 
	{/if}

<div class="clearfix"></div>
{if $error_msg}
	<div class="biz_center">{$error_msg}</div>
{/if}
    {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_is_drink eq 1}
          {include file="tbl_submenu_dishes/detail_view_wine.tpl"}
    {else}
          {include file="tbl_submenu_dishes/detail_view.tpl"}
    {/if}

{*
	<div class="listTable biz_no_border" style="background:transparent !important;" >
		<div class="biz_center"><img  src="{$website}/uploads/dish/{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img}" style="width:250px;height:200px;"/></div><div class="clearfix line_break"></div><div id="less_des" style="text-align:justify;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes|truncate:180:'...<a href="#" onclick=\'$("#popupDesc").popup("open");$("#more_des").toggle();\'>more</a>'}</div>
		
		<div data-role="popup" id="popupDesc" data-dismissible="false" data-theme="a1" data-overlay-theme="g" style="width:270px;">
		<div data-role="header"><h3>Description</h3></div>
		
		<div data-role="content">
		<div class="description" style="height:150px;overflow-y: auto;padding:5px 7px;"><p>{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes}</p> 
		</div>
			
			<center><input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="$('#popupDesc').popup('close');" value="{$_lang.close_lbl}"></center>
		</div> 
			
		</div>
		 
	</div>
	<div class="clearfix"></div>

 	<div data-role="collapsible-set" data-theme="a" data-content-theme="i" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
		<div data-role="collapsible" class="coll">
			 <h3>Options/Side dish <div class="clearfix line_break"></div></h3>
			 <p>
	  {if $tbl_submenu_dishesinfo.optionsPrice}
	  <table class="biz_data_grid" style="margin:0px 5px;"> 
			<!--<tr><th class="bigListItem">Options/Side dish</th> <th class="actionListItem">{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}Extra Charges{else}Prices{/if}</th></tr> -->
 		{assign var=currOptId value=0}
		{foreach from=$tbl_submenu_dishesinfo.optionsPrice item=optItm}
			 
			{if $currOptId neq $optItm.dish_opt_id} 
				<tr> 
				 <th colspan="2">{$optItm.dish_opt_name}&nbsp;{if $optItm.dish_opt_type eq "checkbox"}(Choose multiple){else}{if $optItm.dish_opt_type eq "dropdown"}(Choose One){/if}{/if}</th>
				</tr>
				{assign var=currOptId value=$optItm.dish_opt_id}
			{/if} 
		 	<tr class="{cycle values="odd,even"}">
			   {if $optItm.dish_opt_type eq "text"}
			   <td class="bigListItem no_hover" colspan="2">{$optItm.dish_opt_val_value} </td>
			   {else}
                <td class="bigListItem no_hover">
			 	 {$optItm.dish_opt_val_value} 
				</td> 
				<!--<td class="actionListItem" valign="top"> 
					{if $optItm.sbmdopt_pr_price && $optItm.sbmdopt_pr_price gt 0}${$optItm.sbmdopt_pr_price}{else}No Charge{/if} 
				</td>-->
				{/if}
			</tr> 
		{/foreach}
	</table>
	{else}
		<br/>
		<div class="errorbox">There are no options available for this menu</div>
		<br/>
	{/if}
	</p>  
	</div>
	
	<div data-role="collapsible" class="coll"> 
			 <h3>{$_lang.tbl_dishes.label.dish_ingrad_allergic_contents}<div class="clearfix line_break"></div></h3>
			 <p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_ingrad_allergic_contents}</p>	 	
	</div><!-- /collapsible -->
	
	<div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_allergy}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_allergy}</p></div><!-- /collapsible -->
			 
    <div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_food_wine_pair}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_food_wine_pair}</p></div><!-- /collapsible -->
	
	<div data-role="collapsible" class="biz_hidden">
			 <h3>{$_lang.tbl_dishes.label.dish_nutri_cal_info}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info}</p></div><!-- /collapsible -->
			 
	<div data-role="collapsible" class="coll"> 
			 <h3>{$_lang.tbl_dishes.label.dish_chef_notes}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_chef_notes}</p>
		</div><!-- /collapsible -->
 </div>

*}
 
{if $isCustomer}
 <div class="biz_center">
    {if $is_rated gt 0}
		 {jqmbutton icon="star" onclick="$('#popupRate').popup('open');" value="My Rating"}
	{else}
		 {jqmbutton icon="star" onclick="$('#popupRate').popup('open');" value="Rate"}
	{/if}
 </div> 
{/if} 
</div>
 
{include file="tbl_submenu_dishes/cust_view/order.tpl"}
{include file="tbl_submenu_dishes/cust_view/popupfav.tpl"}
{include file="tbl_submenu_dishes/cust_view/popupfavlist.tpl"}
{include file="tbl_submenu_dishes/cust_view/js.tpl"}
{** for this table id should not show ***}
{assign var=non_avail_table value=1}
{include file="tbl_cust_favorites/add.tpl"}
{include file="footercontent.tpl"} 
{include file="tbl_cust_favorites/js.tpl"}

{literal}
<script>
function show_food_tab(sel_tab){
    if(sel_tab=='wine'){
        $('#food_reg_dish').hide();
        $('#food_wine_dish').show();
    }else{
        $('#food_reg_dish').show();
        $('#food_wine_dish').hide();
    }
}
$(function(){
	/*$('#menu_start_timing').scroller({ preset: 'time', timeFormat:'HH:ii'});*/
	$("#menu_start_timing").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
	$("#menu_end_timing").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
	/*$('#menu_end_timing').scroller({ preset: 'time' }); */

})

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
 
</script>
{/literal}
</body></html>
