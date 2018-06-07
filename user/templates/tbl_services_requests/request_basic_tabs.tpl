 <div class="navTable navTable_border">
 		<table class="navTable" style="width:300px;display:inline;">
		<tr>
			<th>
        	{if $active_page eq "employee_requests"}
    			 <b>{$_lang.services_requests.employee_request.title}</b>
    		{else}
    			 <a href="{$website}/user/employee_requests.php{$url_tbl_param}">{$_lang.services_requests.employee_request.title}</a>
    		{/if}
			
           	{if $active_page eq "tbl_services_requests"}
        	   	<th>
        			 <b>{$_lang._details}</b>
        		</th>
    		{/if}
		</tr>
		</table>
 </div>

