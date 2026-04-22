{*----
			<table align=left>
			<tr>
			<td>
{foreach from=$YEARLIST item=elem key=ekey}
	<a class="{if $ekey==$YEAR}curr{else}{/if}" href="{$elem}">
	{$ekey}
	</a>
{/foreach}
			</table>
----*}
{foreach from=$YEARLIST item=elem key=ekey}
	<a class="{if $ekey==$YEAR}curr{else}{/if}" href="{$elem}">
	{$ekey}
	</a>
{/foreach}
