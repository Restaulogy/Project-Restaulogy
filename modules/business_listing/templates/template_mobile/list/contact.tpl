 <div data-role="page" id="contact">
 {include file="$deftpl/list/header.tpl"}
	<div data-role="content">
		<table class="listTable">
			<tr>
				<td class="fieldItem">Contact</td>
				<td class="valueItem">{$vs_current_listing.contact}</td>
			</tr>
			<tr>
				<td class="fieldItem">Address</td>
				<td class="valueItem">{$vs_current_listing.addr1}</td>
			</tr>
			<tr>
				<td class="fieldItem">Location</td>
				<td class="valueItem">{$vs_current_listing.loc1}</td>
			</tr>
			<tr>
				<td class="fieldItem">Phone</td>
				<td class="valueItem">{$vs_current_listing.phone}</td>
			</tr>
			<tr>
				<td class="fieldItem">Mobile</td>
				<td class="valueItem">{$vs_current_listing.mobile}</td>
			</tr>
			 
		</table>
	</div>
{include file="$deftpl/list/footer.tpl"}
</div>