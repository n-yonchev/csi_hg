					{if count($LIST)==0}
-
					{else}
			{foreach from=$LIST item=elem}
{$elem.name}
<br>
			{/foreach}
					{/if}
