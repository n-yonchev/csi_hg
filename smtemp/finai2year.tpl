{*
	$CONT, $FIEL 
*}

{foreach from=$LISTMONT item=mont}
{*
				<td class='sep'>&nbsp;</td>
					{assign var=datayemo value=$CONT[$mont]}
					{assign var=elem value=$datayemo.$FIEL}
					{if $elem+0==0}
<td align=right class="cell"> -
					{else}
						{if $FIEL=="coun"}
<td align=right class="cell"> {$elem} 
						{else}
<td align=right class="{if $FIEL=="suma"}link{else}cell{/if}"> {$elem|tomo3} 
						{/if}
					{/if}
*}
{include file="finai2yearcell.tpl" CELL=$CONT[$mont] CLAS=""}
{/foreach}
{include file="finai2yearcell.tpl" CELL=$CONT[21] CLAS="trow"}
{include file="finai2yearcell.tpl" CELL=$CONT[0] CLAS=""}
{include file="finai2yearcell.tpl" CELL=$CONT[22] CLAS="trow"}
