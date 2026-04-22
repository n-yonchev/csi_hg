{foreach from=$ARSUBM item=elem key=ekey}
	<a class="{if $ekey==$SUBM}curr{else}{/if}" href="{$elem.subm}" style="font:bold 8pt verdana;">
	<nobr>{$elem.text}</nobr>
	</a>
{/foreach}
<br>
<br>
{$REPOCONT}
