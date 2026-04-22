<style>
.t2grou {ldelim}background-color:beige;padding:1pt 14pt;{rdelim}
.t2elem {ldelim}font: normal 8pt verdana;{rdelim}
</style>
					{*
					<table align=center border=1 style="border-collapsed:collapsed"cellspacing=0 cellpadding=0>
					*}
					<table align=center style="border:1px solid black;padding:6px;" cellspacing=0 cellpadding=0>
{foreach from=$ARSU2TYPE item=t2text key=t2code}
					<tr>
			{if is_int($t2code)}
<td class="t2elem">
<input type="radio" name="idt2" id="t2{$t2code}" value="{$t2code}" label="{$t2text}">
			{else}
<td class="t2grou t2elem">
{$t2text}
			{/if}
{/foreach}
					</table>
