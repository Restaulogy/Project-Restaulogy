{if $operation != ""}
    	<div class="approved">
            {$operation}
        </div>
{/if}
{if $notice != ""}
    	<div class="notice">
            {$notice}
        </div>
{/if}

{if $op_error != ""}
    	<div class="fail">
            {$op_error}
        </div>
{/if}

