<table class="listTable">    <tr>		<td class="bigListItem">            <table class="listTable">                <tr><th class="bigListItem">Search</th></tr>            	<tr>            		<td class="bigListItem">                        {include file='tbl_qrcode_log/search.tpl'}                    </td>            	</tr>            </table>        </td>	</tr>		<tr>		<td class="bigListItem">            <table class="listTable">                <tr><th class="bigListItem" colspan="2"> Promotion Info </th></tr>            	<tr>            		<td><b>Promotions sent</b></td><td>{$report_img.new_joins}</td>            	</tr>            	<tr>            		<td><b>Promotions claimed</b></td><td>{$report_img.claimed}</td>            	</tr>            </table>        </td>	</tr>	<tr>		<td class="bigListItem">            <table class="listTable">                <tr><th class="bigListItem"> Claimes per promotion </th></tr>            	<tr>            		<td class="bigListItem">                         <div class="biz_center">                         {if $report_img neq "" && $report_img.graph_prom_report.img_src neq ""}                        	 <img src="data:image/png;base64,{$report_img.graph_prom_report.img_src}" width="90%"/>                         {else}                        	 <img src="{$website}/images/_graphics/no_record.png"/>                         {/if}                        </div>                    </td>            	</tr>            </table>        </td>	</tr>	<tr>		<td class="bigListItem">            <table class="listTable">                <!-- <tr><th class="bigListItem" colspan="3"> Promotion wise details</th></tr> -->                <tr><th>Promotion</th><th>Email Sent</th><th>Claims</th></tr>            	{foreach from=$report_img.prom_wise_lst item=crm_prom_emailsitem}        			<tr>        				<td ><a href="{$website}/modules/business_listing/show.php?show_type=PR&promoid={$crm_prom_emailsitem.crm_pr_ml_promotion}" target="_blank">{$crm_prom_emailsitem.title}</a></td>        				<td>{$crm_prom_emailsitem.prom_sent} </td>        				<td>{$crm_prom_emailsitem.claimed} </td>        			</tr>            	{/foreach}            </table>        </td>	</tr></table>