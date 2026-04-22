{*
	$CONT 
	$COLU 
*}
<td class="c1suma" align=right> 
					{if empty($CONT)}
					{else}
<span class="{if $COLU==$CURRF2}c2curr{else}c2vari{/if}" {include file="_href.tpl" LINK=$ARLINKF2.$COLU}
title="кликни : само делата, които формират сумата в {$ARF2.$COLU}"
> {$CONT|tomo3}</span>
					{/if}
