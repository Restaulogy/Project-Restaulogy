<div data-role="popup" id="sh_cust_pop_msg" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
      <div data-role="header">
		<h1>{$_lang.biz_rewards.listing_title}</h1>
	  </div>

       <br>
       <div class="biz_center">
       <div class='info'>{if $sh_cust_pop_msg neq ''}{$sh_cust_pop_msg} <br><br>{/if}{$_lang.biz_rewards.info_msg.sh_cust_pop_msg}.</div>
       </div>
<br><br>

       <div class='biz_center'>
        <input type="button" data-inline="true" onclick="$('#sh_cust_pop_msg').popup('close');" value="Ok"/>
        <!-- data-icon="loyalty" -->
        </div>
</div>
