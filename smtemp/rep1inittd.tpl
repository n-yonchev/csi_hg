{*
	$BEGI, $TEXT, $CONT, $CLAS 
*}
			<tr>
			<td>
{include file="rep1initbegi.tpl" COUN=$BEGI}
<div class="{$CLAS}" title="{$CODE}">
{$TEXT}
</div>
			<td class="coun">
{include file="rep1initbegi.tpl" COUN=$BEGI}
{*
		{if isset($LINK[$LINKINDX])}
<span class="link">{$CONT}</span>
		{else}
{$CONT}
		{/if}
*}
		{if isset($LINKINDX)}
			{if $CONT==0}
			{else}
{*
<span class="link">&nbsp;{$CONT}&nbsp;</span>
*}
<a class="link">{$CONT}</a>
			{/if}
		{else}
{$CONT}
		{/if}
			<td>
		{if $REPO=="p"}
<font color=red>проблем</font>
		{else}
{$REPO}
		{/if}
