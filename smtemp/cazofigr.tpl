<td align=right>
{include file="cazofigramou.tpl" AMOU=$DATA.suma.$VARI|tomo3}
		{foreach from=$CLAILIST2 item=clai key=ckey}
<td align=right> 
{include file="cazofigramou.tpl" AMOU=$DATA.$VARI.$ckey|tomo3}
		{/foreach}
