
{include file="$deftpl/header.tpl"}

<div data-role="page" id="listing_info">
	<div data-role="header">
			<h4>Business Information</h4>
	</div>
	
	{assign var=user_promotion value=$list.user_promotion} 
<div data-role="navbar">
	<ul>
	 <li>
	 	<a href="#listing_info">Business</a>
	 </li>
    {section name=pitm max=2 loop=$user_promotion}
	 	<li>
		 	<a href="#promotion_info{$user_promotion[pitm].id}"  style="padding:2px;font-size:11px;">
			 	Promotion#{$smarty.section.pitm.iteration}
			 </a>
		 </li>
	 {/section}
 </ul>
</div>
	
	<div data-role="content"> 
      <table class="job_detail_panal_table">
       <tr>
        <td class="detail_right_td"><b>Company</b></td>
        <td style="width:5px;">:</td>
        <td class="detail_left_td">{$list.firm}</td>

       </tr>
       
       <tr>
        <td class="detail_right_td"><b>State</b></td>
        <td style="width:5px;">:</td>
        td class="detail_left_td">{$list.states}</td>
       </tr>
	   <tr>
	    <td class="detail_right_td"><b>Metro Area</b></td>
        <td style="width:5px;">:</td>
        td class="detail_left_td">{$list.metro_area_name}</td>
       </tr>
        
       <tr>
        <td class="detail_right_td"><b>Address</b></td>
        <td style="width:5px;">:</td>
        <td class="detail_left_td"> {$list.strip_address}</td>

       </tr>
         
       <tr>
        <td class="detail_right_td"><b>Website</b></td>
        <td style="width:5px;">:</td>
        <td class="detail_left_td"><a href="{$list.website}" target="_blank">{$list.website}</a></td>

       </tr> 
       <tr>
        <td class="detail_right_td"><b>Phone</b></td>
        <td style="width:5px;">:</td>
        <td class="detail_left_td">{$list.phone}</td>
       </tr> 
       <tr>
        <td class="detail_right_td"><b>Cell</b></td>
        <td style="width:5px;">:</td>
        <td class="detail_left_td">{$list.mobile}</td>
        </tr> 
       <tr>
        <td class="detail_right_td"><b>Fax</b></td>
        <td style="width:5px;">:</td>
        <td class="detail_left_td">{$list.fax}</td>
      </tr>
        </table> 
	</div> 
	<div data-role="footer">
		<h4>Business Listing</h4> 
	</div> 
</div> 
 {section name=pitm max=2 loop=$user_promotion}
<div data-role="page" id='promotion_info{$user_promotion[pitm].id}'>
	<div data-role="header">
	romotion#{$smarty.section.pitm.iteration}
	</div> 
	{assign var=user_promotion value=$list.user_promotion} 
<div data-role="navbar">
	<ul>
	 <li>
	 	<a href="#listing_info">Business</a>
	 </li>
    {section name=pitm max=2 loop=$user_promotion}
	 	<li>
		 	<a href="#promotion_info{$user_promotion[pitm].id}"  style="padding:2px;font-size:11px;">
			 	Promotion#{$smarty.section.pitm.iteration}
			 </a>
		 </li>
	 {/section}
 </ul>
</div> 
<div data-role="content">	 
	 
        <table style="width:570px;font-size:10px;margin-left:-10px;">
       <tr>
        <td style="width:100px;"><b>Title</b></td>
        <td style="width:5px;">:</td>
        <td colspan="4"> {$user_promotion[pitm].title}</td>

       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>State</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].states_name}</td>
        <td style="width:100px;"><b>Metro Area</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].metro_area_name}</td>
       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>
       <tr>
        <td style="width:100px;"><b>From</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].start_date|date_format:"%D"}</td>
        <td style="width:100px;"><b>Until</b></td>
        <td style="width:5px;">:</td>
        <td style="width:180px;">{$user_promotion[pitm].end_date|date_format:"%D"}</td>
       </tr>
       <tr><td colspan="6" style="height:5px;"></td></tr>

       </tr>
     </table>
	</div>
	
<div data-role="footer">
		<h4>Business Listing</h4> 
	</div> 
</div> 
{/section}