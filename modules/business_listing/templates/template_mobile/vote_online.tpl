
	<div class="extra_info"style="width:100%;text-align:left;">*Please rate this Business</div>
		<form name="vote_online" id="vote_online" method="get" action="show.php" onsubmit="return valid_vote();" data-ajax="false">
            <table  class="job_detail_panal_table" style="overflow:hidden;">
                <tr>
                <th colspan="2">Vote</th>
                </tr>
				<tr>
				<td class="detail_right_td"> Title</td></tr>
				<tr>
				<td class="detail_left_td">
                    <input type="text" id="title" name="title" value=""/>
				</td>
				</tr>
 				<tr>
                <td class="detail_left_td">
                 1.	How would you rate the performance of the Business/contractor?
                 <br>
                 <b style="color:#777;">Answer:-</b>
                     <select name="question1">
                        <option value="0">Select Answer</option>
                        <option value="5">Very Positive</option>
                        <option value="4">Positive</option>
                        <option value="3">Neutral</option>
                        <option value="2">Negative</option>
                        <option value="1">Very Negative</option>
				     </select>
				</td>
				</tr>
				<tr>
                <td class="detail_left_td">
				2.	How was the quality of service/product?
				<br>
				<b style="color:#777;">Answer:-</b>
                     <select name="question2">
                        <option value="0">Select Answer</option>
                        <option value="5">Very Positive</option>
                        <option value="4">Positive</option>
                        <option value="3">Neutral</option>
                        <option value="2">Negative</option>
                        <option value="1">Very Negative</option>
				     </select>
				</td>
				</tr>
				<tr>
                <td class="detail_left_td">
				3.	Was the work delivered in a timely fashion?
				<br>
				<b style="color:#777;">Answer:-</b>
                     <select name="question3">
                        <option value="0">Select Answer</option>
                        <option value="5">Very Positive</option>
                        <option value="4">Positive</option>
                        <option value="3">Neutral</option>
                        <option value="2">Negative</option>
                        <option value="1">Very Negative</option>
				     </select>
				</td>
				</tr>
				<tr>
                <td class="detail_left_td">
                4.	How would you rate their business and technical knowledge?
                <br>
                <b style="color:#777;">Answer:-</b>
                     <select name="question4">
                        <option value="0">Select Answer</option>
                        <option value="5">Very Positive</option>
                        <option value="4">Positive</option>
                        <option value="3">Neutral</option>
                        <option value="2">Negative</option>
                        <option value="1">Very Negative</option>
				     </select>
				</td>
				</tr>
				<tr>
                <td class="detail_left_td">
				5.	How was after sale customer service?
				<Br>
				<b style="color:#777;">Answer:-</b>
                     <select name="question5">
                        <option value="0">Select Answer</option>
                        <option value="5">Very Positive</option>
                        <option value="4">Positive</option>
                        <option value="3">Neutral</option>
                        <option value="2">Negative</option>
                        <option value="1">Very Negative</option>
				     </select>
				</td>
				</tr>
				<tr>
                <td class="detail_left_td">
				6.	Would you recommend them to your friends and other connections?
				<Br>
				<b style="color:#777;">Answer:-</b>
                     <select name="question6">
                        <option value="0">Select Answer</option>
                        <option value="5">Very Positive</option>
                        <option value="4">Positive</option>
                        <option value="3">Neutral</option>
                        <option value="2">Negative</option>
                        <option value="1">Very Negative</option>
				     </select>
				</td>
				</tr>
				<tr>
				<td class="detail_right_td"> Comments:</td>
                </tr>
				<tr>
				<td class="detail_left_td">
                    <textarea name="comments" rows="5" style="width:95%;"></textarea>
				</td>
				</tr>
                <tr>
                <td colspan="2">
                 <input type="submit" name="submit" id="submit" data-theme="a" value="Submit"/>
                 <input type="hidden" name="lid" id="lid" value="{$vs_current_listing.id}" />
                {if $showing_promotion && $promoid}
				    <input type="hidden" name="promoid" value="{$promoid}" />
				{/if}
                </td>
                </tr>
			</table>


		</form>

{literal}
	<script type="text/javascript">
	    function valid_vote(){
			validform = true;
			var vtitle = document.forms.vote_online.title.value;
			var vcomments = document.forms.vote_online.comments.value;
			var errors = "";
			if (!IsNonEmpty(vtitle)){
                errors = errors + "Please Enter Title\n";
                validform = false;
   			}
   			if (!IsNonEmpty(vcomments)){
                errors = errors + "Please Enter Comments\n";
                validform = false;
   			}
			if (validform == false){
				alert(errors);
   			}
			return validform;
		}
	
	</script>
{/literal}
