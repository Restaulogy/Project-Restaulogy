<div class="extra_info">*Choose Busienss From The Following List of Busiensses TO Add Your Promotion.</div>

	        <table class="job_detail_panal_table">
			<tr>
				<th colspan="2">Choose Listing For Promotion</th>
			</tr>
			<tr>
            <td class="detail_right_td">Listings</td>
			<td class="detail_left_td">
                <select id="choose_listing" onchange="get_listing();">
			        <option value="0">Select Your Listing</option>
			    {if $owner_listing}
				    {section name=litm loop=$owner_listing}
			        <option  value="{$owner_listing[litm].id}">{$owner_listing[litm].firm}</option>
	                {/section}
			  	{/if}
			  </select>
			  </td>
	        </tr>
			  </table>
			  <input type="button" id="Choose_btn"  value="Select" onclick="redirect_promotion();"/>
            </center>

			  {literal}
			    <script type="text/javascript" language="javascript">
			    function redirect_promotion()
			    {
	                var w = document.getElementById("choose_listing");
	                var location_str = 'promotion.php?list_id=' + w.value;
	                document.location.href= location_str;
				}
			    function get_listing()
			    {
					var w = document.getElementById("choose_listing");

					if (w.value == 0)
					{document.getElementById("Choose_btn").style.display = "none";
					}
					else
					{document.getElementById("Choose_btn").style.display = "inline";}
				}
			    </script>
			  {/literal}
