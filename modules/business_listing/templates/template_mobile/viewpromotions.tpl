{literal}
<SCRIPT type="text/javascript">
	$(function() {
       {/literal}
           {if $promoid}

           {else}
       {literal}
		      $( "#viewtabs" ).tabs();
       {/literal}
            {/if}
       {literal}
	});
</SCRIPT>
{/literal}



{if $promoid}
    {if $showing_promotion}
      {assign var="vPromotion" value=$showing_promotion}

      {include file="$deftpl/viewpromotions_display.tpl"}
      <div style='text-align:left;margin-left:20px;'>
      <br><br>
          <b style='color:$elgg_'>&bull; List of Current Promotions</b>
          {if $user_promotion}
          <br/>
               <ul>

                 {assign var='curr_prom_counter' value="0"}
                 {section name=pitm max=2 loop=$user_promotion}
                  {if $showing_promotion.id eq $user_promotion[pitm].id}
                       <!-- Not Show the Link -->
                  {else}
                  <li style='margin-left:30px;'><a href='{$elgg_main_url}pg/business_listing/main/show_promotion/{$user_promotion[pitm].list_id}/{$user_promotion[pitm].id}' target='_blank'>{$user_promotion[pitm].title}</a></li>
                  {math assign="curr_prom_counter" equation="x + 1" x=$curr_prom_counter}
                 {/if}
                 {/section}
                 {if $curr_prom_counter eq 0}
                    <br/><b>There is no Current Promotion posted by this Business.</b>
                 {/if}
                </ul>

              {else}
                    <br/><b >There is no Current Promotion posted by this Business.</b>
              {/if}
        </div>
    {else}
        <h2 style="color:red;">No Promotions Available</h2>
    {/if}

{else}

{if $user_promotion}

<DIV id="viewtabs">

<ul>
{section name=pitm1 max=2 loop=$user_promotion}
	<li><a style="padding:1px;font-size:11px;font-weight:bolder;" href="#viewtabs-{$user_promotion[pitm1].id}" id="viewtabs_link{$promoid}">Promotion #{$smarty.section.pitm1.iteration}</a></li>

{/section}
</ul>
{section name=pitm max=2 loop=$user_promotion}
 <DIV id="viewtabs-{$user_promotion[pitm].id}">
      {assign var="vPromotion" value=$user_promotion[pitm]}
      {include file="$deftpl/viewpromotions_display.tpl"}
 </DIV>
{/section}

 </DIV>
{else}
    <h2 style="color:red;">No Promotions Available</h2>
{/if}
{/if}


