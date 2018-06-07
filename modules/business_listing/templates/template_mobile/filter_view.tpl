{include file="$deftpl/header.tpl"}
<div data-role="page" id="filter_view">
<div data-role="header">

		<h4>Set Alert</h4>

	</div>
<div data-role="content">
     <table class="job_detail_panal_table">

		 <tr>
		    <td class="detail_right_td">Title
		    </td>
            <td class="detail_left_td">
                {$interested_ppl.title}
		    </td>
		 </tr>
		 <tr>
		    <td class="detail_right_td">Keywords
		    </td>
            <td class="detail_left_td">
                {$interested_ppl.keywords}
		    </td>
		 </tr>
		 <tr>
		    <td class="detail_right_td">Business Title</td>
            <td class="detail_left_td">
                {$interested_ppl.business_title}
		    </td>
		 </tr>
         <tr>
         <td class="detail_right_td">
            Categories
         </td>
         <td class="detail_left_td">
                {if $interested_ppl.list_categories}{$interested_ppl.list_categories}{/if}
        </td>
     </tr>

<tr>
 <td class="detail_right_td">
 States
</td>
    <td class="detail_left_td">
         {$interested_ppl.state_name}
    </td>
</tr>
<tr>
         <td class="detail_right_td" style="border-bottom:none;">
		       Metro Area
        </td>
            <td class="detail_left_td" id="intrested_metro_area_box" style="border-bottom:none;">
            {$interested_ppl.metro_area_name}
         </td>
         </tr>
         </table>
 	</div>
 	<div data-role="footer">
 	<center>
        <a href="#" onclick="self.close();" data-role="button" data-icon="delete">Close</a>
        </center>
	</div><!--footer-->
</div>

{include file="$deftpl/sitefoot.tpl"}

