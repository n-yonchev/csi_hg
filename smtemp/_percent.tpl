{*
изчислява процент - предпазва от делене на нула 
		$P1, $P2 
*}
{if $P2==0}
	{assign var=resu value=""}
{else}
	{math equation="round(x/y*100,0)" x=$P1+0 y=$P2 assign=resu}
{/if}
<font color=red>
										{if $FLPRIN}
{$resu}
										{else}
{$resu}&nbsp;
										{/if}
</font>
