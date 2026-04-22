{*
		$CBEG, $TEXT, $CONT, $LINK, $TREP 
*}
			<tr onmouseover='this.style.backgroundColor="#dedede";' onmouseout='this.style.backgroundColor="";'>
		{foreach from=$ARTIFI item=elem key=ekey}
					{if $ekey==$CBEG+1}
<td align=left class="maintd" colspan=5 {if isset($BGCO)}bgcolor={$BGCO}{else}{/if}> {$TEXT}
<td align=right class="maintd" {if isset($BGCO)}bgcolor={$BGCO}{else}{/if} style="padding-right:10px;"> 
		{if isset($LINK) and $CONT<>0}
{*
			<span onclick="dir.bg" style="background-color:gold; padding: 2px 10px 2px 10px; cursor:pointer;">
*}
			<a href="{$LINK}" style="background-color:gold; padding: 2px 10px 2px 10px; cursor:pointer;">
		{else}
		{/if}
{$CONT}
		{if isset($LINK)}
			</a>
		{else}
		{/if}
					{else}
<td align=right class="maintd" width=20> &nbsp;
					{/if}
		{/foreach}

{*---- колоната за отчета ----*}
<td align=left class="maintd">
					{if isset($STAT)}
						{if $STAT==0}
{*
							{assign var=stattext value="не участват"}
*}
							{assign var=stattext value="-"}
						{else}
							{assign var=stattext value="кол."|cat:$STAT}
						{/if}
{$stattext}
					{else}
&nbsp;
					{/if}
