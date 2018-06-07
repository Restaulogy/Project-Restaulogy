
        <div class="approved">
           {lang->desc p1='register' p2=$lang_set p3='step_complete'}
        </div>

	{if $notice != ""}
	    	<div class="fail">
            {$notice}
            </div>
	{/if}
