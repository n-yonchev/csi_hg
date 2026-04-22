{*
	$CALC 
	$DATA 
*}
			{if $CALC==$DATA}
{$CALC|tomoney2}
			{else}
<span style="border: 1px solid red">{$CALC|tomoney2}</span>
			{/if}
