{include file='header.tpl'}

<div class="wrapper">

<h1>{$_lang.tbl_crm.UNSUBSCRIBE.BTN_LBL}</h1>

    <!-- Start Message -->
	<div style='width:90%;height40%;background:gray;margin:15px;padding:10px;border:solid 1px orange;'>
        {if $unsubscribe gt 0}
               <b>Hello Subscriber, </b> <br>  <br>
        		<p>Your phone <strong>{$user_details.crm_cust_phone}</strong> has been successfully removed from the promotion subscription.</p> <br>
                <p>We're sorry to see you go.</p>   <br>
                Thanks.  <br>
                <img src="{$rest_details.restaurent_img_url}" width="20" height="20" />&nbsp; &nbsp;<b>{$rest_details.restaurent_name} </b> <br>
        {else}
               <p>The unsubscribe link is not proper.</p>
        {/if}

	</div><!-- End Message -->

</div>
{include file='footer.tpl'}
