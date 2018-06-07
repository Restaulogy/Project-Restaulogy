 {literal}
 <script src="{/literal}{$elgg_main_url}{literal}vendors/jquery/easypaginate.min.js"></script>
<style>
    ol#pagination{overflow:hidden;}
	ol#pagination li{
		float:left;
		list-style:none;
		cursor:pointer;
		margin:0 0 0 .5em;
		}
	ol#pagination li.current{color:#f00;font-weight:bold;}
</style>
<script type="text/javascript">
      $('ul#{/literal}{$table_id}{literal}').easyPaginate({
		  step:10
	   });
</script>
 {/literal}
