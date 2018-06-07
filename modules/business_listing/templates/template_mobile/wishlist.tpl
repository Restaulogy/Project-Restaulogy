{*****************************************

       Edit Listing Template
          phpDirectorySource

******************************************}

{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edlist'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
{if $notice != ""}
    	<div class="fail">
        	{$notice}
        </div>
	{/if}
{if $operation != ""}
    	<div class="approved">
        	{$operation}
        </div>
{/if}
        <!-- add new item form -->
        <form id="wish_list_form" name="wish_list_form" class="job_detail_view" method="post" action = "wishlist.php" >
        <!-- <b>Add New Item To Wish List :</b><br>  -->
		<center>
	   <table width="700px" class="job_detail_view">
		  <tr>
				<th colspan="2">Make Your Wish List</th>
		  </tr>
          <tr>
             <td class="right_td" style="width:250px;">
                 Select Category
             </td>
             <td class="left_td" style="width:300px;">
              <input type="text" class="required" name="category" id="category" value="{$smarty.post.category|escape}"/>{$tree_cate}
            </td>
          </tr>
          <tr>
            <td class="right_td" style="width:250px;">
                 How often you use service
             </td>
             <td class="left_td" style="width:300px;">
                <select name="timeframe" id="timeframe">
                  <option value="daily">daily</option>
                  <option value="weekly">weekly</option>
                  <option value="montly">montly</option>
                  <option value="yearly">yearly</option>
                  <option value="occasionally">occasionally</option>
                </select>
            </td>
          </tr>
          <tr>
            <td class="right_td" style="width:250px;">
                 Price Range You are Looking
             </td>
             <td class="left_td" style="width:300px;">
                <select name="pricing" id="pricing">
                  <option value='Less than $10'>Less than $10</option>
                  <option value='$10-$100'>$10-$100</option>
                  <option value='$100-$500'>$100-$500</option>
                  <option value='$500-$1000'>$500-$1000</option>
                  <option value='$1000-$5000'>$1000-$5000</option>
                  <option value='$5000-$10000'>$5000-$10000</option>
                  <option value='Greater than $10000'>Greater than $10000</option>
                </select>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
                 <input type="submit" name="Add" value="Save This Item" class="blackbutton" style="width:100px;" {if $items_in_wish_list >=5 } Disabled="Disabled" {/if} />
             </td>
          </tr>
        </table>
        </center>
        </form>
        
        {literal}

        <script type="text/javascript">
       		$(document).ready(function()
    		{
    			$("#wish_list_form").validate({
    				rules: {
                        category :{required:true}
    				},
                   messages: {
    					category: "Please, Select Category "
                   }
    			});
    		 });
		</script>
	{/literal}
        {math assign="rem_count" equation='x-y' x=5 y=$items_in_wish_list}
            <div style="display:inline;color:gray;font-size:12px;font-weight:bolder;"> You can select only Five Items In Wish List &nbsp;&nbsp;
        {if $items_in_wish_list eq 0}
			<!-- List Message goes here -->
        {elseif $rem_count eq 0}
              	<small style="color:red;">(<I>* You have already selected <u>{$items_in_wish_list|no2words:1}</u> items. <u> You can not  select any more</I></u>)</small>
        {else}
			  	<small style="color:green;">(<I>* You have already selected <u>{$items_in_wish_list|no2words:1}</u> items. You can select <u style="color:red">{$rem_count|no2words:1}</u> more</I>)</small>
        {/if}
		</div>
        
         <!-- Now Show the list of the items -->
          {if $user_wish_list}
          <center>
            <table class="job_detail_view">
             <tr>
                 <th class="left_td" style="width:390px;">
                     Category
                 </th>
                 <th class="left_td" style="width:130px;">
                     Period
                 </th>
                 <th class="left_td" style="width:130px;">
                     Pricing
                 </th>
                 <th class="right_td" style="width:60px;">
                        <center>Action</center>
                 </th>
             </tr>
            {section name=citm loop=$user_wish_list}
              <tr>
                 <td class="left_td" style="width:390px;">
                     {$smarty.section.citm.index_next}.
                     {$user_wish_list[citm].title}
                 </td>
                 <td class="left_td" style="width:130px;">
                     {if $user_wish_list[citm].timeframe} {$user_wish_list[citm].timeframe} {/if}
                 </td>
                 <td class="left_td" style="width:130px;">
                     {if $user_wish_list[citm].pricing}{$user_wish_list[citm].pricing} {/if}
                 </td>
                 <td class="right_td" style="width:60px;">
                 <center>
                  <a style="background:white;color:white;" href="wishlist.php?remove=true&wishlistid={$user_wish_list[citm].id}&category={$user_wish_list[citm].id}" id="remove_wl"><img style="border:none;" src="templates/{$deftpl}/images/deleteIcon.gif" width="20" height="20" alt="Remove Item From Wish List"> </a></center>
                </td>
              </tr>
            {/section}
            </table>
            </center>
            <br>
            

          {/if}

{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
