{*
{foreach from=$ARLINK item=cutext key=culink}
<nobr>
			{if empty($culink)}
	{$cutext}
			{else}
	<span class="vari" {include file="_href.tpl" LINK=$culink}> {$cutext} </span>
			{/if}
&nbsp;&nbsp;
</nobr>
{/foreach}
<br>&nbsp;
*}
{foreach from=$ARLINK item=cutext key=culink}
			{if empty($culink)}
			{else}
<nobr>
	<span class="vari" {include file="_href.tpl" LINK=$culink}> {$cutext} </span>
</nobr>
<br>
			{/if}
{/foreach}
