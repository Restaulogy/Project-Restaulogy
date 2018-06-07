
 <div data-role="page" id="rating">
    {include file="$deftpl/list/header.tpl"}


		<div data-role="content">
            	 <div class="extra_info">*As You Are Owner Of This Listing You Can See Recommendations For This Listing</div>
            	 <br/><br/>
            	 

            {section name=foo loop=$stats_questions}
                {assign var=ques_index value=$smarty.section.foo.iteration}
                <b>{$ques_index}. {$stats_questions[foo].question}</b> <br>
                <img  src="graphics/{$stats_questions[foo].avg}.gif" alt="{$stats_questions[foo].avg}"/>
		&nbsp;(<i>{$stats_questions[foo].count} votes</i>)
                <br/>
            {/section}

            {if $stats_rating}
              <br>
             <h5>Rating For Business</h5>
            <div data-role="collapsible-set">

            {section name=itm loop=$stats_rating}
                <div data-role="collapsible" data-collapsed="true" data-content-theme="c">
	  	<h3 style="font-size:85%;">

		  	<table class="job_detail_panal_table" style="width:100%;">
			 <tr>
			 	 <th align="left" style="width:60%;">{$stats_rating[itm].title}</th>
                 <th align="left" style="width:40%;text-align:right;">{$stats_rating[itm].date|date_format:"%b %e, %Y"}</th>
			 </tr>
			</table>
		</h3>
		<p style="margin:0px;padding:0px; ">
			<table class="job_detail_panal_table" style="width:100%;">
				<tr>
					<td style="border-bottom:1px solid #111;">
                        <b style="color:#777;">Comment:</b>
                            {$stats_rating[itm].comments}
					</td>
				</tr>

				<tr>
					<td>
                    <table class="job_detail_panal_table" style="width:100%;">


                        {assign var=rate_answer value=$stats_rating[itm].answer}
                        {section name=qitm loop=$rate_answer}
                        <tr>
                        <td class="detail_right_td">
                            {$smarty.section.qitm.iteration}. {$stats_questions[qitm].question}
                        </td>
                        </tr>
                        <tr>
                        <td style="border-bottom:1px solid #AAA;padding-bottom:3px;"> <b>Answer :</b>
                            {if $rate_answer[qitm]}
                                {$rate_answer[qitm]}
                            {else}
                                --
                            {/if}
                            </td>
                        </tr>

                        {/section}

                    </table>
					</td>
				</tr>

			</table>
		</p>
	</div>
            {/section}
            </div>
            {else}
            
            {/if}


        </div><!--content-->
    {include file="$deftpl/list/footer.tpl"}

 </div><!--Page-->
