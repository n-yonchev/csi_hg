{*
				{if $PERC>100}
<span class="no">{$PERC} %</span>
				{else}
<span class="yes">{$PERC} %</span>
				{/if}
*}
				{if $PERC>100 or $PERC<0}
<font color=red>{$PERC} %</font>
				{else}
{$PERC} %
				{/if}
